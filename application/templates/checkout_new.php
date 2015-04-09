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
                                    <h5><span class="glyphicon glyphicon-shopping-cart"></span> Checkout</h5>
                                </div>
                                <div class="col-xs-12">
                                    <div class="stepwizard">
                                        <div class="stepwizard-row">
                                            <div class="stepwizard-step">
                                                <a href="/basket/view" type="button" class="btn btn-primary btn-circle">1</a>
                                                <p>Cart</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <button  style="background: red" type="button" class="btn btn-primary btn-circle">2</button>
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



                    <script>

                        $(document).ready(function(){
                            //$('a.a-attr').attr('disabled', true);
                            function updatePriority(){

                                //$('.updating').hide();
                                //$('button').prop('disabled', false);

                                //$('a.a-attr').attr('disabled', false);


                            }
                            setTimeout(updatePriority, 2000);
                        });
                    </script>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-9">
                                <h4 class="text-right"><span class="updating"></span>Total £<strong class="total"><?php echo $_SESSION['calculatedPrice'] ?></strong></h4>
                            </div>
                            <div class="col-xs-3">
                                {if(!empty($basketItems))}
                                {! $paypal }
                                <div>
                                    Pay with
                                    <button id="checkout-submit-button" class="btn btn-lg btn-primary btn-block enable" type="submit">PayPal</button>
                                    <a href="/checkout/process_card" class="btn btn-lg btn-primary btn-block a-attr" >Debit Card</a>
                                    <a href="/checkout/process_card_transfer" class="btn btn-lg btn-primary btn-block a-attr" >Bank Transfer</a>
                                </div>
                                </form>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


{include file=footer.php}