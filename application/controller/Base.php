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


class Base_Controller {

    public $db;
    public $input;
    public $post;
    public $get;
    public $auth;
    public $template;
    public $view;
    public $header = 'header';
    public $footer = 'footer';
    public $benchmark;
    public $session;

    public function __construct(){
        if(DEVELOPMENT_MODE){
            $this->benchmark = new Benchmark_Core();
            $this->benchmark->start();
        }

        session_start();
        $this->session = new Session_Core();

        Language_Core::setLocale($this->session->language);
        $this->auth = new Auth_Core();
        $this->template = new Template_Core('');
        if(DEVELOPMENT_MODE) $this->refresh = true;

    }

    public function __destruct(){
        $inc = array();
        if(isset($this->view)){
            $inc = array($this->view, $this->footer);
        }else{
            $inc = array($this->footer);
        }

        //var_dump($this->view);

        $this->template->assignTemplates($inc);
        //var_dump($this->template);
        $this->benchmark->end();
        $this->template->display();
    }

} 