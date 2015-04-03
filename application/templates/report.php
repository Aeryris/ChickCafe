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
		    		</tr>
		    		<tr class="info">
						
		    		</tr>
		    	</table>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="spending">
		    	<h2>Customer spending table</h2>
		    	<table class="table">
		    		<tr>
			    		<th>Customer ID</th>
			    		<th>Customer Name</th>
		    			<th>Total Spent by Customer</th>
		    			<th>Orders made</th>
		    		</tr>
		    		<tr>
		    			
		    		</tr>
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
		    			<th>Staff Name</th>
		    		</tr>
		    	</table>
		    </div>
		</div>

		</div>
	</div>
</div>


{include file=footer.php}