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



<div class="container-fluid main">



    <div class="ha-bg-parallax text-center block-marginb-none overlay" data-type="background" data-speed="20">

        <div class="ha-parallax-body">

            <div class="ha-content ha-content-black">

                Guys think of some slogan or whatever text to put on here

            </div>

            <div class="ha-parallax-divider-wrapper">

                <span class="ha-diamond-divider-md img-responsive"></span>

            </div>

            <div class="ha-heading-parallax ha-content-black">ChickCafe</div>

        </div>

    </div>








    <div class="container">
        <div class="row">
            <?php foreach($oMenu->data() as $key => $value): ?>
            <a href="/menu/view/id/<?php echo $value['menu_id'] ?>">


                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    <div class="box" style="background: white">
                        <div class="box-image" style="background: url(/food_images/<?php echo $value['menu_image'] ?>)">
                        </div>
                        <div class="info" style="padding: 10px 25px;">



                            <div class="box-icon">
                                <img style="width: 100%; height: 100%;border-radius: 50%;" src="/food_images/<?php echo $value['menu_image'] ?>">

                            </div>
                            <h4 class="text-center"><?php echo $value['menu_name'] ?></h4>
                            <p style="color: #000000"><?php  echo  $value['menu_desc'] ?></p>
                            <a href="/menu/view/id/<?php echo $value['menu_id'] ?>" class="btn">View</a>
                        </div>
                    </div>
                </div>

            </a>
            <?php endforeach; ?>
        </div>
    </div>




</div>


<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>
 