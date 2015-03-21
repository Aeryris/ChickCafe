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

namespace System;


class System_Core {

    public static $sRootPath;

    private static  $sApplicationDir       = 'application';
    private static  $sSystemDir            = 'system';
    private static  $sModelDir             = 'model';
    private static  $sControllerDir        = 'controller';
    public  static  $sTemplateDir          = 'templates';
    public  static  $sTemplatePath;

    public  static  $sInterfaceDir         = 'interface';

    public  static  $sRoutesDir            = 'routes';
    public  static  $sRoutesPath;
    public  static  $sRoutesDefault        = 'default_routes.php';

    public  static  $sConfigDir            = 'config';
    public  static  $sConfigPath;

    public  static  $sConfigDefaultSection = 'chickcafe';

    public  static $sDefaultRoutesConfig;

    public  static $sApplicationPath;

    /**
     * Disable from normal instantiation of the object - use init
     */
    private function __construct($sPath){

    }

    public static function init($sPath){

        self::$sRootPath = $sPath;

        /**
         * Register class and modules autoloder
         */
        spl_autoload_extensions(".php");
        spl_autoload_register('\System\System_Core::loader');

        self::$sTemplatePath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sApplicationDir.DIRECTORY_SEPARATOR.self::$sTemplateDir.DIRECTORY_SEPARATOR;
        self::$sConfigPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sApplicationDir.DIRECTORY_SEPARATOR.self::$sConfigDir.DIRECTORY_SEPARATOR;
        self::$sDefaultRoutesConfig = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sApplicationDir.DIRECTORY_SEPARATOR.self::$sRoutesDir.DIRECTORY_SEPARATOR.self::$sRoutesDefault;
        self::$sRoutesPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sApplicationDir.DIRECTORY_SEPARATOR.self::$sRoutesDir;
        self::$sApplicationPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sApplicationDir.DIRECTORY_SEPARATOR;
        \Routes_Core::initWithRoutesPath(self::$sDefaultRoutesConfig);

    }


    /**
     * Method is used to autoload required php class files
     * @param $sClassName
     */
    public static function loader($sClassName){
        //var_dump($sClassName);
        /*
         * Last parameter of the array will determinate the type of the class (module, system, controller)
         */
        $aNaming = explode('_', $sClassName);
        if($sClassName == 'Application_Controller') return;

        /*
         * Determinate the type of required class file for inclusion
         */
        $sType = end($aNaming);
        //var_dump($sType);

        if(preg_match("/_Interface$|_Controller$|_Model$|_System$|_Core$/", $sClassName, $output_array)){
            $sType = end($aNaming);
            $aNaming = array_pop($aNaming);
        }



        if(is_array($aNaming)){
            //$sClassName = implode('_', $aNaming);
            //$sClassName = str_replace('-', '_', $sClassName);
        }

        $sClassName = preg_replace('/_Controller$|_Model$|_System$|_Core$/', '', $sClassName);
        //var_dump($sType);
        //if($sClassName == 'Index_Controller') $sClassName = 'Index';
        //if($sClassName == 'Base_Controller') $sClassName = 'Base';
        //if($sClassName == 'Error_Controller') $sClassName = 'Error';

        $sInclusionPath = '';

        if(       $sType == 'Controller'){
            $sInclusionPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sApplicationDir.DIRECTORY_SEPARATOR.self::$sControllerDir.DIRECTORY_SEPARATOR;
        } elseif( $sType == 'Model'){
            $sInclusionPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sModelDir.DIRECTORY_SEPARATOR;
        } elseif( $sType == 'System'){
            $sInclusionPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sSystemDir.DIRECTORY_SEPARATOR;
        } elseif( $sType == 'Interface'){
            $sInclusionPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sSystemDir.DIRECTORY_SEPARATOR.self::$sInterfaceDir.DIRECTORY_SEPARATOR;
        } elseif( $sType == 'Core'){ //Assume its a system file
            $sInclusionPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sSystemDir.DIRECTORY_SEPARATOR;
            //var_dump('Inclu');
            /**
             * @todo Add check for automatic class detection i.e if class is derrived from Controller etc
             */
        }else{
            $sInclusionPath = self::$sRootPath.DIRECTORY_SEPARATOR.self::$sSystemDir.DIRECTORY_SEPARATOR;
        }

        $sInclusionPath .= $sClassName.'.php';

        //var_dump($sInclusionPath);
        try{
            if(file_exists($sInclusionPath)){
                include($sInclusionPath);
            }else{
                //var_dump($sInclusionPath);
                //exit();
            }

        }catch (\Exception $e){
            throw new \Exception('Cannot Find file');
        }


    }


} 