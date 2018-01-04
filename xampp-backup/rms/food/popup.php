<?php
$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

$id = $_GET['id'];
$list = $food->get_profile($id);
foreach($list as $value);
if($id){
?>
	<div id="popup" class="w3-modal" style="display: block;">
		<div class="w3-modal-content">
			<div class="w3-container">
   				<a href="#"><span onclick="document.getElementById('popup').style.display='none'" class="w3-closebtn">&times;</span></a>
		        <h2><?php echo $value['pro_name'];?></h2>
		        <h4>Description</h4>
		        <p><?php echo $value['pro_desc'];?></p>
		        <h4>Recipe</h4>
		        <table border="1" style="border-collapse: collapse;" width="100%">
		        	<tr>
		        		<th width="60%">Ingredient Name</th>
		        		<th>Qty</th>
		        		<th width="25%">Options</th>
		        	</tr>
		        	<?php
		        	$ing_array = $inventory->get_recipe($id);
		        	if($ing_array){
		        	foreach($ing_array as $ar){
		        		$u = $inventory->get_unit_details($ar['unt_id']);
		        		foreach($u as $_u);
		        	?>
		        	<tr>
		        		<td><?php echo $ar['ing_name'];?> (<?php echo $_u['unt_symbol'];?>)</td>
		        		<td style="text-align: right;"><?php echo $ar['rec_qty'];?></td>
		        		<td style="text-align: center; font-weight: bold; color: red;"><a href="#" onclick="deleteIng(<?php echo $ar['rec_id'];?>)" style="text-decoration: none;">&times;</a></td>
		        	</tr>
		        	<?php
		        		}
		        	}else{?>
		        	<tr>
		        		<td colspan="3" style="text-align: center; color: red; font-weight: bold;font-style: italic;">No Ingredients</td>
		        	</tr>
		        	<?php
		        	}
		        	?>
		        	<tr>
		        		<form method="POST" action="food/process.php?action=assign&id=<?php echo $id;?>">
		        		<td>
		        			<select name="ing" class="input-text">
		        			<?php
		        			$ing = $inventory->get_ingredients();
		        			foreach($ing as $i){
		        			?>
		        				<option value="<?php echo $i['ing_id'];?>"><?php echo $i['ing_name'];?> (<?php echo $inventory->get_unit_symbol($i['unt_id']);?>)</option>
		        			<?php
		        			}
		        			?>
		        			</select>
		        		</td>
		        		<td>
		        			<input name="qty" class="input-text" type="number" step="0.01" placeholder="Qty" value="1.00" />
		        		</td>
		        		<td>
		        			<input type="submit" value="Add to recipe"/>
		        		</td>
		        		</form>
		        	</tr>
		        </table>
			</div>
		</div>
	</div>
<?php
echo $id;
}
?>

<script>
function deleteIng(asd){
	var recid = asd;
	window.location.assign("food/process.php?action=delete&id=<?php echo $id;?>&recid=" +recid);
}

window.onclick = function(event) {
	var modal = document.getElementById('popup');
	if (event.target == modal) {
	    modal.style.display = "none";
	}
}
// Get the modal
function closePopup(){
	var modal = document.getElementById('popup');
    modal.style.display = "none";
}
</script>