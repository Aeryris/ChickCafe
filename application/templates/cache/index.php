<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>

<div id="wrap">
    <div id="main" class="container clear-top">

<div class="bg"></div>
<div class="jumbotron" style="height: 100%">
    <div style="font-size:60px ;width: 100%; height: 200px;background: url(http://vignette2.wikia.nocookie.net/stargate/images/f/fe/Coffee.jpeg/revision/latest?cb=20150309203723);  background-repeat: no-repeat;  background-size: cover;">
       Today's Daily Special


    </div>

    <p class="lead">Today's daily special is...</p>


    <div class="center-block" id="view_menu" style="height: 400px; overflow: auto">
        <div style="display: none" class="btn-group" role="group" aria-label="...">

            <?php foreach($menuTypes as $key => $value): ?>
            <a href="menu/view/id/<?php echo $value['menu_id'] ?>" type="button" class="btn btn-default btn-lg"><?php echo $value['menu_type_name'] ?> </a>
            <?php endforeach; ?>


        </div>

        <div class="current-menus">
            <?php foreach($oMenu->data() as $key => $value): ?>
            <a href="menu/view/id/<?php echo $value['menu_id'] ?>">
            <div style="color: black" class="cardView">
                <div style="width: 150px; height: 150px; float: left" class="food_image">

                    <img style="height: 100%; width: 100%;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" src="/food_images/<?php echo $value['menu_image'] ?>">
                </div>
                <div class="food_data" style="float: left; margin-left: 10px">
                <span><b></b> <?php echo $value['menu_name'] ?></span> <br />
                <span><b>Start time:</b> <?php echo $value['menu_time_start'] ?></span> <br />
                <span><b>End time:</b> <?php echo $value['menu_time_end'] ?></span> <br />
                    </div>
            </div>
                </a>
            <?php endforeach; ?>
        </div>
     </div>
</div>

<div class="container">





</div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>