<?php

class Staff_Controller extends Base_Controller{

    // approve ingredient stock
    public function get_ingredient_stock() {
        $this->db->beginTransaction();
        $sQuery = "SELECT *
                    FROM ingredient";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    // approve item stock
    public function get_item_stock() {
        $sQuery = "SELECT *
                    FROM item";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    // get all orders
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
    // sets an order to ready and sends a notif to customer
    public function ready_order() {
        try {
            $oID = Field::post('order_id')->required();
            $sID = User_Model::user()['user_id'];
            // var_dump($sID);
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
                $this->db->beginTransaction();
                $sQuery = "SELECT user_id FROM user u 
                            INNER JOIN customer_order co ON co.customer_id = u.user_id
                            INNER JOIN orders o ON co.order_id = :order_id LIMIT 1";
                $oStmt = $this->db->prepare($sQuery);
                $oStmt->bindValue(':order_id', $oID->value(), PDO::PARAM_INT);
                // var_dump($oStmt);
                $oStmt->execute();
                // echo "do i execute a query?";
                $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
                $uID = $data[0]['user_id'];
                // var_dump($uID);
                // die();
                $oNotification = new Notification_Model();
                $oNotification->setMsgToUserId($uID, 'Your order is now ready! 
                    Show your <a class="order-link" href="/order/view/id/'.$oID->value().'">(view) to a staff memeber to collect it!');
                $this->view='manager';
            }
        } catch (Exception $e) {
            echo $e->message();
            die();
        }
    }
    // generate order report
    public function get_order_report() {
        $sQuery = "SELECT * FROM orders o
                    INNER JOIN customer_order co ON o.order_id = co.order_id
                    JOIN customer cu ON co.customer_id = cu.customer_user_id
                    INNER JOIN user u ON cu.customer_user_id = u.user_id
                    INNER JOIN order_items oi ON oi.order_id = o.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    WHERE o.order_id = co.order_id AND order_ready ='T'
                    ORDER BY o.order_datetime ASC "; 
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
    // generate customer spending report
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
    // generate refund report
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
    // generate stock report
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
    // generate todays list of orders
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
    // generate processed orders that can be refunded 
    public function get_today_order_refund() {
        $sQuery = "SELECT *
                    FROM orders o
                    INNER JOIN customer_order co ON o.order_id = co.order_id
                    JOIN customer cu ON co.customer_id = cu.customer_user_id
                    INNER JOIN user u ON cu.customer_user_id = u.user_id
                    INNER JOIN order_items oi ON oi.order_id = o.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    WHERE o.order_id = co.order_id AND DATE(o.order_datetime) = CURDATE() AND order_ready = 'T';
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
        $finalOrders = array();
        foreach($orders as $orderID => $set) {
            $finalOrders[] = $set[0];
        }
        return $finalOrders;   
    }
    // generate orders that aren't ready yet
    public function get_unprocessed_order() {
        $sQuery = "SELECT *
                    FROM orders o
                    INNER JOIN customer_order co ON o.order_id = co.order_id
                    JOIN customer cu ON co.customer_id = cu.customer_user_id
                    INNER JOIN user u ON cu.customer_user_id = u.user_id
                    INNER JOIN order_items oi ON oi.order_id = o.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    WHERE o.order_id = co.order_id AND DATE(o.order_datetime) = CURDATE() AND o.order_ready = 'F'
                    ORDER BY o.order_datetime AND o.order_priority DESC"; 
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
                    'item_name' => $value['item_name'],
                    'item_preptime' => $value['item_preptime']
                ];
                $orders[$orderID][0]['items'][] = $theItem;
                $orders[$orderID][0]['item_names'][] = $value['item_name'];
                $orders[$orderID][0]['item_preptimes'][] = $value['item_preptime'];
                unset(
                    $orders[$orderID][0]['item_name'],
                    $orders[$orderID][0]['item_preptime']
                );
            }
        }
        $finalOrders = array();
        foreach($orders as $orderID => $set) {
            $finalOrders[] = $set[0];
        }
        return $finalOrders;   
    }
    // single staff performance report
    public function single_staff_performance_report() {
        $sID = User_Model::user()['user_id'];
        $sQuery = "SELECT * FROM staff s
                        INNER JOIN user u ON s.staff_user_id = :staff_id
                        INNER JOIN orders o ON u.user_id = :staff_id
                        INNER JOIN order_items oi WHERE o.order_id = oi.order_id
                        GROUP BY o.order_staff_id";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->bindValue(':staff_id',$sID,PDO::PARAM_INT);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data; 
    }
    // do calculations for staff performance report
    public function single_staff_calc() {
        $staffPerf = $this->single_staff_performance_report();
        $data = null;
        foreach ($staffPerf as $key => $value) {
            $sID = User_Model::user()['user_id'];
            $sQuery = "SELECT * FROM orders o
                    INNER JOIN order_items oi ON o.order_id = oi.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    INNER JOIN staff s WHERE o.order_staff_id = :staff_id 
                    AND o.order_ready = 'T' GROUP BY o.order_id";
            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':staff_id',$sID,PDO::PARAM_INT);
            $oStmt->execute();
            $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
            $calc = [];
            $itemprep = 0;
            $ordervalue = 0;
            $ordersmade = 0;
            $item_count = 1;
            foreach ($data as $key => $value) {
                if ($item_count != 1) {
                    $itemprep = ($itemprep + $value['item_preptime']) / $item_count;
                } else {
                    $itemprep = $itemprep + $value['item_preptime'];
                }  
                $item_count = $item_count + 1;
                $ordersmade += 1;
                $ordervalue += $value['order_price'];
                $calc = [
                    'item_total_prep' => $itemprep,
                    'order_value' => $ordervalue,
                    'orders_made' => $ordersmade
                ];
            }   
            $data = $calc;
        return $data;
        }
    }
    // staff performance report
    public function staff_performance_report() {
        $sQuery = "SELECT *
                    FROM staff s
                    INNER JOIN user u ON s.staff_user_id = u.user_id";
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    // generate calc for staff performance report
    public function all_staff_calc() {
        $staffPerf = $this->staff_performance_report();
        $results = []; // Array to store all results
		
		// For each staff member
        foreach ($staffPerf as $key => $value) {
            $sID = $value['user_id'];
            $sQuery = "SELECT * FROM orders o
                    INNER JOIN order_items oi ON o.order_id = oi.order_id
                    INNER JOIN item i ON oi.item_id = i.item_id
                    INNER JOIN user u ON u.user_id = o.order_staff_id
                    INNER JOIN staff s WHERE o.order_staff_id = :staff_id AND 
                    o.order_ready = 'T' GROUP BY o.order_id";
            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':staff_id',$sID,PDO::PARAM_INT);
            $oStmt->execute();
            $data = $oStmt->fetchAll(PDO::FETCH_ASSOC);
            $itemprep = 0;
            $ordervalue = 0;
            $ordersmade = 0;
            $item_count = 0;
			
			// For each order/database row
            foreach ($data as $key => $value) {
               // $sID = $value['staff_user_id'];
               // if ($last_staff_member_id != $value['staff_user_id']) { 
                   // if ($value['order_id'] != $lastOrderId) { // Order IDs are unique because of the GROUP BY
                        $ordersmade += 1;
                        $ordervalue = $ordervalue + $value['order_price'];
                        $item_count += 1;
                        if ($item_count != 0) {
                        $itemprep = ($itemprep + $value['item_preptime']) / $item_count;
                        } else {
                            $itemprep = ($itemprep + $value['item_preptime']);
                        } 
                  //  }
                  //  $lastOrderId = $value['order_id'];
               //}
               // $last_staff_member_id = $value['staff_user_id'];
            }
				  
			$results[] = array(
				'staff_user_id' => $sID,
				'staff_name' => $value['user_firstname'] . ' ' . $value['user_lastname'],
				'item_total_prep' => $itemprep,
				'order_value' => $ordervalue,
				'orders_made' => $ordersmade
			);
        }
		
		// Return all results
		return $results;
    }
    // approve a refund for an order
    public function approve_refund() {
        $oID = Field::post('order_id')->required();
        $sAmount = Field::post('order_price')->required();
        if ($oID != null) {
            try {
            $oID = intval($oID->value());
            $sID = User_Model::user()['user_id'];
            // create entry in refund table
            $this->db->beginTransaction();
            $sQuery = 'INSERT INTO refund (refund_order, refund_date, refund_amount, refund_staff_id)
            VALUES (:order_id, NOW(), :amount, :staff_id)';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':order_id', $oID, PDO::PARAM_INT);
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
            $this->view='manager';          
            } catch (PDOException $e) {
                // header("Location: /staff/manager");
                var_dump($e);
                exit();
            }
        }
        header("Location: /staff/manager");
        exit();
    }
    // create a staff member
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
    // get all staff
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
    // get a single staff member and return db get as json
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
    // modify staff
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
    // lock staff out of their account by setting their password field to blank
    public function delete_staff() {
    $sID = Field::post('staff_id')->required();
        if ($sID != null) {
            $sRole = 'Unemployed';
            $sSalary = '0';
            $sPassword = ' ';

            $this->db->beginTransaction();
            $sQuery = 'UPDATE staff SET staff_role = :role
                                        staff_salary = :salary
                                        WHERE staff_user_id = :id';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindParam(':role', $sRole, PDO::PARAM_STR);
            $oStmt->bindParam(':salary', $sSalary, PDO::PARAM_INT);
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
    // get all items
    public function get_all_items() {
        $items = new Food_Model();
        return $items->all();
    }
    // get all menus
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
            // echo "model made";
            $oDS->setDailySpecial($iID,$mID);
            // echo "success"; 
            $this->view='manager';
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
            $this->template->orders = $this->get_unprocessed_order();
            $this->template->profile = $this->get_profile();
            $this->template->performance = $this->single_staff_calc();
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
            $this->template->today_order = $this->get_unprocessed_order();  
            $this->template->performance = $this->all_staff_calc();            
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
            $this->template->get_staff = $this->get_all_staff();
            $this->template->refund = $this->get_today_order_refund();
            $this->view = 'manager';
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
       
    }
} 