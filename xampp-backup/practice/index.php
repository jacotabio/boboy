<?php
  $conn = mysqli_connect('localhost','root', '');

  //Check Connection
  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }

  //Create Database
  if(isset($_POST['new_db'])) {
    $db_name = $_POST['new_db'];
    $sql = 'CREATE DATABASE IF NOT EXISTS ' . $_POST['new_db'];
    if(mysqli_query($conn, $sql)) {
      echo "Database created successfully";
    }
    else if(empty($db_name)){
      echo "Database field empty";
    }
    else{
      echo "Error creating database: " . mysqli_error($conn);
    }
  }

  /* SQL Guide

	CREATE TABLE IF NOT EXISTS `tbl_access` (
  `acc_id` int(3) NOT NULL AUTO_INCREMENT,
  `acc_name` varchar(80) NOT NULL,
  PRIMARY KEY (`acc_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=206 ;

	*/

  //Create New Table
  if(isset($_POST['new_table']))  {
    $table_name = $_POST['new_table'];
    $sql = 'CREATE TABLE IF NOT EXISTS `' . $_POST['new_table'] . '` (';

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
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Practice</title>
</head>
<body>
  <form action="" method="POST">
    CREATE DATABASE: <input type="text" name="new_db" placeholder="Database Name">
    <input type="submit" value="create"></br></br>

    CREATE NEW TABLE: <input type="text" name="new_table" placeholder="Table Name"/>
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
  </form>
</body>
</html>
