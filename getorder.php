<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

	if(isset($_POST['userPhone'])){
		$userPhone = $_POST['userPhone'];
	
		$orders = $db->getOrderByUserPhone($userPhone);
		
		echo json_encode($orders);
	}else{
		$response = "Required parameter (userPhone) is missing!";
		echo json_encode($response);
	}

?>
