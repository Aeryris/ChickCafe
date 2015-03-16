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

abstract class InputFilter{
    const Def = 0;
    const Int = 1;
    const Float = 2;
    const String = 3;
    const Numeric = 4;
    const Slashes = 5;
    const HtmlEntities = 6;
    const Sql = 7;
    const Email = 8;
    const Bool = 9;

}

class InputException extends Exception{}

class Input_Core implements Input_Interface{

    public static function get($sKey, InputFilter $sFilter = NULL){
        if(!isset($_GET[$sKey])) return;

        $sValue = $_GET[$sKey];

        if($sFilter != NULL)
            $sFilter = self::filter($sValue, $sFilter);

        $_GET[$sKey] = $sFilter;

        return $_GET[$sKey];
    }

    public static function post($sKey, InputFilter $sFilter = NULL){
        if(!isset($_POST[$sKey])) return;

        $sValue = $_POST[$sKey];

        if($sFilter != NULL)
            $sFilter = self::filter($sValue, $sFilter);

        $_POST[$sKey] = $sFilter;

        return $_POST[$sKey];
    }

    public static function filter($sValue, InputFilter $sFilter){ //int, float, string, numeric, default

        switch($sFilter){
            case InputFilter::Def:

                break;

            case InputFilter::Int:
                if(!filter_var($sValue, FILTER_VALIDATE_INT)){
                    throw new InputException('Value is not valid integer');
                }
                break;

            case InputFilter::Float:
                if(!filter_var($sValue, FILTER_VALIDATE_FLOAT)){
                    throw new InputException('Value is not valid float');
                }
                break;

            case InputFilter::Numeric:

                break;

            case InputFilter::String:

                break;

            case InputFilter::Email:
                if (!filter_var($sValue, FILTER_VALIDATE_EMAIL)) {
                    throw new InputException('Email is not valid');
                }
                break;

            case InputFilter::Bool:
                if (!filter_var($sValue, FILTER_VALIDATE_BOOLEAN)) {
                    throw new InputException('Value is not valid boolean');
                }
                break;

            default:

                break;
        }

        $sValue = self::secure($sValue);
        return $sValue;
    }

    public static function secure($sValue){

    }

    public static function setGet($sKey, $sValue){
        return $_GET[$sKey] = $sValue;
    }

    public static function setPost($sKey, $sValue){
        return $_POST[$sKey] = $sValue;
    }

    public static function getGet(){
        return $_GET;
    }

    public static function getPost(){
        return $_POST;
    }

} 