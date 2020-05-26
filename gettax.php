<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

/*
getTaxByCountry
*/

	$response = array();
	if(isset($_POST['country'])){
		$country = $_POST['country'];
		$tax = $db->getTaxByCountry($country);
		
		echo json_encode($tax);
	}else{
		$response["error_msg"] = "Required parameter (country) is missing!";
		echo json_encode($response);
	}

?>
