<?php

/**
    The MIT License (MIT)

    Copyright (c) 2015 Bartlomiej Kliszczyk

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 */

/**
 * @author Bartlomiej Kliszczyk
 * @date 12-02-2015
 * @version 1.0
 * @license The MIT License (MIT)
 */


interface Order_Interface{
    public function get($iId); //Use it while updating order data
    public function make(); //Use it while creating order data
    public function setDate($sDate);
    public function setPrice($bPrice);
    public function setPriority($iPriority);
    public function setType($sType);
    public function save();
}


class Order_Model extends Foundation_Model implements  Order_Interface{

    public $data;

    public function all($iUserId = null){
        try{

           // $sQuery = 'SELECT * FROM customer_order AS co JOIN orders as o ON co.order_id = o.order_id JOIN order_items AS oi ON o.order_id = oi.order_id JOIN item AS i ON oi.item_id = i.item_id  WHERE co.customer_id = :cust_id';

            $sQuery = 'SELECT * FROM customer_order AS co JOIN orders as o ON co.order_id = o.order_id WHERE co.customer_id = :cust_id ORDER BY order_datetime DESC';

            $oStmt = $this->db->prepare($sQuery);

            $oUser = new User_Model();
            $oUser->attr(['email' => $_SESSION['user']]);


            $oStmt->bindValue(':cust_id', $oUser->aData['user_id']);

            $oStmt->execute();

            $this->data = $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){

        }

        return $this;
    }

    public function allByUnprocessed() {
        try{

           // $sQuery = 'SELECT * FROM customer_order AS co JOIN orders as o ON co.order_id = o.order_id JOIN order_items AS oi ON o.order_id = oi.order_id JOIN item AS i ON oi.item_id = i.item_id  WHERE co.customer_id = :cust_id';

            $sQuery = "SELECT * FROM customer_order AS co 
                        INNER JOIN orders as o ON co.order_id = o.order_id 
                        INNER JOIN order_items oi ON o.order_id = oi.order_id 
                        INNER JOIN user u ON u.user_id = co.customer_id
                        WHERE o.order_ready = 'F' AND DATE(o.order_datetime) = CURDATE() ORDER BY order_datetime DESC";

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->execute();

            $this->data = $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){

        }

        return $this;
    }

    public function allByPriority(){
        try{

            // $sQuery = 'SELECT * FROM customer_order AS co JOIN orders as o ON co.order_id = o.order_id JOIN order_items AS oi ON o.order_id = oi.order_id JOIN item AS i ON oi.item_id = i.item_id  WHERE co.customer_id = :cust_id';

            $sQuery = 'SELECT * FROM customer_order AS co JOIN orders as o ON co.order_id = o.order_id ORDER BY order_priority DESC ,  order_datetime DESC';

            $oStmt = $this->db->prepare($sQuery);

            $oUser = new User_Model();
            $oUser->attr(['email' => $_SESSION['user']]);



            $oStmt->execute();

            $this->data = $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){

        }

        return $this;
    }

    public function details($iOrderId){
        try{

            $sQuery = 'SELECT * FROM customer_order AS co JOIN orders as o ON co.order_id = o.order_id JOIN order_items AS oi ON o.order_id = oi.order_id JOIN item AS i ON oi.item_id = i.item_id  WHERE co.order_id = :cust_id ';

            //$sQuery = 'SELECT * FROM customer_order AS co JOIN orders as o ON co.order_id = o.order_id WHERE co.customer_id = :cust_id';

            $oStmt = $this->db->prepare($sQuery);



            $oStmt->bindValue(':cust_id', $iOrderId);

            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){

        }
    }



    public function get($iId){ //Use it while updating order data



    }
    public function make(){ //Use it while creating order data

    }
    public function setDate($sDate){

    }
    public function setPrice($bPrice){

    }
    public function setPriority($iPriority){

    }
    public function setType($sType){

    }
    public function save(){

    }

} 