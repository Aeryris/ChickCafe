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


<div class="container">
    <br />
    <br />
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked admin-menu">
                <li   ><a class="" href="/user/dashboard">Home</a></li>
                <li><a class="" href="/menu/all">Menus list</a></li>
                <li ><a class="" href="/ingredients/view">Ingredients list</a></li>
                <li><a class="" href="/food/view">Foods list</a></li>
                <li><a class="" href="/order/all">Orders list</a></li>
                <li class="active "><a class="btn-primary" href="/menu/add">Add menu</a></li>
                <li><a class="" href="/ingredients/add">Add Ingredient</a></li>
                <li><a class="" href="/food/add">Add Food</a></li>
                <li><a class="" href="/staff/staff">Staff Dashboard</a></li>
                <li><a class="" href="/customer/index">Customer discounts</a></li>
                <li><a class="" href="/staff/report">Reports</a></li>
                <?php if (Acl_Core::allow([ACL::ACL_OWNER])) { ?>
                    <li><a class="" href="/owner/owner_backup">Backup Database</a></li>
                    <li><a class="" href="/owner/restore">Restore Database</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-10 well admin-content" id="home">


            <div id="wrap">
                <div id="main" class="container clear-top">


                    <div class="container">

                        <h3>Add menu</h3>
                        <h4><a class="btn btn-sm btn-primary" href="/menu/all">Go back</a></h4>
                        <form action="/menu/add" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="menu_name">Name</label>
                                <input type="text" value="" class="form-control" name="menu_name" />
                            </div>
                            <div class="form-group">
                                <label for="menu_start_time">Start time</label>
                                <input type="text" value="" class="form-control timepicker" name="menu_start_time" id="menu_start_time" />
                            </div>
                            <div class="form-group">
                                <label for="menu_end_time">End time</label>
                                <input type="text" value="" class="form-control" name="menu_end_time" id="menu_end_time" />
                            </div>
                            <div class="form-group">
                                <label for="menu_type">Menu type</label>
                                <select name="menu_type">
                                    <?php foreach($types as $key => $value): ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['menu_type_name'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="food_preptime">Image</label>
                                <input type="file" value="" class="form-control" name="food_image" />
                            </div>



                            <button type="submit" class="btn btn-lg btn-primary">Add</button>


                        </form>








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




<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>