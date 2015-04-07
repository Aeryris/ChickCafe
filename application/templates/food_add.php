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
            <h3>Add food</h3>
            <h4><a class="btn btn-sm btn-primary" href="/staff/manager">Go back</a></h4>

            <form action="/food/add" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="food_name">Name</label>
                    <input type="text" value="" class="form-control" name="food_name" />
                </div>
                <div class="form-group">
                    <label for="food_desc">Description</label>
                    <input type="text" value="" class="form-control" name="food_desc" />
                </div>
                <div class="form-group">
                    <label for="food_stock">Stock</label>
                    <input type="text" value="" class="form-control" name="food_stock" />
                </div>
                <div class="form-group">
                    <label for="food_available">Available</label>
                    <input type="text" value="" class="form-control" name="food_available" />
                </div>
                <div class="form-group">
                    <label for="food_price">Price</label>
                    <input type="text" value="" class="form-control" name="food_price" />
                </div>
                <div class="form-group">
                    <label for="food_preptime">Preparation time</label>
                    <input type="text" value="" class="form-control" name="food_preptime" />
                </div>
                <div class="form-group">
                    <label for="food_preptime">Image</label>
                    <input type="file" value="" class="form-control" name="food_image" />
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Add</button>

            </form>

            <?php if(isset($error)) echo $error ?>

            </div>


        </div>


    </div>

</div>
</div>

{include file=footer.php}
 