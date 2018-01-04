<?php 
$id = $_GET['id'];
$list = $food->get_profile($id);

foreach($list as $value);
if($id){
?>
<h2>Food Name: <?php echo $value['pro_name'];?></h2>
<h4>Description</h4>
<p><?php echo $value['pro_desc'];?></p>
<h4>Recipe</h4>
<table width="100%">
  <tr style="background: #575757; color: white; font-size: 16px;">
    <th style="text-align: left; padding: 10px;" width="70%">Ingredient</th>
    <th style="padding: 10px;">Qty</th>

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
    <td style="text-align: center; font-weight: bold; color: red;"><a href="#" onclick="deleteIng(<?php echo $ar['rec_id'];?>)" style="text-decoration: none;">Delete</a></td>
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
</table>
<h4>Add Ingredient</h4>
<form method="POST" action="food/process.php?action=assign&id=<?php echo $id;?>">
<label>Ingredient Name</label>
<div class="col30">

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
</div>
<label>Qty</label>
<div class="col30">

  <input name="qty" class="input-text" type="number" step="0.01" placeholder="Qty" value="1.00" />
</div>
<div class="col30">
  <input type="submit" class="input-button" value="Add"/>
</div>
</form>
<?php
}
?>
<script>
function deleteIng(asd){
  var recid = asd;
  window.location.assign("food/process.php?action=delete&id=<?php echo $id;?>&recid=" +recid);
}
</script>