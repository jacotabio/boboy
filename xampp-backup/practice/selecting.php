<?php
$conn = mysqli_connect('localhost','root');

//Query to display all databases in your localhost
$res = mysqli_query($conn, "SHOW DATABASES");
?>

<h3>SELECT DATABASE:</h3>
<select onchange="top.location.href='?db=' + this.value">
	<?php
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<option value="' . $row['Database'] . '">' . $row['Database'] .'</option>';
	}
	?>
</select>
<hr>
<?php

//Show Tables On Selected Database
if(isset($_GET['db'])) {

	// list all tables
	$sql = "SHOW TABLES FROM " . $_GET['db'];
	$res = mysqli_query($conn, $sql);

	?>
	<h3>SELECT TABLE:</h3>
	<select onchange="top.location.href='?db=<?=$_GET['db']?>&table=' + this.value">
		<?php
		while ($row = mysqli_fetch_row($res)) {
			echo '<option value="' . $row[0] . '">' . $row[0] .'</option>';
		}
		?>
	</select>
<?php
}
?>
