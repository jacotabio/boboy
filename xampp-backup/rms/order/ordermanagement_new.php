<h2>New Order Status</h2>
<form name="form1" method="POST" action="order/process.php?action=neworderstatus">
	<h4>Order Status Details</h4>
    <div class="col30">
        <input type="text" class="input-text" name="statusname" required placeholder="Status Name"/>
    </div>
	 <div class="col30">
        <input type="submit" class="input-button" name="submit" value="Save"/>
    </div>
</form>