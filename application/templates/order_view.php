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

?>


{include file=header.php}

<div id="wrap">
    <div id="main" class="container clear-top">

        <div class="container">

            <h3>Your Basket</h3>

            <div class="">


                    {foreach($oOrdersData as $key => $value)}
                    <div>
                        <span>Order no: {! $value['order_id'] }</span>
                        <ul>
                            {foreach($order->details($value['order_id']) as $k => $v)}

                                <li>{! $v['item_name'] }</li>

                            {/foreach}
                        </ul>

                    </div>
                    <div style="width: 100%; height: 1px; background-color: #000000"></div>

                    {/foreach}


            </div>



        </div>

    </div>
</div>

{include file=footer.php}