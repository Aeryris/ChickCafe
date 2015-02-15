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



interface Template_Interface {

    public function __construct($sName, $sPath = '');

    /**
     * Assing template file to variable
     * @param string $TemplateName
     */
    public function assignTemplate($TemplateName);

    public function assignTemplates($aTemplates);

    /**
     * This method allows to set parameters and variables that will be passed to template file for easy access
     * Usage: to assign any variables to the template use: $oTemplate->name = value
     * @param string $sIndex
     * @param any $sValue
     */
    public function __set($sIndex, $sValue);

    /**
     * This method allows to retrieve assigned parameters and variables to template file
     * @param unknown_type $sIndex
     * @return multitype:
     */
    public function __get($sIndex);

    public function _read_file($filename);

    /**
     * This method is an interpreter and it generates new temporary template file which is displayed to the user.
     * Method replaces "pseudo interpreted" code into actual php code which can be executed
     * Usage:
     * echo:
     * {! 'text' } or {! $variable }
     *
     * ----------
     *
     * if statement:
     * {if($var == 0)}
     * 	//code
     * {/if}
     *
     * ----------
     *
     * while loop:
     * {while(true)}
     * 	//code
     * {/while}
     *
     * ----------
     *
     * foreach loop:
     * {foreach($var as $k => $v)}
     * 	{! $k }
     * {/foreach}
     *
     * or
     *
     * alternative foreach loop:
     * <foreach($var as $k => $v)>
     * 	//code
     * </foreach>
     *
     * ----------
     *
     * php tags:
     * {php}
     * 	//code
     * {/php}
     *
     * ----------
     *
     * language:
     * <lang="language" />
     *
     * or
     *
     * {lang="language"}
     *
     * ----------
     *
     * file include(only template files available for include):
     * {include file="file.php"}
     *
     *
     * @todo repair switch statement
     * @todo work on require and require_once
     * @todo check if template exists
     *
     * @param string $sTemporaryTemplate
     */
    public function replace($sTemporaryTemplate, $temporaryTemplate);
    /**
     * This method allows to set parameters and variables that will be passed to template file for easy access
     * Usage: to assign any variables to the template use: $oTemplate->set(name, value)
     * @param string $sIndex
     * @param any $sValue
     */
    public function set($sIndex, $sValue);

    /**
     * This function renderes the template, it means that it is putting everything together, it creates new file
     * with temporary template and displays it to the user
     * Usage: to display the template simply use: echo $oTemplate->render();
     */
    public function render();

    public function includeTemplate($sName);

    /**
     * An alias to the $this->render() function but user does not have to echo the $this->render() function
     * Usage: to display the template simply use: $oTemplate->display();
     */
    public function display();


    public function __toString();

} 