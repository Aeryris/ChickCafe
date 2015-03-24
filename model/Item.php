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

interface Item_Menu_Interface{

    public static function get($iId);
    public function setName($sName);
    public function setDesc($sDesc);
    public function setStock($iStock);
    public function setAvailable($bAvailable);
    public function setPrice($dPrice);
    public function setPrepTime($sPrepTime);

    public function save();

}

class Item_Exception extends Exception{}

class Item_Model extends Foundation_Model implements Item_Menu_Interface{

    public $data;

    public $iItemId;

    public $db;

    public static $oInstance;

    public static function get($iId){

        if(!self::$oInstance instanceof self){
            self::$oInstance = new Item_Model($iId);
            var_dump('Item ID: '.$iId);
        }

        return self::$oInstance;
    }

    public function __construct($iId){
        $this->iItemId = $iId;
        $this->db = Database_Core::get();
        $this->getItemDetails();
        return $this;
    }

    public function getItemDetails(){

        try{

            $sQuery = 'SELECT * FROM item WHERE item_id = :id';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':id', $this->iItemId, PDO::PARAM_INT);

            $bExecute = $oStmt->execute();

            $this->data = $oStmt->fetch(PDO::FETCH_ASSOC);

        }catch(Item_Exception $e){
            throw new Item_Exception($e);
        }

        return $this;
    }

    public function setName($sName){


        return $this;
    }
    public function setDesc($sDesc){
        return $this;
    }
    public function setStock($iStock){
        return $this;
    }
    public function setAvailable($bAvailable){
        return $this;
    }
    public function setPrice($dPrice){
        return $this;
    }
    public function setPrepTime($sPrepTime){
        return $this;
    }

    public function save(){
        return $this;
    }


} 