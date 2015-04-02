<?php Auth_Core::init()->isAuth(); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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

    <style>

        .navbar{
            min-height: 67px;
        }

        .navbar.navbar, .nav-default.navbar{
            background-color: #96bbe5;
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
            position:relative
        }
        #notificationContainer
        {
            background-color: #fff;
            border: 1px solid rgba(100, 100, 100, .4);
            -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
            overflow: visible;
            position: absolute;
            top: 50px;
            margin-left: -180px;
            width: 400px;
            z-index: 0;
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
           }
        #notificationTitle
        {
            font-weight: bold;
            padding: 8px;
            font-size: 13px;
            background-color: #ffffff;
            position: fixed;
            z-index: 1000;
            width: 384px;
            border-bottom: 1px solid #dddddd;
        }
        #notificationsBody
        {
            padding: 33px 0px 0px 0px !important;
            min-height:300px;
        }
        #notificationFooter
        {
            background-color: #e9eaed;
            text-align: center;
            font-weight: bold;
            padding: 8px;
            font-size: 12px;
            border-top: 1px solid #dddddd;
        }

        #notification_count
        {
            padding: 3px 7px 3px 7px;
            background: #cc0000;
            color: #ffffff;
            font-weight: bold;
            margin-top: 20px;
            /** margin-left: 77px; */
            border-radius: 9px;
            -moz-border-radius: 9px;
            -webkit-border-radius: 9px;
            position: absolute;
            font-size: 11px;
        }

    </style>

</head>
<body>
<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">ChickCafe</a>
            <?php if(Auth_Core::init()->isAuth()): ?>
            <div class="checkout">
                <a class="checkout__button pull-right" href="#"><!-- Fallback location -->
							<span class="checkout__text">
								<img style="height: 20px; width: 20px" src="http://mebath.com/wholesale/images/full-cart.png">
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
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/menu">Menu</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li id="notification_li">
                    <span id="notification_count">3</span>
                    <a href="#" id="notificationLink">+</a>

                    <div id="notificationContainer">
                        <div id="notificationTitle">Notifications</div>
                        <div id="notificationsBody" class="notifications"></div>
                        <div id="notificationFooter"><a href="#">See All</a></div>
                    </div>

                </li>


                <?php if(Auth_Core::init()->isAuth()): ?>
                    <li class="active"><a href="/"><?php echo User_Model::user()['user_firstname'] ?> <?php echo User_Model::user()['user_lastname'] ?><span class="sr-only">(current)</span></a></li>
                    <?php
                    if(Acl_Core::allow([ACL::ACL_MANAGER, ACL::ACL_ADMIN, ACL::ACL_OWNER])){
                        echo '<li><a href="/user/baskboard">Dashboard</a></li>';
                    }
                    ?>

                    <li><a href="/user/account">Account</a></li>
                    <li><a href="/user/logout">Logout</a></li>
                <?php endif; ?>

                <?php if(!Auth_Core::init()->isAuth()): ?>
                    <li><a href="/user/login">Login</a></li>
                    <li><a href="/user/register">Register</a></li>
                <?php endif; ?>

                <!-- Only show when user is registered -->
                <!-- <li class="active"><a href="./">User name <span class="sr-only">(current)</span></a></li> -->


            </ul>





        </div><!--/.nav-collapse -->

    </div><!--/.container-fluid -->

</nav>
