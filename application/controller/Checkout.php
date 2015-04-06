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

    public function process_card(){
        Auth_Core::init()->isAuth(true);
        $this->template->basket = Basket_Model::basket()->view();

        $totalPrice = 0;

        foreach(Basket_Model::basket()->view() as $key => $value){
            $totalPrice += ($value['item_price'] * $value['basket_items_quantity']);
        }



        if($_POST){
            $oCheckout = Checkout_Model::menu();
            $oUser = new User_Model();
            $oUser->attr(['email' => $_SESSION['user']]);
              $oCheckout->checkoutCard(
                  $oUser->aData['user_id'],
                array('number' => $_POST['number'],
                      'name' => $_POST['name'],
                      'cvc' => $_POST['cvc'],
                      'expiry' => $_POST['expiry'],
                      'full-price' => $_POST['full-price']
                )
            );
        }

        $this->template->totalPrice = $totalPrice;

        $this->view = 'checkout_card';
    }

    public function card(){
        Auth_Core::init()->isAuth(true);

        $aData = Basket_Model::basket()->view();
        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);

        $custom = $oUser->aData['user_id'].'-'.$aData[0]['basket_id'];



    }

    public function basket(){
        Auth_Core::init()->isAuth(true);
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


        $aData = Basket_Model::basket()->view();
        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);




        $paypal->set('custom', $oUser->aData['user_id'].'-'.$aData[0]['basket_id']);//userid-basketid
        $paypal->set('tax','0.99');
        $paypal->set('shipping','5.00');
        $paypal->set('cbt', 'Return to our site to validate your payment!'); # caption override for "Return to Merchant" button



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

        Auth_Core::init()->isAuth(true);
        $custom = explode('-', $_POST['custom']);

        $aPaymentData = [
            'mc_gross' => $_POST['mc_gross'],
            'address_status' => $_POST['address_status'],
            'payer_email' => $_POST['payer_email'],
            'payer_status' => $_POST['payer_status'],
            'payment_status' => $_POST['payment_status'],
            'payment_date' => $_POST['payment_date'],
            'protection_eligibility' => $_POST['protection_eligibility']
        ];


        $userId = $custom[0];
        $basketId = $custom[1];
        $oCheckout = new Checkout_Model();
        $this->checkout_status = $oCheckout->checkout($userId, $basketId, $aPaymentData);

        $this->view = 'checkout_processing';
    }


} 