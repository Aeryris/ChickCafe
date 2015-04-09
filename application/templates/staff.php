{include file=header.php}

<script type="text/javascript">
	$('#staff_tab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})

</script>

<div id="wrap">
	<div id="main" class="container clear-top">
		<?php if(Acl_Core::allow([ACL::ACL_MANAGER,ACL::ACL_OWNER,ACL::ACL_ADMIN])){
        	echo '<a class="btn btn-lg btn-primary" href="/staff/manager">Manager Dashboard</a>';
        	echo '<a class="btn btn-lg btn-primary" href="/staff/report">Reports</a>';
        } else {

        	} ?>

        <?php if (Acl_Core::allow([ACL::ACL_OWNER])) {
    		echo '<a class="btn btn-lg btn-primary" href="/owner/owner">Backup/Restore Database</a>';
        }?>
		<div role="tabpanel">

	  <!-- Nav tabs -->
	  <ul class="nav nav-pills" id="staff_tab" role="tablist">
	    <li role="presentation" class="active"><a href="#stock" aria-controls="stock" role="tab" data-toggle="tab">Check stock</a></li>
	    <li role="presentation"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Check orders</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" >Check staff profile</a></li>
	    <li role="presentation"><a href="#performance" aria-controls="profile" role="tab" data-toggle="tab" >Check staff performance</a></li>
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
		    	{foreach($orders as $key => $value)}
		    		<form method="post" value="{! $value['order_id']}" method="post" action="/staff/ready_order">
	    			<p>Order ID: {! $value['order_id']}</p>
	    			<input type="hidden" name="order_id" id="order_id" value="{! $value['order_id']}"/>
	    			<p>Order Date/Time: {! $value['order_datetime']}</p>
	    			{foreach ($value['item_names'] as $k1 => $v1)}
	    				<p>Item name: {! $v1}</p>
	    				{foreach ($value['item_preptimes'] as $k1 => $v1)}
	    				<p>Item preptime: {! $v1}</p>
	    				{/foreach}
	    			{/foreach}
	    			<!-- <input type="hidden" name="staff_id" id="staff_id" value="{! $profile->user_id}"/> -->
	    			<button class="btn btn-primary" type="submit">Order is Ready</button>
	    			</form>
		    	{/foreach}
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	<h2>Your Profile</h2>
		    	<p>Level: {! $profile->role }</p>
		    	<p>Your Salary: £{! number_format($profile->salary,2) }</p>
		    	<p>Your Number: {! $profile->phoneNumber }</p>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="performance">
		    	<h2>Staff Performance</h2>
		    	<p>Total orders taken: {! $performance['orders_made']}</p>
		    	<p>Average prep time: {! $performance['item_total_prep']} minutes per order</p>
		    	<p>Money made: £{! number_format($performance['order_value'],2)}</p>
		    </div>
		    
		</div>

		</div>
	</div>
</div>


{include file=footer.php}