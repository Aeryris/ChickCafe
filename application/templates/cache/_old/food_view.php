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


<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>

<div id="wrap">
    <div id="main" class="container clear-top">

        <div class="container">
            <h3>ChickCafe Foods</h3>

            <div style="width: 100%; height: 1px; background-color: #000000"></div>
            <a href="/ingredients/view">Ingredients list</a>
            <div style="width: 100%; height: 1px; background-color: #000000"></div>
            <?php foreach($all as $key => $value): ?>
            <br /> <br /> <br />
            <div class="food">

                <a href="/food/edit/id/<?php echo $value['item_id'] ?>">Edit</a> <br />
                <span>Name: <?php echo $value['item_name'] ?></span> <br />
                <span>Description: <?php echo $value['item_description'] ?></span> <br />
                <span>Stock: <?php echo $value['item_stock'] ?></span> <br />
                <span>Available in stock: <?php echo $value['item_available'] ?></span> <br />
                <span>Price: <?php echo $value['item_price'] ?></span> <br />
                <span>Preparation time: <?php echo $value['item_preptime'] ?></span> <br />
                Ingredients:
                <ul>
                    <?php $oIngredientsList = $oIngredients->ingredients($value['item_id']); ?>
                    <?php if(empty($oIngredientsList)) echo 'None'; ?>
                    <?php foreach($oIngredientsList as $k => $v): ?>
                    <li class="ingredient">

                        <?php echo $v['ingredient_name'] ?> [ <?php echo $v['ingredient_quantity'] ?> ]

                    </li>


                    <?php endforeach; ?>
                </ul>

            </div>
            <div style="width: 100%; height: 1px; background-color: #000000"></div>

            <?php endforeach; ?>

        </div>


        </div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>
 