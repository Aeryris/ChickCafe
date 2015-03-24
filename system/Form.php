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

class Form_Exception extends Exception{}

interface Form_Interface{
    public function __construct($aFields);
    public function validate();
    public function getErrors();
}

class Form_Core implements Form_Interface{

    public $sErrors;
    public $iErrorNo;
    public $sFieldData;

    public function __construct($aFields){
        foreach($aFields as $key => $value){
            $this->sFieldData[$value->sName] = $value;
        }

    }

    private function validateFields(){
        $this->checkRequired();
    }

    public function validate(){
        $this->validateFields();
        $this->validateRule();
        $this->validateEqualsTo();

        if($this->iErrorNo == 0){
            return true;
        }else{
            return false;
        }

        return true;
    }

    public function getErrors(){

    }

    private function checkRequired(){
        foreach($this->sFieldData as $key => $value){
            if($value->sRequired){
                if(empty($value->sData) || strlen($value->sData) == 0){
                    $this->iErrorNo++;
                    $this->sErrors .= 'Empty value of '.$value->sName.'<br />';
                }
            }
        }
    }

    private function validateRule(){
        foreach($this->sFieldData as $key => $value){
            if($value->sValidationRule != null && !empty($value->sData)){
                if(!preg_match($value->sValidationRule, $value->sData)){
                    $this->iErrorNo++;
                    $this->sErrors .= 'Field does not match the validation rule: '.$value->sName.'<br />';
                }
            }
        }
    }

    private function validateEqualsTo(){
        foreach($this->sFieldData as $key => $value){
            if($value->sEqualsToFieldName != null){
                if($value->sData != $this->sFieldData[$value->sEqualsToFieldName]->sData){
                    $this->iErrorNo++;
                    $this->sErrors .= $value->sName.' does not match '.$this->sFieldData[$value->sEqualsToFieldName]->sName.'<br />';
                }
            }
        }
    }




/**
    public $iError = 0;
    public $sErrors = '';

    public $sMethod;

    public $aFormData;

    public $aFormElements = array();

    public $aCurrentElement;

    public function __construct($sMethod = 'post', $aForm = null){
        if(!in_array($sMethod, array('post', 'get'))) throw new Form_Exception('Request method not supported');
        $this->sMethod = 'post';

        if($aForm == null){
            if($sMethod == 'post'){
                $this->aFormData = Input_Core::getPost();
            }else{
                $this->aFormData = Input_Core::getGet();
            }

        }else{
            $this->aFormData = $aForm;
        }

        return $this;
    }

    public function element($sName){
        if(isset($this->aFormData[$sName])) {
            $this->aFormElements[$sName] = $this->aFormData[$sName];
        }
        $this->aCurrentElement = $sName;
        return $this;
    }

    public function setTextFieldValueValidation($sFieldName, $sValidationRule){

    }

    public function validation($sValidationRule){

        return $this;
    }

    public function valueEqualsTo($sFieldName, $sConfirmFieldName){

    }

    public function equalsTo($sFieldName){
        return $this;
    }

    public function submit(){
        return $_POST;
    }

    public function required($bRequired = true){

        if($bRequired){
            if(!isset($this->aFormElements[$this->aCurrentElement]) && empty($this->aFormElements[$this->aCurrentElement])){
                $this->iError++;
                $this->sErrors = 'Empty value of '.$this->aCurrentElement;
                //var_dump('Empty value of '.$this->aCurrentElement);
            }
        }

        return $this;
    }

    public function value($sName){
        return $this->aFormElements[$sName];
    }

    public function setRequired($sName, $bRequired = true){

    }

*/

} 