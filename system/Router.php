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

class Router extends Router_Dispatcher implements Router_Interface, Router_Dispatcher_Interface{

    private $aRequestsParams;
    private $sScriptName;

    public $oRouterDispatcher;

    public $aRoutes;

    public function __construct(){
        $this->aRequestsParams = array_filter(explode('/', $_SERVER['REQUEST_URI']));
        $this->sScriptName = array_filter(explode('/',$_SERVER['SCRIPT_NAME']));
        $this->aRoutes = Routes::$aRoutes;
        //$oRouterDispatcher = new \Router_Dispatcher($this->aRequestsParams[0]);

    }
    public function run(){
        //$this->oRouterDispatcher->createControllerInstance('Index_Controller', 'e');
        $arrV = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));


        /**
         * Assume default route
         */
        if(empty($arrV)){
            $arrV[0] = explode('/', Routes::$aRoutes['default'])[0];
        }

        $this->prepareParams($arrV[0], array_filter(explode('/', $_SERVER['REQUEST_URI'])));
        //$this->dispatch();
    }



    public function __toString(){
        return $this->aRequestsParams;
    }
} 