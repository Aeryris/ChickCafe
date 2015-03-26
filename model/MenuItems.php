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


interface MenuItems_Interface{
    public function getByMenuId($iId);
    public function getByItemId($iId);
    public function get($iMenuId, $iItemId);
    public function getByName($sName);
    public function getByTime($sStart, $sEnd);
    public function data();
}

class MenuItems_Model extends Foundation_Model implements MenuItems_Interface {

    public static $oInstance;

    public $data;

    public static function menu(){

        if(!self::$oInstance instanceof self){
            self::$oInstance = new self;
        }

        return self::$oInstance;
    }

    public function getByMenuId($iId){

        try{

            $sQuery = 'SELECT * FROM menu as m JOIN menu_items as ms USING(menu_id) JOIN item USING(item_id) WHERE m.menu_id = :id';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindParam(':id', $iId);
            $oStmt->execute();

            $this->data = $oStmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){

        }

        return $this;

    }
    public function getByItemId($iId){

    }
    public function get($iMenuId, $iItemId){

    }

    public function getByName($sName){

    }
    public function getByTime($sStart, $sEnd){

    }

    public function data(){

        return $this->data;
    }

} 