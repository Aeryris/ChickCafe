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
		    <div role="tabpanel" class="tab-pane active" id="stock">
		    	Orders processed
		    	<table>
		    		<thead>
		    			
		    		</thead>
		    		<tbody>
		    			
		    		</tbody>
		    	</table>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="orders">
		    	Customer Spending
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	Refunds processed
		    </div>
		</div>

		</div>
	</div>
</div>


{include file=footer.php}