<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>

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
		    	<h2>Item Stock</h2>
					<?php foreach($oMenuItems as $key => $value): ?>
						<span class="menu-item-name"><b>Item Name:</b> <?php echo $value['item_name'] ?></span> <br />
						<span class="menu-item-stock"><b>Stock Remaining:</b> <?php echo $value['item_available'] ?>/<?php echo $value['item_stock'] ?></span> <br />
					<?php endforeach; ?>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="orders">
		    	Current unprocessed order list goes here
		    	<?php echo $orders ?>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	<h2>Your Profile</h2>
		    	<p>Level: <?php echo $profile->role ?></p>
		    	<p>Your Salary: <?php echo number_format($profile->salary,2) ?></p>
		    	<p>Your Numbner: <?php echo $profile->phoneNumber ?></p>
		    </div>
		</div>

		</div>
	</div>
</div>


<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>