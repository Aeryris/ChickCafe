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



class Ingredients_Controller extends Base_Controller implements Base_Controller_Interface{


    public function view(){

        $oIngredients = new Ingredients_Model();
        $this->template->all = $oIngredients->all();

        $this->view = 'ingredients_view_new';
    }
    
    // edit ingredients
    public function edit(){

            $ingredientId = $_GET['id'];

        $oIngredients = new Ingredients_Model();
        $this->template->ing = $oIngredients->ingredient($ingredientId);
        if(Acl_Core::allow([ACL::ACL_MANAGER,ACL::ACL_OWNER,ACL::ACL_ADMIN])){
            $this->view = 'ingredients_edit';
        } else {
            header('Location: /error403'); //Forbidden
            exit();
        }
    }

    // reorder stock
    public function order(){


        $ingredientId = $_GET['id'];

        $oIngredients = new Ingredients_Model();

        if($_POST){
            $iQuantity = $_POST['order'];

            $this->template->error = $oIngredients->order($ingredientId, $iQuantity);
        }





        $this->template->ing = $oIngredients->ingredient($ingredientId);


        $this->view = 'ingredients_edit';

    }

    // add ingredients
    public function add(){

        $oFood = new Ingredients_Model();
        $error = '';
        if($_POST){
            //var_dump($_POST);
            $error = $oFood->add($_POST);
        }

        $this->template->error = $error;


        $this->view = 'ingredient_add';
    }


} 