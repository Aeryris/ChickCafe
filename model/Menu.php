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



interface Menu_Interface{


    public function add();
    public function remove();

    public function get($iId);
    public function setName($sName);
    public function setStartTime($sStartTime);
    public function setEndTime($sEndTime);
    public function save();
    public function data();

}

class Menu_Exception extends  Exception{}

class Menu_Model extends Foundation_Model implements Menu_Interface {

    public $name;
    public $startTime;
    public $endTime;

    public $id;
    public $data;

    public $type;

    public static $oInstance = null;

    public $bIsNew = false;

    public function add(){
        $this->bIsNew = true;
        return $this;
    }
    public function remove(){

    }

    public static function menu(){

        if(!self::$oInstance instanceof self){
            self::$oInstance = new self;
        }

        return self::$oInstance;
    }

    public function all(){
        $sQuery = 'SELECT * FROM menu ';

        $oStmt = $this->db->prepare($sQuery);

        $oStmt->execute();

        return $oStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function menuTypes(){
        $sQuery = 'SELECT * FROM menu_type';

        $oStmt = $this->db->prepare($sQuery);

        $oStmt->execute();

        return $oStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function current(){
        try{

            $sQuery = 'SELECT * FROM Menu WHERE menu_time_start <= NOW() AND menu_time_end >= NOW()';

            $oStmt = $this->db->prepare($sQuery);
            $bExecute = $oStmt->execute();

            $this->data = $oStmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            throw new Menu_Exception($e);
        }

        return $this;
    }

    public function get($iId){

        $this->bIsNew = false;

        try{

            $sQuery = 'SELECT * FROM menu WHERE menu_id = :id';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $oExecute = $oStmt->execute();

            $this->data  = $oStmt->fetch(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            var_dump($e);
            exit();
        }

        return $this;

    }
    public function setName($sName){
        $this->name = $sName;
        return $this;
    }
    public function setStartTime($sStartTime){
        $this->startTime = $sStartTime;
        return $this;
    }
    public function setEndTime($sEndTime){
        $this->endTime = $sEndTime;
        return $this;
    }

    public function save(){

        if($this->bIsNew){
            $this->insert();
        }else{
            $this->update();
        }



        return $this;
    }


    private function insert(){
        try{

            $this->db->beginTransaction();


            $sQuery = 'INSERT INTO menu(menu_name, menu_time_start, menu_time_end) VALUES(:name, :start, :end)';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $oStmt->bindValue(':start', $this->startTime, PDO::PARAM_STR);
            $oStmt->bindValue(':end', $this->endTime, PDO::PARAM_STR);

            $bExecuted = $oStmt->execute();

            $this->db->commit();

        }catch(Exception $e){
            $this->db->rollBack();
            throw new Menu_Exception($e);
        }
    }

    private function update(){
        try{

            $this->db->beginTransaction();


            $sQuery = 'UPDATE menu SET menu_name = :name, menu_time_start = :start, menu_time_end = :end WHERE menu_id = :id)';


            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $oStmt->bindValue(':start', $this->startTime, PDO::PARAM_STR);
            $oStmt->bindValue(':end', $this->endTime, PDO::PARAM_STR);
            $oStmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            $bExecuted = $oStmt->execute();

            $this->db->commit();

        }catch(Exception $e){
            $this->db->rollBack();
            throw new Menu_Exception($e);
        }
    }

    public function data(){
        return $this->data;
    }

    public function getMenuTypes(){

        $sQuery = 'SELECT * FROM menu_type  RIGHT JOIN menu_types ON menu_type.menu_type_id = menu_types.id';
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->execute();

        return $oStmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function linkWithType($sType, $iMenuId){

    }



} 