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

interface Staff_Interface{
    public function setRole($sRole);
    public function setSalary($dSalary);
    public function setPhoneNumber($iPhoneNumber);
    public function add();
}

class Staff_Model extends UserType_Model implements Staff_Interface {

    private static $instance;

    public $role;
    public $salary;
    public $phoneNumber;
    public $type = 's';
    protected $db;

    public static function get($type = 's')
    {
        if (!is_object(self::$instance)) {
            $c = get_called_class();
            self::$instance = new $c($type);
        }
        return self::$instance;
    }

    public function __construct($type, User_Model $oUser = null)
    {
        $this->db = Database_Core::get();
        $this->type = $type;
        if(!is_null($oUser)) {
            $this->loadAttributes($oUser);
        }
    }

    private function loadAttributes(User_Model $oUser)
    {

        //var_dump($oUser);
        $staffID = $oUser->aData['user_id'];
        //var_dump($staffID);
        try {
            $sQuery = "SELECT * FROM staff WHERE staff_user_id = :staffID";
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(":staffID", $staffID);

            $oExecute = $oStmt->execute();
            //var_dump($oStmt->fetch(PDO::FETCH_ASSOC));
            $this->aData = $oStmt->fetch(PDO::FETCH_ASSOC);

            $this->pushAttributesToObject();

        } catch(Exception $ex) {
            echo("Some bad error occured.");
            var_dump($ex->getMessage());
        }
    }

    private function pushAttributesToObject()
    {
        $ignored = [
            'staff_user_id'
        ];

        if(empty($this->aData)) return $this;

        foreach($this->aData as $key => $value) {
            if(in_array($key, $ignored)) {
                continue;
            }
            $key = $this->prepareKeyName($key);
            $this->$key = $value;
        }
        return $this;
    }

    private function prepareKeyName($key) {
        $key = str_replace('staff_', '', $key);
        $key = explode('_', $key);
        $parts = [];
        foreach($key as $index => $part) {
            if($index >= 1){
                $part = ucWords($part);
            }
            $parts[] = $part;
        }
        $key = implode('', $parts);
        return $key;
    }
    
    public function add(){
        $this->isNew = true;
        return $this;
    }
    
    public function setRole($sRole){
        $this->role = $sRole;
        return $this;
    }

    public function setSalary($dSalary){
        $this->salary = $dSalary;
        return $this;
    }

    public function setPhoneNumber($iPhoneNumber){
        $this->phoneNumber = $iPhoneNumber;
        return $this;
    }

    public function attr($aAttr){
        try{

            $sQuery = "SELECT * FROM user WHERE ";

            foreach($aAttr as $key => $value){
                $sQuery .= "user_".$key. " = :". $key. " AND ";
            }

            $sQuery = rtrim($sQuery, "AND \t\n ");
            //var_dump($sQuery);
            $oStmt = $this->db->prepare($sQuery);

            foreach($aAttr as $key => $value){
                $oStmt->bindValue(":$key", $value);
            }
            //var_dump($aAttr);
            $oExecute = $oStmt->execute();

            $this->aData = $oStmt->fetch(PDO::FETCH_ASSOC);



        }catch (PDOException $e){

        }

        return $this;
    }
} 