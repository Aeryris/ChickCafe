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

            {if(isset($menuItems->data[0]))}
            <h3 class="menu-name">{! $menuItems->data[0]['menu_name'] }</h3>
            <div class="current-menus">
                <h4>Items</h4>
                {foreach($menuItems->data as $key => $value)}
                <span class="menu-item-name"><b>Name:</b> {! $value['menu_name'] }</span> <br />
                <span class="menu-item-desc"><b>Description:</b> {! $value['item_description'] }</span> <br />
                <span class="menu-item-stock"><b>Stock:</b> {! $value['item_available'] }/{! $value['item_stock'] }</span> <br />
                <span class="menu-item-price"><b>Price:</b> {! $value['item_price'] }</span> <br />
                <span class="menu-item-prep"><b>Preparation time:</b> {! $value['item_preptime'] }</span> <br />
                <button class="add_item_to_basket btn btn-material-deep-purple" id="{! $value['item_id'] }" href="#">Add</button>
                <div style="width: 100%; height: 1px; background-color: #000000"></div>
                {/foreach}
            </div>

            {else}

                No items in the menu

            {/if}
        </div>

    </div>
</div>

{include file=footer.php}