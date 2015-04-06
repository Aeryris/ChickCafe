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
	    <li role="presentation" class="active"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Orders processed</a></li>
	    <li role="presentation"><a href="#spending" aria-controls="spending" role="tab" data-toggle="tab">Customer spending report</a></li>
	    <li role="presentation"><a href="#refunds" aria-controls="refunds" role="tab" data-toggle="tab" >Refunds processed</a></li>
	    <li role="presentation"><a href="#stock" aria-controls="stock" role="tab" data-toggle="tab" >Stock report</a></li>
	  </ul>

  <!-- Tab panes -->
		<div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="orders">
		    	<h2>Orders processed in the last 3 months</h2>
		    	<table class="table">
		    		<tr>
		    			<th>Order ID</th>
		    			<th>Customer Name</th>
		    			<th>Customer ID</th>
		    			<th>Order Price</th>
		    			<th>Order Date</th>
		    			<th>Order Items</th>
		    			<th>Order Priority</th>
		    			<th>Order Type</th>
		    			<th>Order Staff ID</th>
		    			<th>Refund ID</th>
		    		</tr>
		    		{foreach($orders as $key => $value)}
		    		<tr class="info">
						<td>{! $value['order_id']}</td>
						<td>{! $value['user_firstname']} {! $value['user_lastname']}</td>
						<td>{! $value['user_id']}</td>
						<td>{! $value['order_price']}</td>
						<td>{! $value['order_datetime']}</td>
						<td><?php
							echo implode($value['item_names'], ', '); 
						?></td>
						<td>{! $value['order_priority']}</td>
						<td>{! $value['order_type']}</td>
						<td>{! $value['order_staff_id']}</td>
						<td>{! $value['refund_refund_id']}</td>
		    		</tr>
		    		{/foreach}
		    	</table>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="spending">
		    	<h2>Customer spending table</h2>
		    	<table class="table">
		    		<tr>
			    		<th>Customer ID</th>
			    		<th>Customer Name</th>
		    			<th>Total Spent by Customer</th>
		    		</tr>
			    	{foreach($customer_spending as $key => $value)}
						<tr class="info">
							<td>{! $value['user_id']}</td>
							<td>{! $value['user_firstname']} {! $value['user_lastname']}</td>
							<td>{! $value['customer_spending_total']}</td>
						</tr>
			    	{/foreach}
	    		</table>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="refunds">
		    	<h2>Refunds processed (and by which Manager)</h2>
		    	<table class="table">
		    		<tr>
		    			<th>Order ID</th>
		    			<th>Refund ID</th>
		    			<th>Order Date</th>
		    			<th>Refund Date</th>
		    			<th>Order/Refund Amount</th>
		    			<th>Customer ID</th>
		    			<th>Customer Name</th>
		    			<th>Staff ID</th>
		    		</tr>
		    		{foreach($refunds as $key => $value)}
		    		<tr class="info">
		    			<td>{! $value['order_id']}</td>
		    			<td>{! $value['refund_refund_id']}</td>
		    			<td>{! $value['refund_date']}</td>
		    			<td>{! $value['refund_amount']}</td>
		    			<td>{! $value['user_id']}</td>
		    			<td>{! $value['user_firstname']} {! $value['user_lastname']}</td>
		    			<td>{! $value['order_staff_id']}</td>
		    		</tr>
		    		{/foreach}
		    	</table>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="stock">
		    	<h2>Ingredient Stock Report</h2>
		    	<table class="table">
		    		<tr>
		    			<th>Item ID</th>
		    			<th>Item Name</th>
		    			<th>Ingredient Name</th>
		    			<th>Item Price</th>
		    			<th>Ingredient ID</th>
		    			<th>Ingredient Stock</th>
		    		</tr>
		    		{foreach($stock as $key => $value)}
		    		<tr class="info">
		    			<td>{! $value['item_id']}</td>
		    			<td>{! $value['item_name']}</td>
		    			<td>{! $value['ingredient_name']}</td>
		    			<td>{! $value['item_price']}</td>
		    			<td>{! $value['ingredient_id']}</td>
		    			<td>{! $value['ingredient_stock']}</td>
		    		</tr>	
		    		{/foreach}
		    	</table>
		    </div>
		</div>

		</div>
	</div>
</div>


{include file=footer.php}