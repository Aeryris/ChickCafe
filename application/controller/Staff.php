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
        $sQuery = "SELECT *
                    FROM orders o
                    INNER JOIN customer_order co ON o.order_id = co.order_id
                    JOIN customer cu ON co.customer_id = cu.customer_user_id
                    INNER JOIN order_items oi ON oi.order_id = o.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    WHERE DATE(`order_datetime`) = CURDATE() AND order_ready = 'F'
                    ORDER BY o.order_datetime ASC"; 
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data != null) {
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
                    $orders[$orderID][0]['item_preptimes'][] = $value['item_preptime'];
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
    }

    public function ready_order() {
        try {
            $oID = Field::post('order_id')->required();
            $sID = User_Model::user()['user_id'];
            if ($oID != null && $sID != null) {
                $this->db->beginTransaction();
                $sQuery = "UPDATE orders SET order_ready_datetime = NOW( ) ,
                            order_ready = 'T',
                            order_staff_id = :staff_id WHERE order_id = :order_id";
                $oStmt = $this->db->prepare($sQuery);
                $oStmt->bindValue(':order_id', $oID->value(), PDO::PARAM_INT);
                $oStmt->bindValue(':staff_id', $sID, PDO::PARAM_INT);
                $oStmt->execute();
                $this->db->commit();
            }
            header("Location: /staff/staff");
        } catch (Exception $e) {
            echo "haha";
            die();
        }
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
                    WHERE u.user_id = cu.customer_user_id
                    GROUP BY u.user_id";
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
                    ORDER BY o.order_datetime ASC";
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

    public function get_today_order() {
        $sQuery = "SELECT *
                    FROM orders o
                    INNER JOIN customer_order co ON o.order_id = co.order_id
                    JOIN customer cu ON co.customer_id = cu.customer_user_id
                    INNER JOIN user u ON cu.customer_user_id = u.user_id
                    INNER JOIN order_items oi ON oi.order_id = o.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    WHERE o.order_id = co.order_id AND DATE(o.order_datetime) = CURDATE()
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

    public function approve_refund() {
        $oID = Field::post('order_id')->required();
        $sDate = Field::post('order_datetime')->required();
        $sAmount = Field::post('order_price')->required();
        if ($oID != null) {
            try {
            $oID = intval($oID->value());
            $sID = User_Model::user()['user_id'];
            // create entry in refund table
            $this->db->beginTransaction();
            $sQuery = 'INSERT INTO refund (refund_order, refund_date, refund_amount, refund_staff_id)
            VALUES (:order_id, :date, :amount, :staff_id)';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':order_id', $oID, PDO::PARAM_INT);
            $oStmt->bindValue(':date', $sDate->value(), PDO::PARAM_STR);
            $oStmt->bindValue(':amount', $sAmount->value(), PDO::PARAM_INT);
            $oStmt->bindValue(':staff_id', $sID, PDO::PARAM_INT);
            $oExecute = $oStmt->execute();
            $this->db->commit();
            echo "1 work";
            // die();
            // add link to customer order using refund ID
            $data = new Refund_Model(); 
            $data = $data->get_id($oID);
            // var_dump($data);
            $rID = intval($data['refund_id']);
            var_dump($rID);
            // var_dump($rID); var_dump($oID);
            echo "query 1 done";
            // do 2nd query 
            $this->db->beginTransaction();
            $sQuery = 'UPDATE customer_order SET refund_refund_id = :refund_id WHERE order_id = :order_id';
            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':refund_id', $rID, PDO::PARAM_INT);
            $oStmt->bindValue(':order_id', $oID, PDO::PARAM_INT);
            $oStmt->execute();
            $this->db->commit();
            echo "committed";
            // header("Location: /staff/manager");            
            } catch (PDOException $e) {
                // header("Location: /staff/manager");
                var_dump($e);
                exit();
            }
        }
        header("Location: /staff/manager");
        exit();
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
        $sQuery = 'SELECT *
            FROM staff s
            INNER JOIN user u
            WHERE s.staff_user_id = u.user_id AND s.staff_role <> "Unemployed" ';
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

            header("Location:/staff/manager");
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

            header("Location:/staff/manager");
        } 
    }
    // get daily specials 
    public function get_daily_special() {
        $this->db->beginTransaction();
        $sQuery = "SELECT *
                    FROM daily_special ds
                    JOIN item i ON ds.item_id = i.item_id";
        $oStmt = $this->db->prepare($sQuery);
        $oExecute = $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        // $this->view='manager';
    }

    public function get_all_items() {
        $items = Food_Model::all();
        return $items;
    }

    public function get_all_menus() {
        $menus = Menu_Model::menu()->all();
        return $menus;
    }

    // edit daily special
    public function create_daily_special() {
        try {
            $iID = Field::post('item_id')->required();
            $mID = Field::post('menu_id')->required();
            $iID = $iID->sData;
            $mID = $mID->sData;
            echo "posts";
            intval($iID[0]);
            intval($mID[0]);
            var_dump($iID[0]);
            var_dump($mID[0]);
            $oDS = new DailySpecial_Model();
            echo "model made";
            $oDS->setDailySpecial($iID,$mID);
            echo "success"; 
            header("Location: /staff/manager");
        } catch (PDOException $e) {
            var_dump($e);
            exit();
        } 
        // header("Location: /staff/manager");
    }


    // get user profile
    public function get_profile() {
        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);
        if($oUser->exists()) {
            $type = $oUser->aData['user_type'];
            $oStaff = new Staff_Model($type, $oUser);
        }
        return $oStaff;
    }

    // staff page
    public function staff(){
        Auth_Core::init()->isAuth(true);
        if(Acl_Core::allow([ACL::ACL_STAFF,ACL::ACL_MANAGER,ACL::ACL_OWNER,ACL::ACL_ADMIN])){
            $this->template->stock = $this->get_ingredient_stock();
            $this->template->item_stock = $this->get_item_stock();
            $this->template->orders = $this->get_orders();
            $this->template->profile = $this->get_profile();
            $this->view = 'staff';
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
    }
    // reports page
    public function report() {
        Auth_Core::init()->isAuth(true);
        if(Acl_Core::allow([ACL::ACL_MANAGER,ACL::ACL_OWNER,ACL::ACL_ADMIN])){
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

    // manager page
    public function manager() {
        // $oAcl = new Acl_Core(ACL::ACL_MANAGER);
        Auth_Core::init()->isAuth(true);
        if(Acl_Core::allow([ACL::ACL_MANAGER,ACL::ACL_OWNER,ACL::ACL_ADMIN])){
            $this->template->get_ds = $this->get_daily_special();
            $this->template->get_i = $this->get_all_items();
            $this->template->get_m = $this->get_all_menus();
            $this->template->create_staff = $this->create_staff();
            $this->template->get_staff = $this->get_all_staff();
            $this->template->refund = $this->get_order_report();
            $this->view = 'manager';
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
       
    }
} 