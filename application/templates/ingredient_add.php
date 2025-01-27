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


<div class="container">
    <br />
    <br />
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked admin-menu">
                <li   ><a class="" href="/user/dashboard">Home</a></li>
                <li><a class="" href="/menu/all">Menus list</a></li>
                <li><a class="" href="/ingredients/view">Ingredients list</a></li>
                <li><a class="" href="/food/view">Foods list</a></li>
                <li><a class="" href="/order/all">Orders list</a></li>
                <li><a class="" href="/menu/add">Add menu</a></li>
                <li  class="active "><a class="btn-primary" href="/ingredients/add">Add Ingredient</a></li>
                <li><a class="" href="/food/add">Add Food</a></li>
                <li><a class="" href="/staff/staff">Staff Dashboard</a></li>
                <li><a class="" href="/customer/index">Customer discounts</a></li>
                <li><a class="" href="/staff/report">Reports</a></li>
                <?php if (Acl_Core::allow([ACL::ACL_OWNER])) { ?>
                    <li><a class="" href="/owner/owner">Backup/Restore Database</a></li>
                    <li><a href="/owner/restore">Restore Database</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-10 well admin-content" id="home">



            <div id="wrap">
                <div id="main" class="container clear-top">

                    <div class="container">
                        <h3>Add food</h3>
                        <h4><a class="btn btn-sm btn-primary" href="/staff/manager">Go back</a></h4>

                        <form action="/ingredients/add" method="post">

                            <div class="form-group">
                                <label for="food_name">Name</label>
                                <input type="text" value="" class="form-control" name="food_name" />
                            </div>
                            <div class="form-group">
                                <label for="food_stock">Stock</label>
                                <input type="text" value="" class="form-control" name="food_stock" />
                            </div>
                            <div class="form-group">
                                <label for="food_available">Available</label>
                                <input type="text" value="" class="form-control" name="food_available" />
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary">Add</button>

                        </form>

                        <?php if(isset($error)) echo $error ?>

                    </div>


                </div>


            </div>

        </div>
    </div>

        </div> <!--- admin end -->

    </div>
</div>

<br />
<br />
<br />
<br />
<br />
<br />



{include file=footer.php}
 