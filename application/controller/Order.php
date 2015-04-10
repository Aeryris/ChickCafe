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



class Order_Controller extends Base_Controller{
    // view orders
    public function view(){
        Auth_Core::init()->isAuth(true);

        $oOrders = new Order_Model();

        $orderData = $oOrders->all()->data;

        if(isset($_GET['id'])){
            $orderData = $oOrders->details($_GET['id']);
        }

        //var_dump($orderData);



        $this->template->order = $oOrders;
        $this->template->oOrdersData = $orderData;


        $this->view = 'order_view';
    }
    // all orders
    public function all(){

        Auth_Core::init()->isAuth(true);

        $oOrders = new Order_Model();

        $orderData = $oOrders->allByPriority()->data;
        $this->template->order = $oOrders;
        $this->template->oOrdersData = $orderData;

        $this->view = 'order_all';
    }
    // late orders
    public function late() {

        Auth_Core::init()->isAuth(true);

        $oOrders = new Order_Model();
        $lateOrderData = $oOrders->allByUnprocessed()->data;

        $lateOrderCount = 0;

        $this->template->order = $oOrders;
        $this->template->lateOrderData = $lateOrderData;
        $this->template->lateOrderCount = $lateOrderCount;

        $this->view = 'order_late';

    }
    // refund get?
    public function refund(){
        Auth_Core::init()->isAuth(true);

        $iOrderId = Input_Core::get('id');

    }

} 