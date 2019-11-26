<?php
	include 'DB.class.php';
	$db = new DB;

	$id		 		= $_POST['id'];
	$sname		 	= $_POST['shipName'];
	$slastname  		= $_POST['shipLastname'];

	$data2 = array(
		'name' 		=> $sname,
		'lastname' 	=> $slastname
	);

	echo '<pre>'; print_r($data2); echo '</pre>';
	$db->insert('clients', $data2);

	header("location: checkout.php?id=".$id."");

?>