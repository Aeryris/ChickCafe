<?php

class Staff_Controller extends Base_Controller{

    public function get_ingredient_stock() {
        $this->db->beginTransaction();
        $sQuery = "SELECT *
                    FROM ingredient";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_item_stock() {
        $sQuery = "SELECT *
                    FROM item";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_orders() {

        $this->view="staff";
    }

    public function get_order_report() {
        $sQuery = "SELECT *
                    FROM orders o
                    INNER JOIN customer_order co ON o.order_id = co.order_id
                    JOIN customer cu ON co.customer_id = cu.customer_user_id
                    INNER JOIN user u ON cu.customer_user_id = u.user_id
                    INNER JOIN order_items oi ON oi.order_id = o.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    WHERE o.order_id = co.order_id
                    ORDER BY o.order_datetime ASC"; 
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        $orders = [];
        foreach($data as $key => $value) {
            $orders[$value['order_id']][] = $value;
        }
        foreach($orders as $orderID => $dataSet) {
            $items = [];
            $original = $dataSet;
            foreach($dataSet as $key => $value) {
                $theItem = [
                    'item_id' => $value['item_id'],
                    'item_name' => $value['item_name'],
                    'item_description' => $value['item_description'],
                    'item_stock' => $value['item_stock'],
                    'item_available' => $value['item_available'],
                    'item_price' => $value['item_price'],
                    'item_preptime' => $value['item_preptime'],
                    'item_img' => $value['item_img']
                ];
                $orders[$orderID][0]['items'][] = $theItem;
                $orders[$orderID][0]['item_names'][] = $value['item_name'];
                unset(
                    $orders[$orderID][0]['item_id'],
                    $orders[$orderID][0]['item_name'],
                    $orders[$orderID][0]['item_description'],
                    $orders[$orderID][0]['item_stock'],
                    $orders[$orderID][0]['item_available'],
                    $orders[$orderID][0]['item_price'],
                    $orders[$orderID][0]['item_preptime'],
                    $orders[$orderID][0]['item_img']
                );
            }
        }
        foreach($orders as $orderID => $set) {
            $finalOrders[] = $set[0];
        }
        return $finalOrders;
    }

    public function get_customer_spending_report() {
        $sQuery = "SELECT *
                    FROM customer cu
                    INNER JOIN customer_order co ON cu.customer_user_id
                    INNER JOIN user u ON cu.customer_user_id = u.user_id
                    WHERE u.user_id = cu.customer_user_id";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }       

    public function get_refund_report() {
        $sQuery = "SELECT *
                    FROM refund re
                    INNER JOIN customer_order co ON re.refund_order
                    JOIN orders o ON co.order_id = o.order_id
                    INNER JOIN user u ON co.customer_id = u.user_id
                    WHERE re.refund_id = co.refund_refund_id
                    ORDER BY o.order_datetime ASC ";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_stock_report() {
        $sQuery = "SELECT *
                    FROM item i
                    INNER JOIN item_ingredients ings ON i.item_id = ings.item_id
                    JOIN ingredient ing ON ings.ingredient_id = ing.ingredient_id
                    WHERE i.item_id = ings.item_id
                    ORDER BY i.item_id ASC";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function approve_refund() {

    }

    public function create_staff() {
        if(Input_Core::getPost()){
            $sEmail = Field::post('email')->required()->validation('/@/i');
            $sPassword = Field::post('password')->required();
            $sConfirmPassword = Field::post('passwordconfirm')->required()->equalsTo('password');
            $sFirstName = Field::post('firstname')->required();
            $sLastName = Field::post('lastname')->required();
            $sRole = Field::post('role')->required();
            $sSalary = Field::post('salary')->required();
            $sPhoneNumber = Field::post('phonenumber')->required();
            $sType = Field::post('type')->required();

            $oLoginForm = new Form_Core(array($sEmail, $sPassword, $sConfirmPassword, $sFirstName, $sLastName));

            if($oLoginForm->validate()){
                $oUser = new User_Model();
                $oUser->attr(['email' => $sEmail->value(), 'password' => $oUser->passwordSecure($sPassword->value())]);
                if(!$oUser->exists()){
                    $oUser->add()
                          ->setType($oStaff = new Staff_Model($sType->value()))
                          ->setEmail($sEmail->value())
                          ->setPassword($oUser->passwordSecure($sPassword->value()))
                          ->setFirstName($sFirstName->value())
                          ->setLastName($sLastName->value())
        
                          ->setSalary($sSalary->value())
                          ->setRole($sRole->value())
                          ->setPhoneNumber($sPhoneNumber->value())
                          ->save();
                    header('Location: /staff/manager');
                    exit();
                }else{
                    $oLoginForm->sErrors .= 'User already exists in our system. <br />';
                }

            }
            $this->template->errors = $oLoginForm->sErrors;
        }

        $this->view = 'manager';
    }

    public function get_all_staff() {
        $this->db->beginTransaction();
        $sQuery = 'SELECT *
            FROM staff s
            INNER JOIN user u
            WHERE s.staff_user_id = u.user_id';
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_single_staff() {
        $sID = Field::post('staff_id')->required();
        $sID = $sID->value();
        $this->db->beginTransaction();
        $sQuery = "SELECT * FROM staff WHERE staff_user_id = :id LIMIT 1";

        $oStmt = $this->db->prepare($sQuery);
        $oStmt->bindParam(':id', $sID, PDO::PARAM_INT);

        $oExecute = $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function modify_staff() {
        $sID = Field::post('staff_id')->required();
        if ($sID != null) {
            $sRole = Field::post('role')->required();
            $sSalary = Field::post('salary')->required();
            $sPhoneNumber = Field::post('phone')->required();
            
            $sQuery = 'UPDATE staff SET staff_role = :role,
                                        staff_salary = :salary,
                                        staff_phone_number = :number
                                         WHERE staff_user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':role', $sRole->value(), PDO::PARAM_STR);
            $oStmt->bindParam(':salary', $sSalary->value(), PDO::PARAM_STR);
            $oStmt->bindParam(':number', $sPhoneNumber->value(), PDO::PARAM_STR);
            $oStmt->bindParam(':id', $sID->value(), PDO::PARAM_INT);

            $oExecute = $oStmt->execute();

            $this->view = 'manager';
        } 
    }

    public function delete_staff() {
    $sID = Field::post('staff_id')->required();
        if ($sID != null) {
            $sRole = 'Unemployed';
            $sSalary = '0';
            $sPassword = ' ';

            $this->db->beginTransaction();
            $sQuery = 'UPDATE staff SET staff_role = :role
                                        WHERE staff_user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':role', $sRole, PDO::PARAM_STR);
            $oStmt->bindParam(':id', $sID->value(), PDO::PARAM_INT);

            $oExecute = $oStmt->execute();
            $this->db->commit();

            $this->db->beginTransaction();
            $sQuery = 'UPDATE user SET user_password = :password
                                    WHERE user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':password', $sPassword, PDO::PARAM_STR);
            $oStmt->bindParam(':id', $sID->value(), PDO::PARAM_STR);

            $oExecute = $oStmt->execute();
            $this->db->commit();

            $this->view = 'manager';
        } 
    }

    public function get_profile() {
        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);
        if($oUser->exists()) {
            $type = $oUser->aData['user_type'];
            $oStaff = new Staff_Model($type, $oUser);
        }
        return $oStaff;
    }

    public function staff(){
        Auth_Core::init()->isAuth(true);
        if(Acl_Core::allow(['S','M','O','A'])){
            $this->template->stock = $this->get_ingredient_stock();
            $this->template->item_stock = $this->get_item_stock();
            $this->view = 'staff';
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
    }

    public function report() {
        Auth_Core::init()->isAuth(true);
        if(Acl_Core::allow(['M','O','A'])){
            $this->template->customer_spending = $this->get_customer_spending_report();
            $this->template->orders = $this->get_order_report();
            $this->template->refunds = $this->get_refund_report();
            $this->template->stock = $this->get_stock_report();                
            $this->view = 'report';
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
    }

    public function manager() {
        // $oAcl = new Acl_Core(ACL::ACL_MANAGER);
        Auth_Core::init()->isAuth(true);
        if(Acl_Core::allow(['M','O','A'])){
            $this->template->create_staff = $this->create_staff();
            $this->template->get_staff = $this->get_all_staff();
            $this->template->refund = $this->get_refund_report();
            $this->view = 'manager';
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
       
    }
} 