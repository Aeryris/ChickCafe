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

            <h3>Your Basket</h3>

            <div class="">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Quantity</th>
                        <th>Preparation time</th>
                        <th>Price</th>
                        <th>Update</th>
                    </tr>
                    </thead>
                    <tbody class="basket-view-summary">




                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">
                                Total <span style="color: black" class="checkout-total-sum"></span>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                Total preparation time <span style="color: black" class="checkout-total-preparation"></span>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <div style="float: right">
                    <?php

                    if(!empty($basketItems)) echo '<a href="/checkout/basket" id="checkout-submit-button" class="btn btn-lg btn-primary btn-block" type="submit">Checkout</a>';

                    ?>


                </div>

            </div>



        </div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>
 