{include file=header.php}

<div id="wrap">
    <div id="main" class="container clear-top">

<div class="bg"></div>
<div class="jumbotron" style="height: 100%">
    <div style="font-size:60px ;width: 100%; height: 200px;background: url(http://vignette2.wikia.nocookie.net/stargate/images/f/fe/Coffee.jpeg/revision/latest?cb=20150309203723);  background-repeat: no-repeat;  background-size: cover;">
       Today's Daily Special


    </div>

    {foreach($dailySpecial as $key => $value)}
    <p class="lead" style="color:gray;">Today's daily special is... {! $value['item_name']}</p>
    {/foreach}


    <div class="center-block" id="view_menu" style="height: 400px; overflow: auto">
        <div style="display: none" class="btn-group" role="group" aria-label="...">
            {foreach($menuTypes as $key => $value)}
            <a href="menu/view/id/{! $value['menu_id'] }" type="button" class="btn btn-default btn-lg">{! $value['menu_type_name'] } </a>
            {/foreach}


        </div>

        <div class="current-menus">
            {foreach($oMenu->data() as $key => $value)}
            <a href="menu/view/id/{! $value['menu_id'] }">
            <div style="color: black" class="cardView">
                <div style="width: 150px; height: 150px; float: left" class="food_image">

                    <img style="height: 100%; width: 100%;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" src="/food_images/{! $value['menu_image'] }">
                </div>
                <div class="food_data" style="float: left; margin-left: 10px">
                <span><b></b> {! $value['menu_name'] }</span> <br />
                <span><b>Start time:</b> {! $value['menu_time_start'] }</span> <br />
                <span><b>End time:</b> {! $value['menu_time_end'] }</span> <br />
                    </div>
            </div>
                </a>
            {/foreach}
        </div>
     </div>
</div>

<div class="container">




</div>

    </div>
</div>

{include file=footer.php}