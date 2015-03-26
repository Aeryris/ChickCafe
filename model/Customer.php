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

interface Customer_Interface{
    public function setRegistrationDate($sDate);
    public function setSpendingTotal($dSpending);
    public function addSpendings($dSpendings);
}

class Customer_Model extends UserType_Model implements Customer_Interface{

    private static $instance;

    public $type = 'c';
    public $spendings;
    public $registrationDate;

    public static function get()
    {
        if (!is_object(self::$instance)) {
            $c = get_called_class();
            self::$instance = new $c();
        }
        return self::$instance;
    }

    protected function __construct()
    {
    }

    public function setRegistrationDate($sDate){
        $this->registrationDate = $sDate;
        return $this;
    }
    public function setSpendingTotal($dSpending){
        $this->spendings = $dSpending;
        return $this;
    }
    public function addSpendings($dSpendings){
        $this->spendings += $dSpendings;
        return $this;
    }

} 