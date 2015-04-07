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

            <h3>Current menus</h3>
                <div class="current-menus">
            <?php foreach($oMenu->data() as $key => $value): ?>
                    <a href="menu/view/id/<?php echo $value['menu_id'] ?>">
                    <div style="color: #000000" class="cardView">
                        <div style="width: 150px; height: 150px; float: left" class="menu_image">

                            <img style="height: 100%; width: 100%;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" src="/food_images/<?php echo $value['menu_image'] ?>">
                        </div>
                        <div class="food_data" style="float: left; margin-left: 10px">
                <span><b>Name:</b> <?php echo $value['menu_name'] ?></span> <br />
                <span><b>Start time:</b> <?php echo $value['menu_time_start'] ?></span> <br />
                <span><b>End time:</b> <?php echo $value['menu_time_end'] ?></span> <br />
                    </div></div>
                        </a>
            <?php endforeach; ?>
                </div>
        </div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>