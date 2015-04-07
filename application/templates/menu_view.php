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
            <h4><a class="btn btn-sm btn-primary" href="/menu/all">Go back</a></h4>
            <legend>

                <span style="color: orange;">Orange</span> - Available stock is low (less than 15%)
            </legend>
            <div class="current-menus">
                <h4>Items</h4>
                {foreach($menuItems->data as $key => $value)}

                <?php

                $displayItem = true;
                $requiredIngredientsToMake = 0;
                    $requiredIngredients = 0;
                    foreach ($oIngredients->ingredients($value['item_id']) as $k => $v) {
                        $requiredIngredients = $v['ingredient_quantity'] * $value['item_available'];

                        //var_dump($v);

                        $ingredientAvailable = $v['ingredient_available'];
                        //var_dump('Available: '. $ingredientAvailable);
                        //var_dump('Required: '.$requiredIngredients);
                       // var_dump('SHow: '.(int)($ingredientAvailable /  $v['ingredient_quantity']));

                        if($ingredientAvailable != 0){
                            $available = (int)($ingredientAvailable /  $v['ingredient_quantity']);
                            //var_dump($available);
                            if($value['item_available'] >= $available){
                                $value['item_available'] = $available;
                            }

                        }else{
                            $displayItem = false;
                        }

                        //Basket_Model::basket()->clear();

                        if ($requiredIngredients > $v['ingredient_available']) {

                            //$displayItem = false;
                        }



                    }

                if($value['item_available'] == 0){
                    $displayItem =false;
                }


                ?>


                <?php if($displayItem): ?>
                <div style="<?php if($value['item_available'] == 0) echo 'color: red'; elseif((($value['item_available'] / $value['item_stock']) * 100) < 15)  echo 'color: orange'; ?>">
                <span class="menu-item-desc"><b>Description:</b> {! $value['item_description'] }</span> <br />
                <span class="menu-item-stock"><b>Stock:</b> {! $value['item_available'] }/{! $value['item_stock'] }</span> <br />
                <span class="menu-item-price"><b>Price:</b> {! $value['item_price'] }</span> <br />
                <span class="menu-item-prep"><b>Preparation time:</b> {! $value['item_preptime'] }</span> <br />
                    <input type="hidden" class="remaining-stock" name="remaining-stock" value="{! $value['item_available'] }" />

                <?php if(!isset($_GET['preview']) && $value['item_available'] != 0): ?>
                    <button class="add_item_to_basket btn btn-material-deep-purple" id="{! $value['item_id'] }" data-remain="{! $value['item_available'] }" href="#">Add</button>

                <?php endif; ?>
                <div style="width: 100%; height: 1px; background-color: #000000"></div>
                </div>
                <?php endif; ?>
                {/foreach}
            </div>

            {else}

                No items in the menu

            {/if}
        </div>

    </div>
</div>

{include file=footer.php}