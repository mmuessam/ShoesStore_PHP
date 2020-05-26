<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

	$menu = $db->getDiscount();
	echo json_encode($menu);
?>
