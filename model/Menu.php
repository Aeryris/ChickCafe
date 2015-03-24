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

}

class Menu_Model extends Foundation_Model implements Menu_Interface {



    public function add(){

    }
    public function remove(){

    }

    public function get($iId){

        try{

            $sQuery = 'SELECT * FROM menu JOIN WHERE menu_id = :id';

            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $oExecute = $oStmt->execute();

            $this->aData  = $oStmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($aData);
        }catch(PDOException $e){
            var_dump($e);
            exit();
        }

        return $this;

    }
    public function setName($sName){

    }
    public function setStartTime($sStartTime){

    }
    public function setEndTime($sEndTime){

    }

    public function save(){

    }

} 