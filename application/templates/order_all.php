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
                <li><a class="" href="/food/view">Foods list</a></li>
                <li  class="active "><a class="btn-primary" href="/order/all">Orders list</a></li>
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
        <div class="col-md-10 well admin-content" id="home">


            <div id="wrap">
                <div id="main" class="container clear-top">

                    <div class="container">

                        <h3>All orders</h3>

                        <div class="">

                            <?php //var_dump($oOrdersData) ?>

                            <?php

                            $oUser = new User_Model();


                            ?>


                            {foreach($oOrdersData as $key => $value)}
                            <div class="cardView" style="clear: both">

                                <?php $oUser->attr(['id' => $value['customer_id']]); ?>

                                <span>Name: <?php echo $oUser->aData['user_firstname']; echo ' '; echo $oUser->aData['user_lastname']; ?></span> <br />

                                <span>Priority order: <?php echo $value['order_priority'] ? ' <i style="color: green" class="glyphicon glyphicon-signal"> Yes</i>' : 'No'; ?></span> <br />
                                <span>Order no: {! $value['order_id'] }</span> <br />
                                <span>Order date: {! $value['order_datetime'] }</span><br />
                                <span>Price: {! $value['order_price'] }</span><br />
                                <span>Order items:</span><br />

                                <div style="padding: 20px 20px 20px 20px">
                                    {foreach($order->details($value['order_id']) as $k => $v)}


                                    <img style="height: 50px; width: 50px" src="/food_images/{! $v['item_img'] }">
                                    {! $v['item_name'] }



                                    {/foreach}
                                </div>
                                <br />
                                <!-- <a class="btn btn-lg btn-primary btn-block" href="/refund/orderid/{! $value['order_id'] }">Request refund</a> -->

                            </div>



                            {/foreach}


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
