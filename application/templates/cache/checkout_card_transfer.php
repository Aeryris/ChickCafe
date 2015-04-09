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

            <h3>Card details</h3>

            <div class="">

                <style>
                    .jp-card-front{
                        background: #00acff;
                    }
                </style>


                <div class="container">
                    <div class="card-wrapper"></div>
                    <div class='row'>
                        <div class='col-md-4'></div>
                        <div class='col-md-4'>
                            <div class="form-container active">
                                <form action="/checkout/process_card_transfer" class="require-validation"   id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"></div>
                                    <div class='form-row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label>
                                            <input name="name" class='form-control' size='4' type='text'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Sort code</label>
                                            <input name="sortcode" autocomplete='off' class='form-control sort-code' placeholder='ex. 123456' size='7' maxlength="7" type='text'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-xs-12 form-group account required'>
                                            <label class='control-label'>Account number</label>
                                            <input name="account" autocomplete='off' class='form-control card-account' placeholder='ex. 12345678' size='8' maxlength="8" type='text'>
                                        </div>


                                    </div>
                                    <div class='form-row'>
                                        <div class='col-md-12'>
                                            <div class='form-control total btn btn-info'>
                                                Total:
                                                <span class='amount'>£<?php echo $totalPrice ?></span>
                                                <input type="hidden" name="full-price" value="<?php echo $totalPrice ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-md-12 form-group'>
                                            <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-md-12 error form-group hide'>
                                            <div class='alert-danger alert'>
                                                Please correct the errors and try again.
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class='col-md-4'></div>
                    </div>
                </div>






                <div style="float: right">

                </div>

            </div>



        </div>

    </div>
</div>

<script src="/application/assets/js/card.js"></script>
<script>

    var card = new Card({
        // a selector or DOM element for the form where users will
        // be entering their information
        form: 'form', // *required*
        // a selector or DOM element for the container
        // where you want the card to appear
        container: '.card-wrapper', // *required*

        formSelectors: {
            numberInput: 'input[name="sortcode"], input[name="account"]' // optional — default input[name="number"]

         },

        width: 200, // optional — default 350px
        formatting: true, // optional - default true

        // Strings for translation - optional


        // Default values for rendered fields - optional
        values: {
            number: 'Sort-Code Account number',
            name: 'Full Name'
        },

        // if true, will log helpful messages for setting up Card
        debug: true // optional - default false
    });
</script>


<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>