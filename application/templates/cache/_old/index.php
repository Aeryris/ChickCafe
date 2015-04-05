<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>

<div id="wrap">
    <div id="main" class="container clear-top">

<div class="bg"></div>
<div class="jumbotron">
    <h1>Today's Daily Special</h1>
    <p class="lead">Today's daily special is...</p>

    <div class="center-block" id="view_menu">
        <div class="btn-group" role="group" aria-label="...">

            <?php foreach($menuTypes as $key => $value): ?>
            <a href="menu/view/id/<?php echo $value['menu_id'] ?>" type="button" class="btn btn-default btn-lg"><?php echo $value['menu_type_name'] ?> </a>
            <?php endforeach; ?>


        </div>
     </div>
</div>

<div class="container">





</div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>