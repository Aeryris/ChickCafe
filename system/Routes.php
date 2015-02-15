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



class Routes {

    public static  $sRoutesPath;

    public static $aRoutes;

    static $oInstance = null;

    public static function loadRoutes($sRoutes){
        self::$sRoutesPath = \System\System::$sRootPath.DIRECTORY_SEPARATOR.$sRoutes;

        include(self::$sRoutesPath);

        global $aRoutes;

        return $aRoutes;
    }

    private function __construct($aRoutes){
        self::$aRoutes = $aRoutes;
    }

    public static function initWithRoutes($aRoutes){

        if (!(self::$oInstance instanceof self)) {
            self::$oInstance = new self($aRoutes);
        }
        return self::$oInstance;
    }

    public static function initWithRoutesPath($sRoutesPath){

        if (!(self::$oInstance instanceof self)) {
            self::$oInstance = new self(array());
            self::$aRoutes = self::loadRoutes($sRoutesPath);
        }

        return self::$oInstance;
    }

    public function __toString(){
        return self::$aRoutes;
    }



} 