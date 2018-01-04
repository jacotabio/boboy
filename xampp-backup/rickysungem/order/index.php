<div style="padding-bottom: 10px;" class="center-div w-100">
	<div class="card-wrapper-leftright howtobutton w-100">
	<h3 style="color: #555; font-weight: 300; font-family: 'Roboto', sans-serif;">Steps</h3>
		<div class="card-style w-100">
			<div class="step-wrapper">
				<button id="btn_step1">Choose A Product</button>
				<div class="arrow-step1">&#10140;</div>
				<button id="btn_step2">Proceed To Checkout</button>
				<div class="arrow-step2">&#10140;</div>
				<button id="btn_step3">Delivery Process</button>
			</div>
		</div>
	</div>
	<div class="card-wrapper-leftright howtodesc w-100">
		<div class="card-style w-100">
			<div id="step_container"><div id="loading-image">Loading... Please wait</div></div>
		</div>
	</div>
</div>
<script>


$("#loading-image").bind('ajaxStart', function(){
	$(this).show();
}).bind('ajaxStop', function(){
	$(this).hide();
});


showContent();

$("#btn_step1").click(function(){
showContent();

});
$("#btn_step3").click(function(){
$.ajax({
	url: "order/ajax.php",
	type: "POST",
	async: false,
	data:{
		"step3": 1
	},
	success: function(data){
		$("#step_container").html(data);
		document.getElementById('btn_step3').style.color =  "white";
		document.getElementById('btn_step3').style.background = "#45ad5d";

		document.getElementById('btn_step2').style.color =  "#777";
		document.getElementById('btn_step2').style.background = "none";

		document.getElementById('btn_step1').style.color =  "#777";
		document.getElementById('btn_step1').style.background = "none";

	}
});
});
$("#btn_step2").click(function(){
$.ajax({
	url: "order/ajax.php",
	type: "POST",
	async: false,
	data:{
		"step2": 1
	},
	success: function(data){
		$("#step_container").html(data);
		document.getElementById('btn_step2').style.color =  "white";
		document.getElementById('btn_step2').style.background = "#45ad5d";

		document.getElementById('btn_step1').style.color =  "#777";
		document.getElementById('btn_step1').style.background = "none";

		document.getElementById('btn_step3').style.color =  "#777";
		document.getElementById('btn_step3').style.background = "none";
	}
});
});
function showContent(){
$.ajax({
	url: "order/ajax.php",
	type: "POST",
	async: false,
	data:{
		"step1": 1
	},
	success: function(data){
		$("#step_container").html(data);
		document.getElementById('btn_step1').style.color =  "white";
		document.getElementById('btn_step1').style.background = "#45ad5d";

		document.getElementById('btn_step2').style.color =  "#777";
		document.getElementById('btn_step2').style.background = "none";

		document.getElementById('btn_step3').style.color =  "#777";
		document.getElementById('btn_step3').style.background = "none";
	}
});
}
</script>