<h2>Add Product</h2>
<form class="top3" name="form1" method="post" action="dashboard/process.php?action=addproduct">
	<h4>Product Details</h4>
	<div class="col30">
        <input type="text" class="input-text" name="form_pname" required placeholder="Product Name" autocomplete="off" />
    </div>
    <div class="col30">
        <input type="text" class="input-text" name="form_pdesc" required placeholder="Description" autocomplete="off" />
    </div>
    <div class="col10">
        <input type="number" min="1" class="input-text" name="form_pquantity" required placeholder="Quantity"/>
    </div>
    <div class="col10">
        <input type="number" step="0.01" min="1" class="input-text" name="form_pprice" required placeholder="Price"/>
    </div>
    <div class="col30">
    	<input type="submit" class="input-button" name="submit" value="Save">
    </div>
</form>