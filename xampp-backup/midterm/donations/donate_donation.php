<h2>Make a Donation</h2>
<form name="form1" method="post" action="donations/process.php?action=newdonation">
    <div class="col30">
        <label>Event</label></br>
        <input type="text" class="input-text" name="title" autocomplete="off" required placeholder="Event"/>
    </div>
    <div class="col30">
    <label>Description</label></br>
        <input type="text" class="input-text" name="description" autocomplete="off" placeholder="Description (optional)"/>
    </div>
    <div class="col30">
    <label>Donor</label></br>
		<select name="sponsorid" class="input-text" required>
			<?php
			$list = $donations->get_sponsors();

			foreach($list as $value){
			?>
				<option value="<?php echo $value['sponsor_userid'];?>">
				<?php echo $value['sponsor_lastname'];?>, <?php echo $value['sponsor_firstname'];?>
				</option>
			<?php
			}
			?>
		</select>
	</div>
	<div class="col30">
	<label>Donation Type</label></br>
		<select name="dtype" class="input-text" onchange="donationType(this.value)" required>
			<option value="">---</option>
		<?php
		$list = $donations->get_dtype();

		foreach($list as $value){
		?>
			<option value="<?php echo $value['dtype_id'];?>"><?php echo $value['dtype_name'];?></option>
		<?php
		}
		?>
		</select>
	</div>
	<div id="textboxItem" class="col30">
	<label>Donation</label></br>
		<input type="text" id="input-textboxItem" class="input-button" name="itemname" autocomplete="off" placeholder="Item Name" value="">
		<input type="number" min="1" value="1" maxlength="1" class="input-button" name="itemqty" onkeypress="return isNumberKey(event)" required placeholder="Qty" style="width: 5%;">
	</div>
	<div id="textboxAmount" class="col30">
	<label>Donation</label></br>
		<input type="number" id="input-textboxAmount" min="1" step="0.01" class="input-button" name="amount" value="" onkeypress="return isNumberKey(event)" placeholder="Amount">
	</div>
    <div class="col30">
        <input type="submit" class="input-button" name="submit" value="Donate"/>
    </div>
</form>


