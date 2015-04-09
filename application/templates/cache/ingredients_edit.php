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
            <h3>Editing <?php echo $ing[0]['ingredient_name'] ?></h3>
            <div class="cardView">
            <h4><a class="btn btn-sm btn-primary" href="/ingredients/view">Go back</a></h4>

            <?php foreach($ing as $key => $value): ?>
            <div class="ingredient">

                <span>Name: <?php echo $value['ingredient_name'] ?></span> <br />
                <span>Stock: <?php echo $value['ingredient_stock'] ?></span> <br />
                <span>Available in stock: <?php echo $value['ingredient_available'] ?></span> <br />
            </div>



            <form method="post" action="/ingredients/order/id/<?php echo $_GET['id'] ?>/">

                <label>Order stock</label>
                <input type="text" name="order" value="<?php echo $value['ingredient_stock'] ?>" />
                <br />
                <button class="btn btn-sm btn-primary" type="submit">Order</button>
            </form>

            <?php endforeach; ?>

            <?php

                if(isset($error)) echo $error;
            ?>
        </div>
    </div>

    </div>

</div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>
 