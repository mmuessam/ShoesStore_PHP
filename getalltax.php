<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

	$tax = $db->getTax();
	echo json_encode($tax);
?>
