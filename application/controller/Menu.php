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

    public $displayItem;

    public function view(){
        try{

            $oMenuItems = MenuItems_Model::menu()->getByMenuId($_GET['id']);
            $oIngredient = new Ingredients_Model();
            $this->displayItem = true;


            $this->template->oIngredients = $oIngredient;
            //$this->template->displayItem = $this->displayItem;
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

            if($_FILES['food_image']['name'])
            {
                //if no errors...
                if(!$_FILES['food_image']['error'])
                {
                    $valid_file = true;
                    //var_dump($_FILES);
                    //now is the time to modify the future file name and validate the file
                    $new_file_name = strtolower($_FILES['food_image']['tmp_name']); //rename file
                    if($_FILES['food_image']['size'] > (1024000)) //can't be larger than 1 MB
                    {
                        $valid_file = false;
                        $error = 'Oops!  Your file\'s size is to large.';
                    }

                    //if the file has passed the test
                    if($valid_file)
                    {
                        //move it to where we want it to be
                        move_uploaded_file($_FILES['food_image']['tmp_name'], \System\System_Core::$sRootPath.DIRECTORY_SEPARATOR.'food_images'.DIRECTORY_SEPARATOR.strtolower($_FILES['food_image']['name']));
                        $error = 'Congratulations!  Your file was accepted.';
                        $_POST['image'] = strtolower($_FILES['food_image']['name']);
                        $oMenu = Menu_Model::menu()
                            ->add()->setName($sName)
                            ->setStartTime($sStartTime)
                            ->setEndTime($sEndTime)
                            ->setImage($_POST['image'])
                            ->save();
                    }
                }
                //if there is an error...
                else
                {
                    //set that to be the returned message
                    $error = 'Ooops!  Your upload triggered the following error:  '.$_FILES['food_image']['error'];
                }
            }





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

        $error = '';

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

        if(isset($_GET['change']) && isset($_POST['change-time'])){
            $error = MenuItems_Model::menu()->changeTime($menuId, $_POST['menu_start_time'], $_POST['menu_end_time']);
        }

        $oIngredients = new Ingredients_Model();

        $menuItems = MenuItems_Model::menu()->getByMenuId($menuId);
        //var_dump($menuItems);
        $this->template->foodLists = $menuItems->data;

        $d = $menuItems->data;

        $this->template->menu_start_time = $d[0]['menu_time_start'] ? $d[0]['menu_time_start'] : '';
        $this->template->menu_end_time = $d[0]['menu_time_end'] ? $d[0]['menu_time_end'] : '';

        $this->template->error = $error;
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