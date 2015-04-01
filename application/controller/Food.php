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



class Food_Controller extends Base_Controller{

    /**
     * List foods
     */
    public function view(){


        $oFoods = new Food_Model();

        $oIngredients = new Ingredients_Model();

        $this->template->oIngredients = $oIngredients;

        $this->template->all = $oFoods->all();

        $this->view = 'food_view';
    }

    public function edit(){

        $itemId = $_GET['id'];

        $oFood = new Food_Model();

        if(isset($_GET['remove'])){
            //var_dump($_GET);
            //var_dump('REMOVE: '.$_GET['remove']);

            $oFood->removeIngredient($itemId, $_GET['remove']);

        }

        if(isset($_POST['add'])){
            //var_dump($_POST);
            //var_dump('ADD: '.$_POST['add']);
            $oFood->addIngredient($itemId, $_POST['add']);
        }

        //var_dump($itemId);



        $oIngredients = new Ingredients_Model();

        $oIngredientsList = $oIngredients->ingredients($itemId);
        //var_dump($oIngredientsList);

        $this->template->allIngredients = $oIngredients->all();

        $this->template->ingredientsList = $oIngredientsList;


        $this->view = 'food_edit';

    }

} 