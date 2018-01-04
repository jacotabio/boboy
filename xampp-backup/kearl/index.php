<?php

$conn = mysqli_connect('localhost', 'root', '');

/************** CREATING NEW TABLE ***************/
if(isset($_POST['new_table'])) {
	$table_name = $_POST['new_table'];
	/* guide

	CREATE TABLE IF NOT EXISTS `tbl_access` (
  `acc_id` int(3) NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(80) NOT NULL,
  PRIMARY KEY (`acc_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=206 ;

	*/
	$sql = 'CREATE TABLE IF NOT EXISTS `' . $_POST['new_table'] .'`(';

	$i = 1;
	$pk = false;
	while(true) {
		if(isset($_POST['field' . $i .'_name'])) {
			$sql .= '`' . $_POST['field'.$i.'_name'] .'` '. $_POST['field'.$i.'_type'] . '(' . $_POST['field'.$i.'_limit'] . ') NULL ';
			if($_POST['field'.$i.'_ai'] == "true") {
				$sql .= " AUTO_INCREMENT,";
			} else {
				$sql .= ",";
			}
			if(isset($_POST['field' . $i .'_pk'])) {
				$pk = $i;
			}
			$i++;
		} else {
			break;
		}
	}

	$sql = substr($sql, 0, -1); // remove last comma

	if($pk != false) {
		$sql .= 'PRIMARY KEY(`' . $_POST['field' . $pk .'_name'] .'`)';
	}

	$sql .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8';


	echo $sql .'<br><br>';

}
/************** END OF CREATING TABLES *****************/




// list databases and autoselect
$res = mysqli_query($conn, "SHOW DATABASES");
?>
SELECT DATABASE:
<select onchange="top.location.href='?db=' + this.value">
	<?php
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<option value="' . $row['Database'] . '">' . $row['Database'] .'</option>';
	}
	?>
</select>
<hr>
<?php




// list tables and autoselect

if(isset($_GET['db'])) {

	// list all tables
	$sql = "SHOW TABLES FROM " . $_GET['db'];
	$res = mysqli_query($conn, $sql);

	?>
	SELECT TABLE:
	<select onchange="top.location.href='?db=<?=$_GET['db']?>&table=' + this.value">
		<?php
		while ($row = mysqli_fetch_row($res)) {
			echo '<option value="' . $row[0] . '">' . $row[0] .'</option>';
		}
		?>
	</select>
	<hr>

	<!--

			CREATING NEW TABLE WITH MULTIPLE FIELDS

			PHP PART AT THE TOP

	-->
	<form action="" method="POST">
		DATABASE: <b><?=$_GET['db']?></b><br>
		CREATE NEW TABLE: <input type="text" name="new_table" placeholder="Table Name"><br>
		<input type="hidden" name="db" value="<?=$_GET['db']?>">
		<br>

		<div id="new_table_fields">
			<input type="text" name="field1_name" placeholder="Field Name">
			<input type="text" name="field1_type" placeholder="Field Type">
			<input type="text" name="field1_limit" placeholder="Field Limit">
			<select name="field1_ai">
				<option value="true">Auto Increment</option>
				<option selected value="false">NOT Auto Increment</option>
			</select>
			Primary? <input type="checkbox" value="1" name="field1_pk">
			<hr>
		</div>
		<script>
			var new_table_fields_i = 1;
			function add_new_field() {

				new_table_fields_i ++;

				var txt = ''
				+ '<input type="text" name="field' + new_table_fields_i + '_name" placeholder="Field Name">'
				+ '<input type="text" name="field' + new_table_fields_i + '_type" placeholder="Field Type">'
				+ '<input type="text" name="field' + new_table_fields_i + '_limit" placeholder="Field Limit">'
				+ '<select name="field' + new_table_fields_i + '_ai">'
				+ '<option value="true">Auto Increment</option>'
				+ '<option selected value="false">NOT Auto Increment</option>'
				+ '</select>'
				+ 'Primary? <input type="checkbox" name="field' + new_table_fields_i + '_pk">'
				+ '<hr>';

				var a = document.createElement("div");
				a.innerHTML = txt;

				new_table_fields.appendChild(a);

			}
		</script>
		<button onclick="add_new_field(); return false;">Add New Field</button>
		<input type="submit" value="create">
	</form>


	<?php
}



if(isset($_GET['table'])) {

	// select database
	mysqli_select_db($conn, $_GET['db']);

	// do queries with the table

	// ,,,

}
