<h3>Order History</h3>
<h5 style="margin-bottom: 25px; padding: 0;">A list of all your previous order transactions</h5>
<table class="table table-striped table-bordered table-hover font-roboto" id="table-history">
	<thead>
		<tr>
 			<th>Order #</th>
        	<th>Date Ordered</th>
        	<th class="ta-right">Status</th>
      	</tr>
	</thead>
	<tbody>
	<?php
	$list = $user->get_order_history($user->get_client($_SESSION['userid']));
	if($list){
		foreach($list as $sli){?>
    	<tr id="<?php echo $sli['order_id'];?>" class="product-link select-order" onclick="ohistory_show()">
       		<td><?php echo $sli['order_id'];?></td>
       		<td><?php $date = new DateTime($sli['order_date']); echo $date->format('F j, Y');?></td>
       		<td class="ta-right"><?php switch($sli['status']){
       			case 0: 
       				echo "Pending"; 
       				break;
       			case 1:
       				echo "On Delivery";
       				break;
       			case 2:
       				echo "Delivered/Received";
       				break;

       		}?></td>
        </tr>
    <?php
    	}
	}
    ?>
	</tbody>
</table>
  <div id="ohistory-modal">
      <!-- Popup Div Starts Here -->
      <!-- Contact Us Form -->
      <div id="products-popup-order">
        <div class="modal-header">
            <span onclick ="ohistory_hide()" class="close">&times;</span>
            <h2>Order Details</h2>
          </div>
          <div id="ohistory-content" class="modal-body">
          
          </div>
      </div>
    <!-- Popup Div Ends Here -->
  </div>
<script>
    $('#table-history').dataTable();

    $(document).ready(function(){

      $('body').on("click", ".select-order", function(e){
        var row_id = $(this).attr("id");
        
        $.ajax({
            url: "profile/ajax.php",
            method: "POST",
            data:{
              "history_click": 1,
              "or_id": row_id
            },
            success: function(data){
              $('#ohistory-content').html(data);
            }
        });
      });
    });

</script>