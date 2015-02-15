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



class Settings implements Settings_Interface{

    public static $aSettingsValues;

    public static $oInstance;

    public static function dbSettingWithKey($sKey){

    }

    public static function iniSettingWithKey($sKey){

        if (!(self::$oInstance instanceof self)) {
            self::$oInstance = new self();
            self::$aSettingsValues = self::loadDefaultConfigFile();
        }

        return self::$oInstance;
    }

    public static function loadFileWithNameWithSection($sName, $sSection){

        /*
         * @todo Add if file exists check
         */

        return parse_ini_file(\System\System::$sConfigDir.$sName, $sSection);
    }

    public static function loadDefaultConfigFile(){
        /*
         * @todo Add if file exists check
         * @todo Add check if section in ini exists
         */
        return parse_ini_file(\System\System::$sConfigDir.\System\System::$sConfigDir.DIRECTORY_SEPARATOR.'.ini', \System\System::$sConfigDefaultSection);
    }



} 