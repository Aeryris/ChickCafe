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

<div id="wrap">
    <div id="main" class="container clear-top">

        <div class="container">

            <script>

                setTimeout(function () {
                    window.location.href = "/checkout/processed";
                }, 10000);

            </script>

            <style>

                .spinner {

                    height: 50px;
                    position: absolute;
                    top: 0;
                    bottom: 0;
                    right: 0;
                    left: 0;
                    margin: auto;
                    text-align: center;
                }
                .spinner .ball {
                    width: 20px;
                    height: 20px;
                    background-color: #000000;
                    border-radius: 50%;
                    display: inline-block;
                    -webkit-animation: motion 3s cubic-bezier(0.77, 0, 0.175, 1) infinite;
                    animation: motion 3s cubic-bezier(0.77, 0, 0.175, 1) infinite;
                }

                p {
                    color: #000000;
                    margin-top: 5px;
                    font-family: sans-serif;
                    letter-spacing: 3px;
                    font-size: 20px;
                }

                @-webkit-keyframes motion {
                    0% {
                        -webkit-transform: translateX(0) scale(1);
                        transform: translateX(0) scale(1);
                    }
                    25% {
                        -webkit-transform: translateX(-50px) scale(0.3);
                        transform: translateX(-50px) scale(0.3);
                    }
                    50% {
                        -webkit-transform: translateX(0) scale(1);
                        transform: translateX(0) scale(1);
                    }
                    75% {
                        -webkit-transform: translateX(50px) scale(0.3);
                        transform: translateX(50px) scale(0.3);
                    }
                    100% {
                        -webkit-transform: translateX(0) scale(1);
                        transform: translateX(0) scale(1);
                    }
                }

                @keyframes motion {
                    0% {
                        -webkit-transform: translateX(0) scale(1);
                        transform: translateX(0) scale(1);
                    }
                    25% {
                        -webkit-transform: translateX(-50px) scale(0.3);
                        transform: translateX(-50px) scale(0.3);
                    }
                    50% {
                        -webkit-transform: translateX(0) scale(1);
                        transform: translateX(0) scale(1);
                    }
                    75% {
                        -webkit-transform: translateX(50px) scale(0.3);
                        transform: translateX(50px) scale(0.3);
                    }
                    100% {
                        -webkit-transform: translateX(0) scale(1);
                        transform: translateX(0) scale(1);
                    }
                }

            </style>

            <h3>Processing your payment</h3>


            <div class="spinner">
                <div class="ball"></div>
                <p>Processing your payment</p>
            </div>

            </div>



        </div>

    </div>
</div>


{include file=footer.php}
 