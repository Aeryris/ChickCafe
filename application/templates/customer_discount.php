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



<div class="container-fluid main">

<div class="container">

    {foreach($customers as $key => $value)}
    <form action="/customer/index" method="post">



    <div class="customer cardView" style="clear: both">
        <p>Name: {! $value['user_firstname'] } {! $value['user_lastname'] }</p>
        <p>Email: {! $value['user_email'] } </p>
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
        <p>Total spendings : £{! $value['customer_spending_total'] } </p>
        <p>Discount : {! $value['customer_vip_discount'] }% </p>

        <p>Update discount</p>
        <input type="text" value="{! $value['customer_vip_discount'] }" name="discount" />

        <input type="hidden" value="{! $value['user_id'] }" name="userid" />

        <button class="btn btn-primary" type="submit">Update</button>

    </div>
    </form>
    {/foreach}

</div>


</div>

{include file=footer.php}