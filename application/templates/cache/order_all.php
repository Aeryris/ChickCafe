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

            <h3>All orders</h3>

            <div class="">


                <?php foreach($oOrdersData as $key => $value): ?>
                <div class="cardView" style="clear: both">

                    <span>Priority order: <?php echo $value['order_priority'] ? ' <i style="color: green" class="glyphicon glyphicon-signal"> Yes</i>' : 'No'; ?></span> <br />
                    <span>Order no: <?php echo $value['order_id'] ?></span> <br />
                    <span>Order date: <?php echo $value['order_datetime'] ?></span><br />
                    <span>Price: <?php echo $value['order_price'] ?></span><br />
                    <span>Order items:</span><br />

                    <div style="padding: 20px 20px 20px 20px">
                        <?php foreach($order->details($value['order_id']) as $k => $v): ?>


                        <img style="height: 50px; width: 50px" src="/food_images/<?php echo $v['item_img'] ?>">
                        <?php echo $v['item_name'] ?>



                        <?php endforeach; ?>
                    </div>
                    <br />
                    <!-- <a class="btn btn-lg btn-primary btn-block" href="/refund/orderid/<?php echo $value['order_id'] ?>">Request refund</a> -->

                </div>



                <?php endforeach; ?>


            </div>



        </div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>
