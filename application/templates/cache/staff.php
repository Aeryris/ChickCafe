<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>

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
					<?php foreach($stock as $key => $value): ?>
						<span class="menu-item-name"><b>Ingredient Name:</b> <?php echo $value['ingredient_name'] ?></span> <br />
						<span class="menu-item-stock"><b>Stock Remaining:</b> <?php echo $value['ingredient_available'] ?>/<?php echo $value['ingredient_stock'] ?></span> <br />
					<?php endforeach; ?>
					<?php foreach($item_stock as $key => $value): ?>
						<span class="menu-item-name"><b>Item Name:</b> <?php echo $value['item_name'] ?></span> <br />
						<span class="menu-item-stock"><b>Stock Remaining:</b> <?php echo $value['item_available'] ?>/<?php echo $value['item_stock'] ?></span> <br />
					<?php endforeach; ?>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="orders">
		    	<?php foreach($orders as $key => $value): ?>
		    		<form method="post" value="<?php echo $value['order_id'] ?>" method="post" action="/staff/ready_order">
	    			<p>Order ID: <?php echo $value['order_id'] ?></p>
	    			<input type="hidden" name="order_id" id="order_id" value="<?php echo $value['order_id'] ?>"/>
	    			<p>Order Date/Time: <?php echo $value['order_datetime'] ?></p>
	    			<?php foreach ($value['item_names'] as $k1 => $v1): ?>
	    				<p>Item name: <?php echo $v1 ?></p>
	    				<?php foreach ($value['item_preptimes'] as $k1 => $v1): ?>
	    				<p>Item preptime: <?php echo $v1 ?></p>
	    				<?php endforeach; ?>
	    			<?php endforeach; ?>
	    			<!-- <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $profile->user_id ?>"/> -->
	    			<button class="btn btn-primary" type="submit">Order is Ready</button>
	    			</form>
		    	<?php endforeach; ?>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	<h2>Your Profile</h2>
		    	<p>Level: <?php echo $profile->role ?></p>
		    	<p>Your Salary: £<?php echo number_format($profile->salary,2) ?></p>
		    	<p>Your Number: <?php echo $profile->phoneNumber ?></p>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="performance">
		    	<h2>Staff Performance</h2>
		    	<p>Total orders taken: <?php echo $performance['orders_made'] ?></p>
		    	<p>Average prep time: <?php echo $performance['item_total_prep'] ?> minutes per order</p>
		    	<p>Money made: £<?php echo number_format($performance['order_value'],2) ?></p>
		    </div>
		    
		</div>

		</div>
	</div>
</div>


<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>