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
                <li ><a class="btn-primary" href="/ingredients/view">Ingredients list</a></li>
                <li><a class="" href="/food/view">Foods list</a></li>
                <li><a class="" href="/order/all">Orders list</a></li>
                <li><a class="" href="/menu/add">Add menu</a></li>
                <li><a class="" href="/ingredients/add">Add Ingredient</a></li>
                <li><a class="" href="/food/add">Add Food</a></li>
                <li><a class="" href="/staff/staff">Staff Dashboard</a></li>
                <li class="active "><a class="btn-primary" href="/customer/index">Customer discounts</a></li>
                <li><a class="" href="/staff/report">Reports</a></li>
                <?php if (Acl_Core::allow([ACL::ACL_OWNER])) { ?>
                    <li><a class="btn btn-lg btn-primary" href="/owner/owner_backup">Backup/Restore Database</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-10 well admin-content" id="home">



            <div class="container-fluid main">

                <div class="container">
                    <h3>List of customers</h3>
                    <?php foreach($customers as $key => $value): ?>
                    <form action="/customer/index" method="post">



                        <div class="customer cardView" style="clear: both">
                            <p>Name: <?php echo $value['user_firstname'] ?> <?php echo $value['user_lastname'] ?></p>
                            <p>Email: <?php echo $value['user_email'] ?> </p>
                            <p>VIP status :
                                <?php
                                if($value['customer_spending_total'] > 1000 && $value['customer_spending_total'] < 2000){
                                    echo 'Silver';
                                }else if($value['customer_spending_total'] > 2000 && $value['customer_spending_total'] < 5000){
                                    echo 'Gold';
                                }else if($value['customer_spending_total'] > 5000) {
                                    echo 'Diamond';
                                }else{
                                    echo 'None';
                                }
                                ?>
                            </p>
                            <p>Total spendings : £<?php echo $value['customer_spending_total'] ?> </p>
                            <p>Discount : <?php echo $value['customer_vip_discount'] ?>% </p>

                            <p>Update discount</p>
                            <input type="text" value="<?php echo $value['customer_vip_discount'] ?>" name="discount" />

                            <input type="hidden" value="<?php echo $value['user_id'] ?>" name="userid" />

                            <button class="btn btn-primary" type="submit">Update</button>

                        </div>
                    </form>
                    <?php endforeach; ?>

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