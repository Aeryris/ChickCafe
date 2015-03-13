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



class Router_Dispatcher implements Router_Dispatcher_Interface{

    public $sMainIndexMethod = 'index';

    public $oReflectionClass;

    public $aParams;

    public $sController;
    public $sAction;

    public function __construction(){
        //$this->oReflectionClass = new \Reflection($oClass);
    }

    public function prepareParams($sController, $aUriDetails){
        $aUriDetails = array_values($aUriDetails);
        $sController = $sController.'_Controller';
        $sController = ucwords($sController);

        $oObject = new $sController;

        $oClassReflection = new ReflectionClass($oObject);

        //controller/action/param/value/param/value

        /**
         * Get Controller
         */
        if(isset($aUriDetails[0])){
            $this->sController = $aUriDetails[0];
        }


        $iParameterStartIndex = 2;

        /**
         * Get action if not specified assume $sMainIndexMethod
         */
        if(isset($aUriDetails[1]) && $oClassReflection->hasMethod($aUriDetails[1]) ){
            $this->sAction = $aUriDetails[1];
        }else{
            //$this->sAction = $this->sMainIndexMethod;
            $iParameterStartIndex = 1;
            /**
             * Final check if method exists
             */
            if(!$oClassReflection->hasMethod($this->sAction)){
                var_dump('Location: /error/notfound');
                exit();
            }
        }

        /**
         * Prepare parameters
         */
        for($i = $iParameterStartIndex; $i < count($aUriDetails); $i++){
            Input::setGet($aUriDetails[$i], (isset($aUriDetails[$i+1]) ? $aUriDetails[$i+1] : null));
            $key =  filter_input(INPUT_GET, $aUriDetails[$i], FILTER_SANITIZE_SPECIAL_CHARS);
            $val = (isset($aUriDetails[$i+1]) ? $aUriDetails[$i+1] : null);

            $value = (isset($aUriDetails[$i+1]) ? filter_input(INPUT_GET, $aUriDetails[$i+1], FILTER_SANITIZE_SPECIAL_CHARS) : null);
            if($key != '' or $key != null)
                Input::setGet($key, $value);
            //$_GET[$aUriDetails[$i]] = ;

            $i++;
        }

        //var_dump($oObject);
        $this->createControllerInstance($oObject, $this->sAction);
    }

    public function isControllerAvailable($sController){

    }

    public function createControllerInstance($sController, $sMethod){

        //$oObject = new $sController;

        if (method_exists($sController, $sMethod)) {
            $reflection = new \ReflectionMethod($sController, $sMethod);

            if (!$reflection->isPublic()) {
                header('Location: /error/notfound');
                //var_dump('Location: /error/notfound');
                exit();
            }
            //$oObject->$sMethod(self::$param, self::$id);
            $sController->$sMethod();

        } else {
            header('Location: /error/notfound');
            //var_dump('Method: /error/notfound');
            exit();
        }

    }


    public function getController(){

    }

    public function getAction(){

    }

} 