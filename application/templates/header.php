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
    <link rel="stylesheet" href="/application/assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/application/assets/css/styles.css">
    <link rel="stylesheet" href="/application/assets/css/main.css">
    <script src="/application/assets/js/modernizr.min.js"></script>
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
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php if(Auth_Core::init()->isAuth()): ?>
                    <li class="active"><a href="/"><?php echo User_Model::user()['user_firstname'] ?> <?php echo User_Model::user()['user_lastname'] ?><span class="sr-only">(current)</span></a></li>
                    <li><a href="/basket/view">Basket</a></li>
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