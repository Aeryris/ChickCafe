{include file=header.php}

<div id="wrap">
    <div id="main" class="container clear-top">

<div class="bg"></div>
<div class="jumbotron">
    <h1>Today's Daily Special</h1>
    <p class="lead">Today's daily special is...</p>

    <div class="center-block" id="view_menu">
        <div class="btn-group" role="group" aria-label="...">

            {foreach($menuTypes as $key => $value)}
            <a href="menu/view/id/{! $value['menu_id'] }" type="button" class="btn btn-default btn-lg">{! $value['menu_type_name'] } </a>
            {/foreach}


        </div>
     </div>
</div>

<div class="container">





</div>

    </div>
</div>

{include file=footer.php}