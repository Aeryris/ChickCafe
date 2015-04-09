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



<div class="container-fluid main">


    <div class="container">
        <div class="row">

            {if(isset($menuItems->data[0]))}
                 <h3 class="menu-name">{! $menuItems->data[0]['menu_name'] }</h3>

                <div class="current-menus">
                <h4>Items</h4>
                {foreach($menuItems->data as $key => $value)}
                    <?php
                    $displayItem = true;
                    $requiredIngredientsToMake = 0;
                    $requiredIngredients = 0;
                    foreach ($oIngredients->ingredients($value['item_id']) as $k => $v) {
                        $requiredIngredients = $v['ingredient_quantity'] * $value['item_available'];
                        $ingredientAvailable = $v['ingredient_available'];
                        if($ingredientAvailable != 0){
                            $available = (int)($ingredientAvailable /  $v['ingredient_quantity']);
                            //var_dump($available);
                            if($value['item_available'] >= $available){
                                $value['item_available'] = $available;
                            }
                        }else {
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


                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                            <div class="box" style="background: white">
                                <div class="box-image" style="background: url(/food_images/{! $value['item_img'] })">
                                </div>
                                <div class="info" style="padding: 10px 25px;">



                                    <div class="box-icon">
                                        <img style="width: 100%; height: 100%;border-radius: 50%;" src="/food_images/{! $value['item_img'] }">

                                    </div>
                                    <h4 class="text-center">{! $value['item_name'] }</h4>
                                    <p style="color: #000000"><?php  echo  $value['item_description'] ?></p>
                                    <p><span class="menu-item-price"><b>Price:</b> £{! $value['item_price'] }</span> <br /></p>
                                    <?php if(!isset($_GET['preview']) && $value['item_available'] != 0): ?>
                                        <button class="add_item_to_basket btn btn-material-deep-purple" id="{! $value['item_id'] }" data-remain="{! $value['item_available'] }" href="#">Add</button>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                    <?php endif; ?>


                {/foreach}
                </div>
            {/if}
        </div>
    </div>




</div>


{include file=footer.php}
 