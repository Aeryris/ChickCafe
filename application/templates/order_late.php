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
                <li ><a href="/order/all">Orders list</a></li>
                <li  class="active "><a class="btn-primary" href="/order/order_late">Late Orders</a></li>
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
                        <h3>Late orders</h3>
                        <h4>These are the currently known late orders for today.</h4>
                        <div class="">
                            <?php //var_dump($oOrdersData) ?>
                        {foreach($lateOrderData as $key => $value)}
                            <div class="cardView" style="clear: both">
                            <?php 
                            	$orderDateTime = $value['order_datetime'];
                                $itemPrepTime = 0;
                            	foreach ($order->details($value['order_id']) as $k => $v) {
                            	 	// var_dump($v);
                                    $itemPrepTime += $v['item_preptime'];
                            	}
                                $itemPrepTime = strtotime($itemPrepTime);
                                $now = strtotime(time());
                                $orderDateTimePHP = strtotime($orderDateTime);
                                $lateTime = $itemPrepTime + $orderDateTime;
                                if ($lateTime > $now) {
                                    $lateOrderCount++;
                                }
                            ?>
                                <span>Customer Name: {! $value['user_firstname']} {! $value['user_lastname']}</span> <br />

                                <span>Priority order: <?php echo $value['order_priority'] ? ' <i style="color: green" class="glyphicon glyphicon-signal"> Yes</i>' : 'No'; ?></span> <br />
                                <span>Order no: {! $value['order_id'] }</span> <br />
                                <span>Order date: {! $value['order_datetime'] }</span><br />
                                <span>Price: {! $value['order_price'] }</span><br />
                                <span>Order items:</span><br />

                                <div style="padding: 20px 20px 20px 20px">
                                    {foreach($order->details($value['order_id']) as $k => $v)}
                                    <img style="height: 50px; width: 50px" src="/food_images/{! $v['item_img'] }">
                                    <p>Item Name: {! $v['item_name'] }</p>
                                    <p>Item Preptime: {! $v['item_preptime']}</p> 
                					{/foreach}
                                </div>
                                <br />
                            </div>
                            {/foreach}
                            <?php
                                if ($lateOrderCount > 0) {
                                $oNotification = new Notification_Model;
                                $oNotification->sendMsgToUserType('M', 'There are '.$lateOrderCount.'late orders currently.');
                                }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

        </div> <!--- admin end -->

    </div>
</div>


{include file=footer.php}