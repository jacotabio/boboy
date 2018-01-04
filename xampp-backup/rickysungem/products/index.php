	<div id="hiddenmenu3">
				<ul>
					<button id="crossmenu2">&#735;</button>
					<div id="hiddencat">Category</div>
					<a href="index.php?mod=products&cat=all"><li>ALL</li></a>
					<?php
					$cat = $product->get_category();

					foreach($cat as $values){
					?>
					<a class="action-link" href="index.php?mod=products&cat=<?php echo $values['cat_id'];?>"><li><?php echo $values['cat_name'];?></li></a>
					<?php
					}	
					?>
				</ul>
	</div>
	<div class="card-wrapper-sub widt-change w-20">
	<div id="hiddenmenu2">
		<button id="burgersmenu2">&#9776;</button>
	</div>
		<div class="card-style indicate w-100">
			<div id="products-side-navi">
				<h2>Category</h2>
				<ul>
					<li><a class="products-label-type">TYPE</a>
					<li><a><hr style="padding: 0; margin-top: 10px; margin-bottom: 10px; border-color: #888888;"></a>
					<li><a href="index.php?mod=products&cat=all">ALL</a>
					<?php
					$cat = $product->get_category();

					foreach($cat as $values){
					?>
					<li><a href="index.php?mod=products&cat=<?php echo $values['cat_id'];?>"><?php echo $values['cat_name'];?></a>
					<?php
					}	
					?>
				</ul>
			</div>
		</div>
	</div><!--
	-->
	<!-- POPUP MODAL CODE -->
	<?php
	if($user->get_session()){
	?>
	<div id="popup-modal">
			<!-- Popup Div Starts Here -->
			<!-- Contact Us Form -->
			<div id="products-popup-order">
				<input type="hidden" id="addtocart-id" value="000">
				<div class="modal-header">
			    	<span onclick ="div_hide()" class="close">&times;</span>
			    	<h2 id="addtocart-title">Product Name</h2>
			  	</div>
			  	<div class="modal-body">
			  	<div class="float-right">
			  		<label>Packaging</label></br><p class="float-right" id="popup-display-packaging"></p>
			  	</div>
			  	<div class="block">
			  		<label>Brand</label></br><p id="popup-display-brand"></p>
			  	</div>

			  	<div class="block">
			  		<label>Formulation</label></br><p id="popup-display-formulation"></p>
			  	</div>
			  	
			  	<div class="float-right">
			  		<label>Unit Price</label></br><p class="float-right" id="popup-display-price"></p><input type="hidden" id="addtocart-price" class="popup-qty bold" value="1">
			  	</div>
			  	<div class="block">
			  		<label>Stocks</label></br><p id="curr-qty"></p>
			  	</div>
			  	<div id="atc_input">
				  	<label>Order Quantity</label></br>
				    	<input type="number" step="1" id="addtocart-qty" class="popup-qty" min="1" value="1" name="qty" required/>
				  	</div>
			  	</div>
			  	<div class="modal-footer">
			    	<button type="submit" id="atc_btn" class="popup-qty-btn" name="submit">Add to Cart</button>
			    	<p id="out-of-stock">OUT OF STOCK</p>
			  	</div>
			</div>
		<!-- Popup Div Ends Here -->
	</div>
	<?php
	}else{
	?>
	<div id="popup-modal">
			<div id="products-popup-order">
				<div class="modal-header">
			    	<span onclick ="div_hide()" class="close">&times;</span>
			    	<h2>Notice</h2>
			  	</div>
			  	<div class="modal-body">
			  	<h5>You need to be logged in to view more details.</h5>
			  	<a href="index.php?mod=login">Click here to login</a>
			  	</div>
			  	<div class="modal-footer">
			    	<button type="submit" class="popup-btn" onclick="login_alert_OK()" name="submit">OK</button>
			  	</div>
			</div>
	</div>
	<?php
	}
	if(!$user->get_session()){
		if($_GET['cat'] != 'all'){
	?>
	<div class="card-wrapper-leftright notloginminimum w-80">
		<div class="card-style w-100">
			<div id="products-info">
			<?php
			$c_info = $product->get_cat_info($_GET['cat']);
			foreach($c_info as $c){
			?>
		    	<h3 style="font-weight: 400; font-family: 'Roboto', sans-serif;"><?php echo $c['cat_name'];?></h3>
				<h6 style="padding: 10px 0px 0px 0px; margin: 0;"><i style="color: black;font-weight: 400; font-family: 'Roboto', sans-serif;">Definition</i></h6>
		    	<p><?php echo $c['description'];?></p>
		    	<h5 style="padding: 10px 0px 0px 0px; margin:0;font-size: 12px; color: black; font-weight: 400; font-family: 'Roboto', sans-serif;">Source:</h5>
		    	<a href="https://en.wikipedia.org/wiki/Antibiotics">https://en.wikipedia.org/wiki/Antibiotics</a>
		    <?php
			}
		    ?>

		  	</div>
	  	</div>
  	</div>
  	<div class="card-wrapper main-men">
	  	<div class="product-list-wrapper">
					<div id="products-right-header" class="bc-green fc-white">
						<h3 style="font-weight: 400;">Product List</h3>
						<h5 style="font-weight: 400;" class="product-filter-label">
						<?php 
						if(isset($_GET['cat'])){
							if($_GET['cat'] != "all"){
						?>
						Filter by <?php echo $product->get_category_name($_GET['cat']);?>
						<?php
								}
							}
						?>
						</h5>
					</div>
					<div class="col30">
						<div id="products-right-content"></div>
					</div>
		</div>
	</div>
  	<?php
  		}else{
  		?>
  		<div class="card-wrapper notloginall w-80">
	  		<div class="card-style w-100">
				<div id="products-right-content"></div>
			</div>
		</div>
  		<?php	
  		}
  	}else{?>
	<!-- Main Content Starts Here -->
	<div class="card-wrapper w-80">
		<?php
		if($_GET['cat'] != "all"){
		?>
			<div class="card-style test-one w-100">
				<div id="products-right-content"></div>
			</div>
		<?php
		}else{
		?>
		<div class="card-style">
			<div id="products-right-content"></div>
		</div>
		<?php
		}
		?>
	</div>
	<?php
	}
	?>
    <script>
    $(document).ready(function(){

    	$('#addtocart-qty').on('keypress', function(e){
		  return e.metaKey || // cmd/ctrl
		    e.which <= 0 || // arrow keys
		    e.which == 8 || // delete key
		    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
		});

    	$("#popup-modal").click(function(){
    		//document.getElementById("popup-modal").style.display = "none";
    	});
    	
      	displayProductsTable();
      	$("#atc_btn").click(function(){ 
	      	if($("#addtocart-qty").val() != "" && $("#addtocart-qty").val() != null){		
				var atc_id = $("#addtocart-id").val();
				var atc_qty = $('#addtocart-qty').val();
				var atc_price = $('#addtocart-price').val();
				var display_qty = $('#curr-qty').html();

				if(atc_qty > 0){
					if(parseInt(display_qty) >= atc_qty){
						var subtotal = atc_qty * atc_price;
						$.ajax({
							url: "products/ajax.php",
							method: "POST",
							data:{
								"add_cart": 1,
								"atc_qty": atc_qty,
								"id": atc_id,
								"subtotal": subtotal
							},
							success: function(data){
								updateCartCounter();
								div_hide();
								clearOrderQty();
							}
						});
					}else{
						alert("Insufficient Stocks");
					}
				}else{
					alert("Only positive non-zero numeric values.");
				}
			}else{
				alert("Please enter quantity");
			}
		});

      	

      	$('body').on("click", ".select-product", function(e){
      		var row_id = $(this).attr("id");
      		$.ajax({
				url: "products/ajax.php",
				method: "POST",
				data:{
					"modal_info": 1,
					"modal_id": row_id
				},
				dataType: "json",
				success: function(data){
					$("#addtocart-id").val(data.pro_id);
					$("#addtocart-title").html(data.pro_generic);
					$("#popup-display-brand").html(data.pro_brand);
					$("#popup-display-price").html("PHP " + data.pro_unit_price);
					$("#popup-display-packaging").html(data.pro_packaging);
					$("#popup-display-formulation").html(data.pro_formulation);
					$("#curr-qty").html(data.pro_total_qty);
					$("#addtocart-price").val(data.pro_unit_price);
					if(parseInt(data.pro_total_qty) == 0){
						document.getElementById('atc_input').style.display = "none";
						document.getElementById('atc_btn').style.display = "none";
						document.getElementById('out-of-stock').style.display = "block";	
					}else{
						document.getElementById('atc_input').style.display = "block";
						document.getElementById('atc_btn').style.display = "block";
						document.getElementById('out-of-stock').style.display = "none";
					}
				}
			});
      	});
    });


    function displayProductsTable(){
    	var cat = <?php echo (json_encode($_GET['cat']));?>;
		$.ajax({
			url: "products/ajax.php",
			method: "POST",
			data:{
				"display_products": 1,

				"cat_id": cat
			},
			success: function(data){
				$("#products-right-content").html(data);
			}
		});
	}

	function clearOrderQty(){
		$("#addtocart-qty").val() = "1";
	}

	function updateCartCounter()
	{ 
	    $( "#cart-item-counter" ).load(window.location.href + " #cart-item-counter" );
	    $( "#hiddencartcounter" ).load(window.location.href + " #hiddencartcounter" );
	}
    </script>