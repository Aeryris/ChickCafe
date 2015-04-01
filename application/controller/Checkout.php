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



class Checkout_Controller extends Base_Controller{

    public function basket(){

        $paypal = new GoPayPal(THIRD_PARTY_CART);
        $paypal->sandbox = true;
        $paypal->openInNewWindow = true;
        $paypal->set('business', 'chickcafe-merchant@gmail.com');
        $paypal->set('currency_code', 'GBP');
        $paypal->set('country', 'GB');
        $paypal->set('return', 'http://localhost:100/checkout/process');
        $paypal->set('cancel_return', 'http://localhost:100/basket/view');
        $paypal->set('notify_url', 'http://localhost:100/checkout/process'); # rm must be 2, need to be hosted online
        $paypal->set('rm', 2); # return by POST
        $paypal->set('no_note', 0);
        $paypal->set('custom', md5(time()));
        $paypal->set('tax','0.99');
        $paypal->set('shipping','5.00');
        $paypal->set('cbt', 'Return to our site to validate your payment!'); # caption override for "Return to Merchant" button


        $aData = Basket_Model::basket()->view();

        foreach($aData as $key => $value){
            $item = new GoPayPalCartItem();
            $item->set('item_name', $value['item_name']);
            $item->set('item_number', $value['item_id']);
            $item->set('quantity', $value['basket_items_quantity']);
            $item->set('amount',$value['item_price']);
            $paypal->addItem($item);
        }

        //echo $paypal->html();

        Basket_Model::basket()->create();



        $this->template->paypal =  $paypal->getHtml();
        $this->template->basketItems = $aBasketData = Basket_Model::basket()->view();



        $this->view = 'checkout';
    }


    public function process()
    {


        /**
         * @todo move the basket to the orders
         */


        $this->view = 'checkout_processing';

        /**  if(sizeof($_POST)){
            echo '<h3>POST</h3>';
            echo '<pre>'; print_r($_POST); echo '</pre>';
        }
        if(sizeof($_GET)){
            echo '<h3>GET</h3>';
            echo '<pre>'; print_r($_GET); echo '</pre>';
        }

        $sQuery = 'INSERT INTO orders(order_price) VALUES(100.0)';
        $stm = $this->db->prepare($sQuery);
        $stm->execute(); */
    }


} 