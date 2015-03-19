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

interface User_Model_Interface{
    public function get($iId);
    public function add();

    public function setType(UserType_Model $sType);
    public function setFirstName($sFirstName);
    public function setLastName($sLastName);
    public function setEmail($sEmail);
    public function setPassword($sPassword);

    public function save($fCompletion);

    public function updateData();

    public function insertData();

    public function check(); //basic id check

    public function checkAttr($aAttr);

}

class User_Model extends Foundation_Model implements User_Model_Interface{

    public $type;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $id;
    private $isNew;



    public function get($iId){
        $this->isNew = false;
        /**
         * Populate data into the instance variables
         */

        $this->id = $iId;

        return $this;
    }

    public function add(){
        $this->isNew = true;
        return $this;
    }

    public function setType(UserType_Model $sType){
        $this->type = $sType;
        return $this;
    }

    public function setFirstName($sFirstName){
        $this->firstName = $sFirstName;
        return $this;
    }

    public function setLastName($sLastName){
        $this->lastName = $sLastName;
        return $this;
    }

    public function setEmail($sEmail){
        $this->email = $sEmail;
        return $this;
    }

    public function setPassword($sPassword){
        $this->password = $sPassword;
        return $this;
    }

    public function save($fCompletion = ''){
        if($this->isNew){
            $this->insertData();
        }else{
            $this->updateData();

        }
    }

    public function updateData(){

        try{



            $this->db->beginTransaction();
            $sQuery = 'UPDATE user SET user_type = :usertype,
                                   user_firstname = :firstname,
                                   user_lastname = :lastname,
                                   user_email = :email,
                                   user_password = :password
                                   WHERE user_id = :id';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindParam(':usertype', $this->type->type, PDO::PARAM_STR);
            $oStmt->bindParam(':firstname', $this->firstName, PDO::PARAM_STR);
            $oStmt->bindParam(':lastname', $this->lastName, PDO::PARAM_STR);
            $oStmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $oStmt->bindParam(':password', $this->password, PDO::PARAM_STR);
            $oStmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $oExecute = $oStmt->execute();

           // print_r($oExecute);

            $this->db->commit();
        }catch(PDOException $e){
            $this->db->rollBack();
            var_dump($e);
            exit();
        }
    }

    public function insertData(){
        try{
            $this->db->beginTransaction();

            $sQuery = 'INSERT INTO user(user_type,
                                        user_firstname,
                                        user_lastname,
                                        user_email,
                                        user_password)
                       VALUES(:user_type,
                              :firstname,
                              :lastname,
                              :email,
                              :password)';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindParam(':user_type', $this->type->type, PDO::PARAM_STR);
            $oStmt->bindParam(':firstname', $this->firstName, PDO::PARAM_STR);
            $oStmt->bindParam(':lastname', $this->lastName, PDO::PARAM_STR);
            $oStmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $oStmt->bindParam(':password', $this->password, PDO::PARAM_STR);

            $oExecute = $oStmt->execute();

            if(!empty($this->type) || $this->type != null){

                $lastId = $this->db->lastInsertId();

                $sQuery = 'UPDATE staff SET staff_role = :role,
                                        staff_salary = :salary,
                                        staff_phone_number = :number
                                         WHERE staff_user_id = :id';

                $oStmt = $this->db->prepare($sQuery);
                $oStmt->bindParam(':role', $this->type->role, PDO::PARAM_STR);
                $oStmt->bindParam(':salary', $this->type->salary, PDO::PARAM_STR);
                $oStmt->bindParam(':number', $this->type->phoneNumber, PDO::PARAM_STR);
                $oStmt->bindParam(':id', $lastId, PDO::PARAM_INT);

                $oExecute = $oStmt->execute();
            }



            $this->db->commit();
        }catch (PDOException $e){
            $this->db->rollBack();
            var_dump($e);
            exit();
        }

    }

    public function check(){

        try{

            $sQuery = 'SELECT count(*) FROM user WHERE user_id = :id';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $oExecute = $oStmt->execute();

            $aData  = $oStmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($aData);
        }catch(PDOException $e){
            var_dump($e);
            exit();
        }

        return $this;
    }

    /**
     * @param $aAttr
     * {
     *   fieldname => value,
     *   fieldname => value
     * }
     */
    /**
     *
     * @todo fix multiple $aAttributes - ->BindValue does not bind the value
     */
    public function checkAttr($aAttr){
        try{

            $sQuery = "SELECT * FROM user WHERE ";

            foreach($aAttr as $key => &$value){
                $sQuery .= "user_".$key. " = :". $key. " AND ";
            }

            $sQuery = rtrim($sQuery, "AND \t\n ");

            $oStmt = $this->db->prepare($sQuery);

            foreach($aAttr as $key => $value){
                $oStmt->bindValue(":$key", $value);
            }
            //var_dump($oStmt);
            $oExecute = $oStmt->execute();

            $aData  = $oStmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($oStmt->debugDumpParams());


        }catch (PDOException $e){

        }

        return $this;
    }

} 