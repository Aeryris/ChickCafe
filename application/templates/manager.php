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
            <li role="presentation"><a href="#edit_menu" aria-controls="edit_menu" role="tab" data-toggle="tab" >Edit Menu</a></li>
            <li role="presentation"><a href="#daily_special" aria-controls="daily_special" role="tab" data-toggle="tab" >Edit Daily Special</a></li>
            <li role="presentation"><a href="#refund" aria-controls="refund" role="tab" data-toggle="tab" >Approve Refunds</a></li>
            <li role="presentation"><a href="#create_staff" aria-controls="manage_staff" role="tab" data-toggle="tab" >Create Staff</a></li>
            <li role="presentation"><a href="#delete_staff" aria-controls="register_staff" role="tab" data-toggle="tab" >Delete Staff</a></li>
	  </ul>

  <!-- Tab panes -->
		<div class="tab-content">
	      	<div role="tabpanel" class="tab-pane" id="edit_menu">
		    	Edit menu
		    </div>
		    <div role="tabpanel" class="tab-pane" id="daily_special">
		    	Daily Special
		    </div>
		    <div role="tabpanel" class="tab-pane" id="refund">
		    	Refunds
		    </div>
		    <div role="tabpanel" class="tab-pane" id="manage_staff">
		    	<form method="post" action="">
		    	 	<label for="inputEmail" class="sr-only">Email address</label>
	                <input name="email" type="" id="inputEmail" class="form-control" placeholder="Email address"  value="<?php echo User_Model::user()['user_email'] ?>">
	                <label for="inputFirstname" class="sr-only">First name</label>
	                <input name="firstname" type="text" id="inputFirstname" class="form-control" value="<?php echo User_Model::user()['user_firstname'] ?>">
	                <label for="inputLastname" class="sr-only">Last name</label>
	                <input name="lastname" type="text" id="inputLastname" class="form-control" value="<?php echo User_Model::user()['user_lastname'] ?>" >
	                <label for="inputSalary" class="sr-only">Salary</label>
	                <input name="salary" type="text" id="inputSalary" class="form-control">
	                <label for="inputRole" class="sr-only">Role</label>
	                <input name="role" type="text" id="inputRole" class="form-control">
	                <label for="inputPassword" class="sr-only">Password</label>
	                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" >
	                <label for="inputPasswordConfirm" class="sr-only">Password</label>
	                <input name="passwordconfirm" type="password" id="inputPasswordConfirm" class="form-control" placeholder="Confrim Password" >
	                <button class="btn btn-lg btn-primary btn-block" type="submit">Create new staff member</button>
                </form>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="delete_staff">
		    	Delete Staff
		    </div>
		</div>

		</div>
	</div>
</div>


{include file=footer.php}