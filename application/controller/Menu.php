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



class Menu_Controller extends Base_Controller{

    public function index(){

        $oMenu = Menu_Model::menu()->current();

        $this->template->oMenu = $oMenu;

        //$oMenuItems = MenuItems_Model::menu()->getByMenuId(1);
        $this->view = 'menu';
    }

    public function view(){
        try{

            $oMenuItems = MenuItems_Model::menu()->getByMenuId($_GET['id']);

            $this->template->menuItems = $oMenuItems;

            $this->view = 'menu_view';

        }catch(Exception $e){

        }
    }

    public function breakfast(){

    }

    public function lunch(){

    }

    public function dinner(){

    }

    public function drinks(){

    }

    public function all()
    {

        $oMenu = Menu_Model::menu();

        $this->template->all = $oMenu->all();

        $this->view = 'menu_all';
    }

    public function add(){


        if($_POST){


            $sName = $_POST['menu_name'];
            $sStartTime = $_POST['menu_start_time'];
            $sEndTime = $_POST['menu_end_time'];
            $sMenuType = $_POST['menu_type'];

            $oMenu = Menu_Model::menu()
                ->add()->setName($sName)
                ->setStartTime($sStartTime)
                ->setEndTime($sEndTime)
                ->save();



        }

        $oMenu = Menu_Model::menu();

        $this->template->types = $oMenu->getMenuTypes();


        $this->view = 'menu_add';
    }

    public function addFood(){

        $menu = $_GET['id'];
        $food = $_GET['food'];

    }

    public function removeFood(){

        $menu = $_GET['id'];
        $food = $_GET['food'];



    }

    public function edit(){

        $menuId = $_GET['id'];
        if(!isset($menuId)){
            header('/menu/all');
            exit();
        }

        if(isset($_GET['remove'])){
            $removeId = $_GET['remove'];
            MenuItems_Model::menu()->remove($menuId, $removeId);
        }else if(isset($_GET['add'])){
            $addId = $_POST['food'];
            MenuItems_Model::menu()->add($menuId, $addId);

        }

        $oIngredients = new Ingredients_Model();

        $menuItems = MenuItems_Model::menu()->getByMenuId($menuId);

        $this->template->foodLists = $menuItems->data;

        $oFood = new Food_Model();
        $this->template->allFoods = $oFood->all();
        //var_dump($menuItems);
        //var_dump($oFood->all());

        //var_dump($_GET);




        $this->view = 'menu_edit';
    }

    public function imageUpload(){
        $target_dir = "food_images/";
        $ds          = DIRECTORY_SEPARATOR;  //1

        $storeFolder = 'food_images';   //2

        if (!empty($_FILES)) {

            $tempFile = $_FILES['file']['tmp_name'];          //3

            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

            $targetFile =  $targetPath. $_FILES['file']['name'];  //5

            move_uploaded_file($tempFile,$targetFile); //6

        }

        //echo json_encode(array('result' => $result));
    }


} 