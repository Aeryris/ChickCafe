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
	    
            <?php if(Acl_Core::allow([ACL::ACL_MANAGER, ACL::ACL_ADMIN, ACL::ACL_OWNER])): ?>
                <li role="presentation"><a href="#edit_menu" aria-controls="edit_menu" role="tab" data-toggle="tab" >Edit Menu</a></li>
                <li role="presentation"><a href="#daily_special" aria-controls="daily_special" role="tab" data-toggle="tab" >Edit Daily Special</a></li>
                <li role="presentation"><a href="#refund" aria-controls="refund" role="tab" data-toggle="tab" >Approve Refunds</a></li>
                <li role="presentation"><a href="#register_staff" aria-controls="register_staff" role="tab" data-toggle="tab" >Register Staff</a></li>
            <?php endif; ?>
            <?php if (Acl_Core::allow([ACL::ACL_OWNER, ACL::ACL_ADMIN])): ?>
				<li role="presentation"><a href="#database" aria-controls="database" role="tab" data-toggle="tab" >Backup/Restore Database</a></li>
            <?php endif;?>
	  </ul>

  <!-- Tab panes -->
		<div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="stock">
		    	Staff can check the stock of the food items on menus here
		    	{! $stock}
		    </div>
		    <div role="tabpanel" class="tab-pane" id="orders">
		    	Current unprocessed order list goes here
		    	{! $orders}
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	<h2>Your Profile</h2>
		    	<p>Level: {! $profile->role }</p>
		    	<p>Your Salary: {! number_format($profile->salary,2) }</p>
		    	<p>Your Numbner: {! $profile->phoneNumber }</p>
		    </div>
	      	<div role="tabpanel" class="tab-pane" id="edit_menu">
		    	Edit menu
		    </div>
		    <div role="tabpanel" class="tab-pane" id="daily_special">
		    	Daily Special
		    </div>
		    <div role="tabpanel" class="tab-pane" id="refund">
		    	Refund
		    </div>
		    <div role="tabpanel" class="tab-pane" id="Register Staff">
		    	Register Staff
		    </div>
		    <div role="tabpanel" class="tab-pane" id="database">
		    	Backup/Restore Database
		    </div>
		</div>

		</div>
	</div>
</div>


{include file=footer.php}