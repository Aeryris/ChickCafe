{include file=header.php}

<div id="wrap">
	<div id="main" class="container clear-top">
        <a class="btn btn-lg btn-primary" href="/menu/all">All Menus list</a>
        <a class="btn btn-lg btn-primary" href="/ingredients/view">Ingredients list</a>
        <a class="btn btn-lg btn-primary" href="/food/view">Foods list</a>
        <a class="btn btn-lg btn-primary" href="/order/all">Orders list</a>
        <br />
        <a class="btn btn-lg btn-primary" href="/menu/add">Add menu</a>
        <a class="btn btn-lg btn-primary" href="/menu/add">Add Ingredient</a>
        <a class="btn btn-lg btn-primary" href="/food/add">Add Food</a>
        <br />
        <a class="btn btn-lg btn-primary" href="/staff/staff">Staff Dashboard</a>
        <a class="btn btn-lg btn-primary" href="/staff/report">Reports</a>
        <?php if (Acl_Core::allow([ACL::ACL_OWNER])) { ?>
    		<a class="btn btn-lg btn-primary" href="/owner/owner_backup">Backup/Restore Database</a>
    	<?php } ?>
		<div role="tabpanel">
		</br>
	  <!-- Nav tabs -->
	  <ul class="nav nav-pills" id="staff_tab" role="tablist">
         <li role="presentation" class="active"><a href="#add_daily_special" aria-controls="create_daily_special" role="tab" data-toggle="tab" >Create Daily Special</a></li>
            <li role="presentation"><a href="#refund" aria-controls="refund" role="tab" data-toggle="tab" >Approve Refunds</a></li>
            <li role="presentation"><a href="#create_staff" aria-controls="create_staff" role="tab" data-toggle="tab" >Create Staff</a></li>
            <li role="presentation"><a href="#modify_staff" aria-controls="modify_staff" role="tab" data-toggle="tab" >Modify Staff</a></li>
            <li role="presentation"><a href="#delete_staff" aria-controls="register_staff" role="tab" data-toggle="tab" >Delete Staff</a></li>
	  </ul>

  <!-- Tab panes -->
		<div class="tab-content">
            <!-- <div role="tabpanel" class="tab-pane" id="add_menu">
	               <iframe src="/menu/add">


               		</iframe>
            </div>
 -->
		    <div role="tabpanel" class="tab-pane" id="add_daily_special">
	    		<h2>Create new daily specials</h2>
	    		<p>The most recent one is used as the daily special for the day. 
	    		The item must already be in the system in order for it to appear on the list</p>
			    <div class="form">
					<form class="form-inline" method="post" action="/staff/create_daily_special">
					<p>Item Name</p>
					<select class="selectpicker" name="item_id" id="item_name">
					{foreach($get_i as $key => $value)}
						<option id="{! $key}" value="{! $value['item_id']}">{! $value['item_name']}</option>
					{/foreach}
					</select>
					<p>Menu Name</p>
					<select class="selectpicker" name="menu_id" id="menu_name">
						{foreach($get_m as $key => $value)}
							<option id="{! $key}" value="{! $value['menu_id']}">{! $value['menu_name']}</option>
						{/foreach}
					</select>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Set New Daily Special</button>
					</form>
				</div>
		    </div>
		    
		    <div role="tabpanel" class="tab-pane" id="refund">
		    	<h2>Approve orders where a refund has been requested</h2>
		    	<p>This list is refreshed every day with orders from over the day </p>
		    		<!-- foreach loop goes here -->
		    		{foreach($refund as $key => $value)}
		    		<form class="form-inline" id="{! $value['order_id']}" value="{! $value['order_id']}" method="post" action="/staff/approve_refund">
		    			<p>Order ID: {! $value['order_id']}</p>
		    			<input type="hidden" name="order_id" id="order_id" value="{! $value['order_id']}">
		    			<p>Order Date/Time: {! $value['order_datetime']}</p>
		    			<input type="hidden" name="order_datetime" id="order_datetime" value="{! $value['order_datetime']}">
		    			<p> Customer Name: {! $value['user_firstname']} {! $value['user_lastname']}</p>
		    			<p>Order Price: {! $value['order_price']}</p>
		    			<input type="hidden" name="order_price" id="order_price" value="{! $value['order_price']}">
		    			<button class="btn btn-primary btn-xs" type="submit">Approve Refund</button>
					</form>
		    		{/foreach}
		    		<!-- end foreach -->
		    </div>
		    <div role="tabpanel" class="tab-pane" id="create_staff">
		    	<h2>Create a new staff memeber</h2>
		    	<p>All fields are required when created a new staff member (default type is Employee)</p>
		    	<form method="post" action="/staff/create_staff">
		    	 	<label for="inputEmail" class="sr-only">Email address</label>
	                <input name="email" type="" id="inputEmail" class="form-control" placeholder="Email address">
	                <label for="inputFirstname" class="sr-only">First name</label>
	                <input name="firstname" type="text" id="inputFirstname" class="form-control" placeholder="First Name">
	                <label for="inputLastname" class="sr-only">Last name</label>
	                <input name="lastname" type="text" id="inputLastname" class="form-control" placeholder="Last Name">
	                <label for="inputSalary" class="sr-only">Salary</label>
	                <input name="salary" type="text" id="inputSalary" class="form-control" placeholder="Salary">
	                <label for="inputRole" class="sr-only">Role</label>
	                <input name="role" type="text" id="inputRole" class="form-control" placeholder="Role">
	                <label for="inputType" class="sr-only">Type</label>
	                <select name="type" id="inputType" class="form-control">
	                	<option value="S">Staff</option>
	                	<option value="M">Manager</option>
	                	<option value="O">Owner</option>
	                </select>
	                <label for="inputPhone" class="sr-only">Phone Number</label>
	                <input name="phonenumber" type="text" id="inputPhone" class="form-control" placeholder="Phone Number">
	                <label for="inputPassword" class="sr-only">Password</label>
	                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" >
	                <label for="inputPasswordConfirm" class="sr-only">Password</label>
	                <input name="passwordconfirm" type="password" id="inputPasswordConfirm" class="form-control" placeholder="Confrim Password" >
	                <button class="btn btn-lg btn-primary btn-block" type="submit">Create new staff member</button>
                </form>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="modify_staff">
		    	<h2>Modify staff details below</h2>
				<form action="/staff/modify_staff" method="post">
			    	<div class="dropdown">
				  		<select class="selectpicker" name="staff_id" id="staff_id">
				  			{foreach($get_staff as $key => $value)}
				  				<option id="{! $key}" value="{! $value['staff_user_id']}">{! $value['user_firstname']} {! $value['user_lastname']}</option>
				  			{/foreach}
				  		</select>
					</div>
					<div class="form">
						<input type="text" class="form-control" name="role" placeholder="Staff Role" id="role" value="{! $get_staff[0]['staff_role']}">
						<input type="text" class="form-control" name="salary" placeholder="Staff Salary" id="salary" value="{! $get_staff[0]['staff_salary']}">
						<input type="text" class="form-control" name="phone" placeholder="Staff Phone Number" id="phone" value="{! $get_staff[0]['staff_phone_number']}">
						<button class="btn btn-lg btn-primary btn-block" type="submit">Modify Staff Details</button>
					</div>
				</form>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="delete_staff">
		    	<h2>Delete Staff Member</h2>
		    	<p>This will not delete staff data, it will only lock the user out of their account. Their data will remain.</p>
		    	<form action="/staff/delete_staff" method="post">
			    	<div class="dropdown">
				  		<select class="selectpicker" name="staff_id" id="staff_id">
				  			{foreach($get_staff as $key => $value)}
				  				<option id="{! $key}" value="{! $value['staff_user_id']}">{! $value['user_firstname']} {! $value['user_lastname']}</option>
				  			{/foreach}
				  		</select>
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Delete Staff Details</button>
				</form>
		    </div>
		</div>
		</div>
	</div>
</div>

{include file=footer.php}