<?php 
	require_once '../../db_functions.php';
	$db = new DB_Functions();

	$response = array();
	if(isset($_POST['city'])
		&& isset($_POST['price'])
		){
		
		$city = $_POST['city'];
		$price     = $_POST['price'];
		

		$result = $db->insertNewTax($city, $price);
		if($result){
			echo json_encode("true");
		}			
		else{
			echo json_encode($result);	 
		}
	}else{
		echo json_encode("Required parameter (price,city) is missing!");
	}

?>