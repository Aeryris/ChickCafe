{include file=header.php}

<script type="text/javascript">
	$('#staff_tab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})

</script>

<div id="wrap">
	<div id="main" class="container clear-top">
		<div role="tabpanel">

	  <!-- Nav tabs -->
	  <ul class="nav nav-pills" id="staff_tab" role="tablist">
	    <li role="presentation" class="active"><a href="#stock" aria-controls="stock" role="tab" data-toggle="tab">Check stock</a></li>
	    <li role="presentation"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Check orders</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" >Check staff profile</a></li>
	  </ul>

  <!-- Tab panes -->
		<div class="tab-content">

		    <div role="tabpanel" class="tab-pane active" id="stock">
		    	<h2>Item and Ingredient Stock</h2>
					{foreach($stock as $key => $value)}
						<span class="menu-item-name"><b>Ingredient Name:</b> {! $value['ingredient_name'] }</span> <br />
						<span class="menu-item-stock"><b>Stock Remaining:</b> {! $value['ingredient_available'] }/{! $value['ingredient_stock'] }</span> <br />
					{/foreach}
					{foreach($item_stock as $key => $value)}
						<span class="menu-item-name"><b>Item Name:</b> {! $value['item_name'] }</span> <br />
						<span class="menu-item-stock"><b>Stock Remaining:</b> {! $value['item_available'] }/{! $value['item_stock'] }</span> <br />
					{/foreach}
		    </div>
		    <div role="tabpanel" class="tab-pane" id="orders">
		    	Current unprocessed order list goes here
		    	{! $orders}
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	<h2>Your Profile</h2>
		    	<p>Level: {! $profile->role }</p>
		    	<p>Your Salary: {! number_format($profile->salary,2) }</p>
		    	<p>Your Number: {! $profile->phoneNumber }</p>
		    </div>
		</div>

		</div>
	</div>
</div>


{include file=footer.php}