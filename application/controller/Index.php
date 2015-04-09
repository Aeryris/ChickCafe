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


class Index_Controller extends Base_Controller{

    // get latest daily special
    public function get_latest() {
        $db = Database_Core::get();
        $db->beginTransaction();
        $sQuery = "SELECT *
                    FROM daily_special ds
                    JOIN item i ON ds.item_id = i.item_id
                    ORDER BY daily_special_id DESC LIMIT 1";
        $oStmt = $db->prepare($sQuery);
        $oStmt->execute();
        $data = $oStmt->fetchAll(PDO::FETCH_ASSOC); 
        return $data;
    }

    public function index(){


        $this->template->test = 'Test var ';

        /**$oUser = new User_Model();
        $oUser->add()
                        ->setType(Staff_Model::get()->setRole('Retail')->setPhoneNumber(11111)->setSalary(100))
                        ->setFirstName('Bartek')
                        ->setLastName('Lastname')
                        ->setEmail('email@email.com')
                        ->setPassword('password')
                        ->save();
         *
         */
        //var_dump($_SESSION);
        //var_dump(User_Model::user());

        //var_dump($oUser);


        //var_dump(Menu_Model::menu()->getMenuTypes());
        $this->template->menuTypes = Menu_Model::menu()->getMenuTypes();

        $oMenu = Menu_Model::menu()->current();

        $this->template->oMenu = $oMenu;

        $this->template->dailySpecial = $this->get_latest();

        $this->view = 'index_new';
    }

    public function e(){
        $this->view = 'index';
    }

} 