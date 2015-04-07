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
            <h3>Editing {! $foodDetails['item_name'] }</h3>
            <h4><a class="btn btn-sm btn-primary" href="/food/view">Go back</a></h4>
            <div class="cardView">
            <h4>Ingredients:</h4>
            <ul>
            {foreach($ingredientsList as $key => $value)}
            <li class="ingredient">

              {! $value['ingredient_name'] } [ {! $value['ingredient_quantity'] } ] <a class="btn btn-sm" href="/food/edit/id/{! $_GET['id']}/remove/{! $value['ingredient_id'] } ">Remove</a>

            </li>


            {/foreach}
            </ul>

            <form method="post" action="/food/edit/id/{! $_GET['id']}/add/">

                <select name="add">
                    {foreach($allIngredients as $key => $value)}

                        <option value="{! $value['ingredient_id'] } ">{! $value['ingredient_name'] }</option>

                    {/foreach}

                </select>

                <button class="btn btn-sm btn-primary" type="submit">Add</button>
            </form>

            <form method="post" action="/food/edit/id/{! $_GET['id']}/order/">
                <span>Available {! $foodDetails['item_available'] }</span> <br />
                <span>Max stock {! $foodDetails['item_stock'] }</span> <br />
                <?php $orderQuan = $foodDetails['item_stock'] -  $foodDetails['item_available'];?>
                <label for="order">Order</label>
                <input name="order" type="text" value="{! $orderQuan }" />
                <br />
                <button class="btn btn-sm btn-primary" type="submit">Order</button>
            </form>
            <?php
            if(isset($error)) echo $error
            ?>


        </div>

</div>
    </div>

</div>
</div>

{include file=footer.php}
 