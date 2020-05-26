<?php 
/*
* Endpoint : http://<domain>/drinkshop/getallproduct.php
* Method : POST
* Params : menuId
* Result : JSON
*/
	require_once 'db_functions.php';
	$db = new DB_Functions();

	$drinks = $db->getAllproduct();
	if($drinks){
		echo json_encode($drinks);
	}else{
		echo json_encode("Error !");
	}
	

 ?>