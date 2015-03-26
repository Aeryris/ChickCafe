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



class Basket_Controller extends Base_Controller{

    public function view(){

        Basket_Model::basket()->create();


        //var_dump(Item_Model::get('1')->iItemId);
        //Basket_Model::basket()->addItem(Item_Model::get('2')->iItemId);

        $this->template->basketItems = $aBasketData = Basket_Model::basket()->view();


        $this->view = 'basket_view';
    }

    public function basketData(){
        $this->isAjaxCall = true;
        $aBasketData = Basket_Model::basket()->view();
        echo json_encode(array('basket' => $aBasketData));
    }


    public function addToBasket(){
        $this->isAjaxCall = true;


        $aItemId = $_POST['item_id'];

        Basket_Model::basket()->addItem($aItemId);


        echo json_encode(array('Success' => $aItemId));
        exit();

    }

} 