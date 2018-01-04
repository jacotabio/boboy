<h2>About</h2>
<?php
$list = $settings->get_settings();
if($list){
	foreach($list as $values);
	?>
	
	<h4>Company Name: </h4><?php echo $values['set_name'];?>
	<h4>Address: </h4><?php echo $values['set_address'];?>
	<h4>Version: </h4><?php echo $values['set_version'];?>
	<h4>Copyright: </h4><?php echo $values['set_copyright'];

}else{
	echo "No System Details";
}

