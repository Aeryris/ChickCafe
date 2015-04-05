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
            <h3>Editing foodname</h3>
            <h4><a href="/ingredients/view">Go back</a></h4>

            {foreach($ing as $key => $value)}
            <div class="ingredient">

                <span>Name: {! $value['ingredient_name'] }</span> <br />
                <span>Stock: {! $value['ingredient_stock'] }</span> <br />
                <span>Available in stock: {! $value['ingredient_available'] }</span> <br />
            </div>



            <form method="post" action="/ingredients/order/id/{! $_GET['id']}/">

                <label>Order stock</label>
                <input type="text" name="order" value="{! $value['ingredient_stock'] }" />

                <button type="submit">Order</button>
            </form>

            {/foreach}

            <?php

                if(isset($error)) echo $error;
            ?>
        </div>


    </div>

</div>
</div>

{include file=footer.php}
 