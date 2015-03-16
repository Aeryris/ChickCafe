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



class Benchmark_Core {

    public $startTime;
    public $endTime;
    public $startMemory;
    public $endMemory;
    public $digits = 0;
    public function start(){
        $this->startTime    = explode (' ', microtime());
        //var_dump($this->startTime);
        $mem = memory_get_usage();
        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
        //var_dump($mem);
        //var_dump($bt);
    }

    public function end(){
        //var_dump($this->totaltime());
    }

    public function results(){

    }

    public function totaltime()
    {
        $this->endTime         = explode (' ', microtime());
        if($this->digits == ""){
            $runtime_float  = $this->endTime[0] - $this->startTime[0];
        }else{
            $runtime_float  = round(($this->endTime[0] - $this->startTime[0]), $this->digits);
        }
        $runtime = ($this->endTime[1] - $this->startTime[1]) + $runtime_float;
        return $runtime;
    }

} 