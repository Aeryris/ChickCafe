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



        <div class="ha-bg-parallax text-center block-marginb-none overlay" data-type="background" data-speed="20">

            <div class="ha-parallax-body">


                <div class="ha-content ha-content-black">

                    <h1 class="ribbon">
                        <strong class="ribbon-content">WELCOME TO</strong>
                    </h1>

                </div>

                <div class="ha-parallax-divider-wrapper">

                    <span class="ha-diamond-divider-md img-responsive"></span>

                </div>

                <div style="font-size: 80px" class="ha-heading-parallax ha-content-black">ChickCafe</div>
                <div style="color:white">-------------------------------------- <i class="fa fa-star"></i> --------------------------------------</div>

            </div>

        </div>








        <div class="container">
            <div class="row">

                <h2>Today's daily special is: </h2>
                {foreach($dailySpecial as $key => $value)}

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                    <div class="box" style="background: white">
                        <div class="box-image" style="background: url(/food_images/{! $value['item_img'] })">
                        </div>
                        <div class="info" style="padding: 10px 25px;">
                            <div class="box-icon">
                                <img alt="{! $value['item_description'] }" style="width: 100%; height: 100%;border-radius: 50%;" src="/food_images/{! $value['item_img'] }">
                            </div>
                            <h4 class="text-center">{! $value['item_name'] } <p style="font-size: 60px; color: gold" class="text-center"> <span class="glyphicon glyphicon-flash" aria-hidden="true"></span></p></h4>

                            <p style="color: #000000"><?php  echo  $value['item_description'] ?></p>
                        </div>
                    </div>
                </div>

                {/foreach}


            </div>

            <hr><hr>
            <div class="row">


            {foreach($oMenu->data() as $key => $value)}



                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                    <div class="box" style="background: white">
                        <div class="box-image" style="background: url(/food_images/{! $value['menu_image'] })">
                        </div>
                        <div class="info" style="padding: 10px 25px;">
                            <div class="box-icon">
                                <img alt="{! $value['menu_desc'] }" style="width: 100%; height: 100%;border-radius: 50%;" src="/food_images/{! $value['menu_image'] }">
                            </div>
                            <h4 class="text-center">{! $value['menu_name'] }</h4>
                            <p style="color: #000000"><?php  echo  $value['menu_desc'] ?></p>
                            <a href="/menu/view/id/{! $value['menu_id'] }" class="btn">View</a>
                        </div>
                    </div>
                </div>


            {/foreach}
            </div>
        </div>




</div>


{include file=footer.php}
 