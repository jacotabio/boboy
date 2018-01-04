<h2>New Dish</h2>
<form name="form1" method="POST" action="food/process.php?action=newdish">
	<h4>Food Details</h4>
    <div class="col30">
        <input type="text" class="input-text" name="pname" required placeholder="Product Name"/>
    </div>
    <div class="col30">
        <input type="text" class="input-text" name="pdesc" required placeholder="Product Description"/>
    </div>
	<div class="col30">
		<select name="ptype" class="input-text" required>
			<?php
			$list = $food->get_ptype();

			foreach($list as $value){
			?>
				<option value="<?php echo $value['pty_id'];?>">
				<?php echo $value['pty_name'];?>
				</option>
			<?php
			}
			?>
		</select>
	 </div>
	 <div class="col30">
        <input type="number" step="0.01" min="1" class="input-text" name="pprice" required placeholder="Price"/>
    </div>
	 <div class="col30">
        <input type="submit" class="input-button" name="submit" value="Save"/>
    </div>
</form>