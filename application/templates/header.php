<?php Auth_Core::init()->isAuth(); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ChickCafe</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/application/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/application/assets/css/material.min.css">
    <link rel="stylesheet" href="/application/assets/css/styles.css">
    <link rel="stylesheet" href="/application/assets/css/main.css">
    <script src="/application/assets/js/modernizr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/application/assets/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/application/assets/fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/application/assets/css/checkout-cornerflat.css" />
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/application/assets/js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="/application/assets/js/jquery.datetimepicker.js"></script>
    <link rel="stylesheet" href="/application/assets/js/jquery.datetimepicker.css">


    <link rel="stylesheet" type="text/css" href="/application/assets/css/jquery.timepicker.css" />
    <script type="text/javascript" src = "/application/assets/js/jquery.cre-animate.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#menu_start_time').datetimepicker({
        });

        $('#menu_end_time').datetimepicker({
        });

        $(document).on('click', 'a', function (){



        });



    });

    function run(url){
        window.location.assign('/order/view/id/'+url);
    }

    $(function () {

        "use strict";

        var $bgobj = $(".ha-bg-parallax"); // assigning the object

        $(window).on("scroll", function () {

            var yPos = -($(window).scrollTop() / $bgobj.data('speed'));

            // Put together our final background position

            var coords = '100% ' + yPos + 'px';

            // Move the background

            $bgobj.css({ backgroundPosition: coords });

        });
        $('div.product-chooser').not('.disabled').find('div.product-chooser-item').on('click', function(){
            $(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
            $(this).addClass('selected');
            $(this).find('input[type="radio"]').prop("checked", true);

        });



    });

    $(document).ready(function(){
        $(window).bind('scroll', function() {
            var navHeight = 67; // custom nav height
            //($(window).scrollTop() > navHeight) ? $('nav').addClass('goToTop') : $('nav').removeClass('goToTop');
        });
    });
    </script>
    <style>

        .navbar{
            min-height: 67px;
            margin-bottom: 0px !important;
            border-bottom: solid #ffb302 3px;
        }

        .navbar.navbar, .nav-default.navbar{
            background-color: #000000;
        }
        <?php if(Auth_Core::init()->isAuth()): ?>
        .navbar-nav.navbar-right {
            margin-right:30px !important;
        }
        <?php endif; ?>

        #nav{list-style:none;margin: 0px;padding: 0px;}
        #nav li {
            float: left;
            margin-right: 20px;
            font-size: 14px;
            font-weight:bold;
        }
        #nav li a{color:#333333;text-decoration:none}
        #nav li a:hover{color:#006699;text-decoration:none}

        #notification_li
        {
            position:relative;
            height: 50px;
            width: 50px;
        }
        #notificationContainer
        {
            background-color: #fff;
            border: 1px solid #fff;
            -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
            overflow: visible;
            position: absolute;
            top: 50px;
            margin-left: -174px;
            width: 400px;
            z-index: 9999;
            display: none;
        }

           #notificationContainer:before {
               content: '';
               display: block;
               position: absolute;
               width: 0;
               height: 0;
               color: transparent;
               border: 10px solid black;
               border-color: transparent transparent white;
               margin-top: -20px;
               margin-left: 188px;
               z-index: 1000;
           }
        #notificationTitle
        {
            font-weight: bold;
            padding: 8px;
            font-size: 13px;
            background-color: #000;

            z-index: 1000;
            width: 100%;

        }
        #notificationsBody
        {
            padding: 33px 0px 0px 0px !important;
            min-height:300px;
            color: black;

            max-height: 300px;
            overflow: auto;
        }
        #notificationFooter
        {
            color: #fff;
            background-color: #000;
            text-align: center;
            font-weight: bold;
            padding: 8px;
            font-size: 12px;

        }

        #notification-body-list{
            padding-left: 0px;
            margin-left: 5px;
        }

        #notification-body-list li{
            list-style: none;
            border-bottom: solid 1px #dcdcdc;
            height: 50px;
        }

        #notification_count
        {
            padding: 2px 7px 2px 7px;
            background: #cc0000;
            color: #ffffff;
            font-weight: bold;
            margin-top: 13px;
            margin-left: 28px;
            border-radius: 9px;
            -moz-border-radius: 9px;
            -webkit-border-radius: 9px;
            position: absolute;
            font-size: 11px;

            z-index: 10;

        }
        .pusleAnimation{

            -webkit-animation: pulse 0.2s linear infinite;
            animation: pulse 0.2s linear infinite;

        }

        .pulseAnimationdEnd{
            -webkit-animation: none;
            animation: none;
        }





        @-webkit-keyframes pulse {
            0% {
                -webkit-transform: scale(1, 1);
            }
            50% {
                -webkit-transform: scale(1.4, 1.4);
            }
            100% {
                -webkit-transform: scale(1, 1);
            };
        }

        @keyframes pulse {
            0% {
                transform: scale(1, 1);
            }
            50% {
                transform: scale(1.4, 1.4);
            }
            100% {
                transform: scale(1, 1);
            };
        }

        .cardView{
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            float: left;
            margin-left: 10px;
            width: 40%;
            padding: 5px 5px 5px 5px;
            background-color: rgba(255, 248, 248, 0.50);
            margin-bottom: 10px;
            -webkit-box-shadow: 10px 10px 53px -21px rgba(0,0,0,0.66);
            -moz-box-shadow: 10px 10px 53px -21px rgba(0,0,0,0.66);
            box-shadow: 10px 10px 53px -21px rgba(0,0,0,0.66);
        }

        body{
            background: #FFFFFF;
        }

        a{
            color: black;
        }

        a:hover{
            color: black;
        }

        .btn-primary:not(.btn-link):not(.btn-flat) {
            background-color: #ffb302;
            color: rgba(255,255,255,.84);
        }

        .btn-primary:not(.btn-link):not(.btn-flat):hover {
            background-color: #cc8e02;
            color: rgba(255,255,255,.84);
        }

        .well:before, .well:after {
            z-index: -1;
            position: absolute;
            content:"";
            bottom: 15px;
            left: 20px;
            width: 50%;
            top: 80%;
            max-width: 300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }
        .well:after {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 20px;
            left: auto;
        }

    </style>

</head>
<body>
<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">

            <a class="navbar-brand" href="/"> <i class="fa fa-coffee"></i> ChickCafe</a>
            <?php if(Auth_Core::init()->isAuth()): ?>
            <div class="checkout">
                <a class="checkout__button pull-right" href="#"><!-- Fallback location -->
							<span class="checkout__text">
								<i class="fa fa-shopping-cart"></i>
							</span>
                </a>
                <div class="checkout__order">
                    <div class="checkout__order-inner">
                        <table class="checkout__summary">
                            <thead>
                            <tr><th>Order</th><th>Quantity</th><th>Price</th></tr>
                            </thead>
                            <tfoot>
                            <tr><th colspan="3">Total <span class="checkout__total"></span></th></tr>
                            </tfoot>
                            <tbody class="checkout-items-list">

                            </tbody>
                        </table><!-- /checkout__summary -->
                        <button class="checkout__option checkout__option--silent checkout__cancel"><i class="fa fa-angle-left"></i> Continue Shopping</button>

                        <a href="/basket/view" class="checkout__option">Checkout</a>
                        <button class="checkout__close checkout__cancel"><i class="icon fa fa-fw fa-close"></i>Close</button>
                    </div><!-- /checkout__order-inner -->
                </div><!-- /checkout__order -->
            </div><!-- /checkout -->

            <?php endif; ?>
            <button type="button" style="margin-top: 15px;margin-right: 80px" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/menu"><i class="fa fa-spoon"></i> Menu</a></li>
                <li><a href="/aboutus"><i class="fa fa-info-circle"></i> About Us</a></li>
                <li><a href="#"><i class="fa fa-at"></i> Contact Us</a></li>



                <?php if(Auth_Core::init()->isAuth()): ?>
                <li id="notification_li" style="margin: 0 auto;">
                    <span id="notification_count"></span>
                    <a href="#" style=""><img alt="Basket" id="notificationLink" style="width: 100%; " src="http://iconizer.net/files/Facebook/orig/notifications.png"></a>

                    <div id="notificationContainer" >
                        <div id="notificationTitle">Notifications</div>
                        <div id="notificationsBody" class="notifications"></div>
                        <div id="notificationFooter"><a style="color: #ffffff" href="#">See All</a></div>
                    </div>

                </li>

                    <li class="active"><a href="/"><?php echo User_Model::user()['user_firstname'] ?> <?php echo User_Model::user()['user_lastname'] ?><span class="sr-only">(current)</span></a></li>
                    <?php
                    if(Acl_Core::allow([ACL::ACL_MANAGER, ACL::ACL_ADMIN, ACL::ACL_OWNER, ACL::ACL_CUSTOMER, ACL::ACL_OWNER])){
                        echo '<li><a href="/user/dashboard">Dashboard</a></li>';
                    }
                    ?>

                    <li><a href="/user/account"><i class="fa fa-user"></i> Account</a></li>
                    <li style=""><a href="/user/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                <?php endif; ?>

                <?php if(!Auth_Core::init()->isAuth()): ?>
                    <li><a href="/user/login"><i class="fa fa-sign-in"></i> Login</a></li>
                    <li><a href="/user/register"><i class="fa fa-sign-out"></i> Register</a></li>
                <?php endif; ?>

                <!-- Only show when user is registered -->
                <!-- <li class="active"><a href="./">User name <span class="sr-only">(current)</span></a></li> -->


            </ul>





        </div><!--/.nav-collapse -->

    </div><!--/.container-fluid -->

</nav>