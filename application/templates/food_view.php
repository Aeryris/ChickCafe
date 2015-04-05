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
            <h3>ChickCafe Foods</h3>
            <legend>
                <span style="color: red;">Red</span> - Available stock is empty
                <span style="color: orange;">Orange</span> - Available stock is low (less than 15%)
            </legend>

            <div style="width: 100%; height: 1px; background-color: #000000"></div>
            <a href="/ingredients/view">Ingredients list</a>
            <div style="width: 100%; height: 1px; background-color: #000000"></div>
            {foreach($all as $key => $value)}
            <br /> <br /> <br />
            <div class="food" style="<?php if($value['item_available'] == 0) echo 'color: red'; elseif((($value['item_available'] / $value['item_stock']) * 100) < 15)  echo 'color: orange'; ?>">


                <a href="/food/edit/id/{! $value['item_id'] }">Edit</a> <br />
                <span>Name: {! $value['item_name'] }</span> <br />
                <span>Description: {! $value['item_description'] }</span> <br />
                <span>Stock: {! $value['item_stock'] }</span> <br />
                <span>Available in stock: {! $value['item_available'] }</span> <br />
                <span>Price: {! $value['item_price'] }</span> <br />
                <span>Preparation time: {! $value['item_preptime'] }</span> <br />
                Ingredients:
                <ul>
                    <?php $oIngredientsList = $oIngredients->ingredients($value['item_id']); ?>
                    <?php if(empty($oIngredientsList)) echo 'None'; ?>
                    {foreach($oIngredientsList as $k => $v)}
                    <li class="ingredient">

                        {! $v['ingredient_name'] } [ {! $v['ingredient_quantity'] } ]

                    </li>


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
 