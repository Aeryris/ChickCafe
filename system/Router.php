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


/**
 * Class Router
 * /controller/action/param/value/param/value
 */

//require_once('Router_Dispatcher.php');

class Router_Core extends Router_Dispatcher_Core implements Router_Interface, Router_Dispatcher_Interface{

    private $aRequestsParams;
    private $sScriptName;

    public $oRouterDispatcher;

    public $aRoutes;

    public function __construct(){
        $this->aRequestsParams = array_filter(explode('/', $_SERVER['REQUEST_URI']));
        $this->sScriptName = array_filter(explode('/',$_SERVER['SCRIPT_NAME']));
        $this->aRoutes = Routes_Core::$aRoutes;
        //$oRouterDispatcher = new \Router_Dispatcher($this->aRequestsParams[0]);

    }
    public function run(){
        $arrV = array_values($this->aRequestsParams);


        /**
         * Assume default route
         */
        if(empty($arrV)){
            $arrV[0] = explode('/', Routes_Core::$aRoutes['default'])[0];
        }
        //var_dump($arrV);
        $this->prepareParams($arrV[0], $this->aRequestsParams);
        //$this->dispatch();
    }



    public function __toString(){
        return $this->aRequestsParams;
    }
} 