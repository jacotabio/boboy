<h2>New Ingredient</h2>
<form method="POST" action="inventory/process.php?action=ing">
	<h4>Ingredient Details</h4>
	<div class="col30">
		<input type="text" class="input-text" autocomplete="off" name="ing_name" placeholder="Ingredient Name" />
	</div>
	<div class="col30">
		<input type="text" class="input-text" autocomplete="off" name="ing_qty" placeholder="Ingredient Qty" />
	</div>
	<div class="col30">
	<h4>Unit of Measurement</h4>
		<select class="input-text" name="ing_unit">
		<?php
		$list = $inventory->get_units();

		foreach($list as $value){
		?>
			<option value="<?php echo $value['unt_id'];?>"><?php echo $value['unt_name'];?></option>
		<?php
		}
		?>
		</select>
	</div>
	<div class="col30">
		<input type="submit" class="input-button" value="Save"/>
	</div> 
</form>