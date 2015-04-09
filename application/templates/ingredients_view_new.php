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

        <h3>Ingredients list</h3>
        <h4><a class="btn btn-sm btn-primary" href="/staff/manager">Go back</a></h4>
        <div class="container">
            <div class="row-fluid">

                {foreach($all as $key => $value)}
                <a href="/menu/view/id/{! $value['ingredient_id'] }">


                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="box" style="background: white">
                            <div class="box-image" style="background: url(/food_images/{! $value['ingredient_img_src'] })">
                            </div>
                            <div class="info" style="padding: 10px 25px;">
                                <div class="box-icon">
                                    <img style="width: 100%; height: 100%;border-radius: 50%;" src="/food_images/{! $value['ingredient_img_src'] }">
                                </div>
                                <h4 class="text-center">{! $value['ingredient_name'] }</h4>
                                <p style="color: #000000">Stock: <?php  echo  $value['ingredient_stock'] ?></p>
                                <p style="color: #000000">Available: <?php  echo  $value['ingredient_available'] ?></p>
                                <a class="btn btn-sm btn-primary" href="/ingredients/edit/id/{! $value['ingredient_id'] }">Edit</a>
                            </div>
                        </div>
                    </div>

                </a>
                {/foreach}
            </div>
        </div>

    </div>
</div>

{include file=footer.php}
