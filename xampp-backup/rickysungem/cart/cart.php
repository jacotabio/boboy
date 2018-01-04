<!-- <div id="products-side-navi">
		<h2>Cart</h2>
		<ul>
			<li><a class="products-label-type">OPTIONS</a></li>
			<hr style="margin-bottom: 10px; margin-top: 10px; width: 80%; margin-right: 20%; float: left; background-color: black;">
			<li><a href="products/process.php?action=removeall">REMOVE ALL</a></li>
		</ul>
</div> -->

	<div id="cart-container"></div>		<!-- ARI DI TANAN NA TABLE SANG AJAX, MR.CLEAN, DOWNY, ROBERT DOWNY IRONMAN-->

<!-- Popup Modal -->
<div id="cart-modal">
		<input type="hidden" id="id_remove">
		<div class="background_overlay" style="display:block"></div>
		<!-- Popup Div Starts Here -->
		<div id="products-popup-order">
			<div class="modal-header">
		    	<span onclick ="pop_cart_hide()" class="close">&times;</span>
		    	<h2 id="addtocart-title" value="asd">Warning</h2>
		  	</div>
		  	<div class="modal-body">
		  	Remove this item from cart? Are you sure?
		  	</div>
		  	<div class="modal-footer">
		    	<button type="submit" class="popup-cart-btn bg-green" id="remove_btn" name="submit">Remove</button>
		    	<button type="submit" class="popup-cart-btn bg-red" onclick="pop_cart_hide()" name="submit">Cancel</button>
		  	</div>
		</div>
	<!-- Popup Div Ends Here -->
</div>

<!-- Popup Modal for REMOVE ALL-->
<div id="cart-removeall-modal">
		<div class="background_overlay" style="display:block"></div>
		<!-- Popup Div Starts Here -->
		<div id="products-popup-order">
			<div class="modal-header">
		    	<span onclick ="pop_cart_removeall_hide()" class="close">&times;</span>
		    	<h2 id="addtocart-title" value="asd">Warning</h2>
		  	</div>
		  	<div class="modal-body">
		  	Remove all items in cart? This action cannot be undone.
		  	</div>
		  	<div class="modal-footer">
		    	<button type="submit" class="popup-cart-btn bg-green" onclick="pop_cart_removeall_confirm()" name="submit">Remove All</button>
		    	<button type="submit" class="popup-cart-btn bg-red" onclick="pop_cart_removeall_hide()" name="submit">Cancel</button>
		  	</div>
		</div>
	<!-- Popup Div Ends Here -->
</div>
<style> hr { background-color: #e4e4e4; height: 1px; border: 0; } </style>

<script>
$(document).ready(function(){

	displayTable();

	$('body').on("click", "#submit_checkout", function(e){
      	$.ajax({
            url: "cart/ajax.php",
            method: "POST",
            data:$("#form_cart").serialize(),
            success: function(data){
              	window.location = "index.php?mod=profile";
            }
          });
      		
     });
      	
	//RADIO BUTTON CLICKED EVENT (CONSIDERED SOLD)
     $('body').on("click", "#rdo_sold", function(e){
      $.ajax({
            url: "cart/ajax.php",
            method: "POST",
            data:{
              "payterm_radio": 1
            },
            success: function(data){
               $("#terms_field").html(data);
            }
          });
     });

     //RADIO BUTTON CLICKED EVENT (CONSIGNMENT==MONTHLY)
     $('body').on("click", "#rdo_consignment", function(e){
      $.ajax({
            url: "cart/ajax.php",
            method: "POST",
            data:{
              "payterm_radio_consignment": 1
            },
            success: function(data){
               $("#terms_field").html(data);
            }
          });
     });

	$("#remove_btn").click(function(){
		var id_remove = $("#id_remove").val();
		$.ajax({
			url: "cart/ajax.php",
			method: "POST",
			data:{
				"remove_cart": 1,
				"id": id_remove
			},
			success: function(data){
				updateCartCounter();
				pop_cart_hide();
				displayTable();
				
			}
		});
	});
});

function displayTable(){
	$.ajax({
			url: "cart/ajax.php",
			method: "POST",
			data:{
				"display_table": 1
			},
			success: function(data){
				$("#cart-container").html(data);
			}
	});
	$.ajax({
            url: "cart/ajax.php",
            method: "POST",
            data:{
              "payterm_radio": 1
            },
            success: function(data){
               $("#terms_field").html(data);
            }
          });

}

	
function updateCartCounter()
	{ 
	    $( "#cart-item-counter" ).load(window.location.href + " #cart-item-counter" );
	}
</script>