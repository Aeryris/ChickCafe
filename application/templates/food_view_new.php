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
                <li ><a  href="/ingredients/view">Ingredients list</a></li>
                <li class="active "><a class="btn-primary" href="/food/view">Foods list</a></li>
                <li><a class="" href="/order/all">Orders list</a></li>
                <li><a class="" href="/menu/add">Add menu</a></li>
                <li><a class="" href="/ingredients/add">Add Ingredient</a></li>
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
        <div class="col-md-10 well admin-content" id="home" style="padding-left: 0px;">



            <div class="container-fluid main">


                <div class="container">
                    <legend>
                        <span style="color: red;"><i class="fa fa-exclamation-triangle"></i></span> - Available stock is empty
                        <span style="color: orange;"><i class="fa fa-exclamation-triangle"></i></span> - Available stock is low (less than 15%)
                    </legend>


                    <a class="btn btn-sm btn-primary" href="/ingredients/view">Ingredients list</a>
                    <div class="row">
                        {foreach($all as $key => $value)}
                        <a href="/menu/view/id/{! $value['item_id'] }">


                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                <div class="box" style="background: white">
                                    <div class="box-image" style="background: url(/food_images/{! $value['item_img'] })">
                                    </div>
                                    <div class="info" style="padding: 10px 25px;">
                                        <div class="box-icon">
                                            <img style="width: 100%; height: 100%;border-radius: 50%;" src="/food_images/{! $value['item_img'] }">
                                        </div>
                                        <h4 class="text-center"><span style="<?php if($value['item_available'] == 0) echo 'color: red'; elseif((($value['item_available'] / $value['item_stock']) * 100) < 15)  echo 'color: orange'; else echo 'display: none' ?>"><i class="fa fa-exclamation-triangle"></i></span>{! $value['item_name'] }</h4>
                                        <p class="text-center" style="color: #000000"><?php  echo  $value['item_description'] ?></p>

                                        <div class="well index">
                                            <div class="text-left">
                                                <p style="color: #000000">Stock: {! $value['item_stock'] }</p>
                                                <p style="color: #000000">Available in stock: {! $value['item_available'] }</p>
                                                <p style="color: #000000">Price: {! $value['item_price'] }</p>
                                                <p style="color: #000000">Preparation time: {! $value['item_preptime'] }</p>

                                            </div>
                                        </div>
                                        <ul class="well">
                                            <p class="text-left" style="color: #000000">Ingredients:</p>
                                            <?php $oIngredientsList = $oIngredients->ingredients($value['item_id']); ?>
                                            <?php if(empty($oIngredientsList)) echo 'None'; ?>
                                            <div style="float: none; list-style: none">
                                                {foreach($oIngredientsList as $k => $v)}
                                                <p  class="text-left" style="color: #000000">{! $v['ingredient_name'] } </p>
                                                <ul>
                                                    <li  class="text-left" style="color: #000000">Available in stock [ {! $v['ingredient_available'] } ] </li>

                                                    <li class="text-left" style="color: #000000">
                                                        Needed per item [ {! $v['ingredient_quantity'] } ]
                                                    </li>
                                                </ul>
                                                {/foreach}
                                            </div>
                                        </ul>
                                        <a class="btn btn-sm" href="/food/edit/id/{! $value['item_id'] }">Edit</a>
                                    </div>
                                </div>
                            </div>

                        </a>
                        {/foreach}
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
