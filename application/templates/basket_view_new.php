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
        <div class="row">
            <div class="col-xs-15">
                <div class="panel panel-info">
                    <div class="panel-heading" style="background: white">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                                </div>
                                <div class="col-xs-12">
                                    <div class="stepwizard">
                                        <div class="stepwizard-row">
                                            <div class="stepwizard-step">
                                                <button style="background: red" type="button" class="btn btn-primary btn-circle ">1</button>
                                                <p>Cart</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <button type="button" class="btn btn-primary btn-circle ">2</button>
                                                <p>Checkout</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <button type="button" class="btn btn-primary btn-circle" disabled="disabled">3</button>
                                                <p>Payment</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">





                    </div>
                    <hr>
                    <style>
                        .btn.active {
                            display: none;
                        }

                        .btn span:nth-of-type(1)  {
                            display: none;
                        }
                        .btn span:last-child  {
                            display: block;
                        }

                        .btn.active  span:nth-of-type(1)  {
                            display: block;
                        }
                        .btn.active span:last-child  {
                            display: none;
                        }
                    </style>
                    <script>



                    </script>
                    <div class="panel-footer">
                        <p>You can pay 5% more, to get your order processed with higher priority</p>
                        <div class="priority" data-toggle="buttons">
                            <label class="btn btn-lg btn-success active opt">
                                <input type="radio" name="options" id="off" autocomplete="off" checked>
                                <i class="fa fa-check"></i> Yes
                            </label>
                            <label class="btn btn-lg btn-danger opt">
                                <input type="radio" name="options" id="on" autocomplete="off">
                                <i class="fa fa-warning"></i> No
                            </label>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <p>Discount: {! $oUser['customer_vip_discount'] }%</p>

                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-9">
                                <strong style="display: none" class="checkout-total-sum-original"></strong>
                                <h5 class="text-right">Total: £<strong class="checkout-total-sum"></strong></h5>
                                <h5 class="text-right">Discount: <strong class="">{! $oUser['customer_vip_discount'] }%</strong></h5>
                                <h4 class="text-right">After discount: £<strong class="checkout-total-sum-after-discount">  </strong></h4>



                                <input type="hidden" name="after-discount" class="after-discount" value="" />
                            </div>
                            <div class="col-xs-3">
                                <?php

                                if(!empty($basketItems)) echo '<a href="/checkout/basket" id="checkout-submit-button" class="btn btn-lg btn-primary btn-block" type="submit">Checkout</a>';

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    function calc(priceV){



        var price = priceV; //$('.checkout-total-sum-original').text();
        price = parseFloat(price);

        var userDiscount = <?php echo $oUser['customer_vip_discount']; ?>;
        var calc = price;
        var finalPrice = calc - (calc * (userDiscount / 100));
        $.post('/session/set', { addOrderPriority: false, calculatedPrice:finalPrice });
        return parseFloat(finalPrice).toFixed(2);

    }

    $(document).ready(function(){

        $('.opt').on('click', function(){
            console.log($(this).find('input').attr('id'));

            var price = $('.after-discount').text(); //$('.checkout-total-sum-original').text();
            price = parseFloat(price);
            var priorityPrice = price * (5 / 100);
            var userDiscount = <?php echo $oUser['customer_vip_discount']; ?>;
            var finalPrice = price + priorityPrice;// - priorityPrice;
            $.post('/session/set', { addOrderPriority: false });
            if($(this).find('input').attr('id') == 'on'){
                $.post('/session/set', { addOrderPriority: true, calculatedPrice:finalPrice  });
                $('.checkout-total-sum-after-discount').text(parseFloat(finalPrice).toFixed(2));
            }else{
                $.post('/session/set', { addOrderPriority: false, calculatedPrice:price });
                $('.checkout-total-sum-after-discount').text(parseFloat(price).toFixed(2));
            }
        });


    });

</script>


{include file=footer.php}