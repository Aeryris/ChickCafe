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



class Checkout_Model extends Foundation_Model{

    public static $oInstance = null;

    public $iOrderId;

    public static function menu(){

        if(!self::$oInstance instanceof self){
            self::$oInstance = new self;
        }

        return self::$oInstance;
    }

    public function checkoutCard($iUserId, $aCardDetails){
        try{

            $sOrderQuery = 'INSERT INTO orders(order_datetime, order_price) VALUES(NOW(), :fullprice)';
            $oStmtOrder = $this->db->prepare($sOrderQuery);

            $oStmtOrder->bindValue(':fullprice', $aCardDetails['full-price']);

            $oStmtOrder->execute();

            $iOrderId = $this->db->lastInsertId();
            $this->iOrderId = $iOrderId;

            $sOrderItemsQuery = 'INSERT INTO order_items(item_id, order_id) VALUES(:itemid, :orderid)';
            $aBasketData = Basket_Model::basket()->view();
            foreach($aBasketData as $key => $value){
                $oOrderItemsStmt = $this->db->prepare($sOrderItemsQuery);
                $oOrderItemsStmt->bindValue(':itemid', $value['item_id']);
                $oOrderItemsStmt->bindValue(':orderid', $iOrderId);

                $oOrderItemsStmt->execute();
            }


            $sCustomerOrder = 'INSERT INTO customer_order(customer_id, order_id) VALUES(:cust_id, :orderid)';

            $oCustomerLink = $this->db->prepare($sCustomerOrder);
            $oCustomerLink->bindValue(':cust_id', $iUserId);
            $oCustomerLink->bindValue(':orderid', $iOrderId);
            $oCustomerLink->execute();

            Basket_Model::basket()->clear();

            $sQuery = 'INSERT INTO order_payment VALUES(:order_id, :name, :number, :cvc, :expiry)';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':order_id', $iOrderId);
            $oStmt->bindValue(':name', $aCardDetails['name']);
            $oStmt->bindValue(':number', $aCardDetails['number']);
            $oStmt->bindValue(':cvc', $aCardDetails['cvc']);
            $oStmt->bindValue(':expiry', $aCardDetails['expiry']);

            $oStmt->execute();


        }catch(Exception $e){

        }
    }

    public function checkout($iUserId, $iBasketId, $aPaymentData){

        //var_dump('UserId: '.$iUserId);
        //var_dump('iBasketId: '.$iBasketId);
        //var_dump($aPaymentData);

        try{
            $this->db->beginTransaction();



            $sQuery = 'INSERT INTO orders(order_datetime, order_price) VALUES(:odate, :price)';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':odate', $aPaymentData['payment_date']);
            $oStmt->bindValue(':price', $aPaymentData['mc_gross']);
            $oStmt->execute();
            $iOrderId = $this->db->lastInsertId();
            $this->iOrderId = $iOrderId;

            $sOrderItemsQuery = 'INSERT INTO order_items(item_id, order_id) VALUES(:itemid, :orderid)';
            $aBasketData = Basket_Model::basket()->view();
            foreach($aBasketData as $key => $value){
                $oOrderItemsStmt = $this->db->prepare($sOrderItemsQuery);
                $oOrderItemsStmt->bindValue(':itemid', $value['item_id']);
                $oOrderItemsStmt->bindValue(':orderid', $iOrderId);

                $oOrderItemsStmt->execute();
            }


            /**
             * Link order and customer
             */

            $sCustomerOrder = 'INSERT INTO customer_order(customer_id, order_id) VALUES(:cust_id, :orderid)';

            $oCustomerLink = $this->db->prepare($sCustomerOrder);
            $oCustomerLink->bindValue(':cust_id', $iUserId);
            $oCustomerLink->bindValue(':orderid', $iOrderId);
            $oCustomerLink->execute();

            Basket_Model::basket()->clear();



            //var_dump($aBasketData);





            $this->db->commit();
        }catch(Exception $e){
            $this->db->rollBack();
            var_dump($e);
        }


    }

    public static function process($iBasketId){

    }

} 