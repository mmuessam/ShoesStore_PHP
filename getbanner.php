<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

/*
* Endpoint : http://<domain>/drinkshop/getdrink.php
* Method : POST
* Params : menuId
* Result : JSON
*/

	$response = array();
	if(isset($_POST['productid'])){
		$productid = $_POST['productid'];
		$drinks = $db->getBannerByProductID($productid);
		
		echo json_encode($drinks);
	}else{
		$response["error_msg"] = "Required parameter (productid) is missing!";
		echo json_encode($response);
	}

?>
