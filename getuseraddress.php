<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

	$response = array();
	if(isset($_POST['userphone'])){
		$userphone = $_POST['userphone'];
		$address = $db->getUserAdressByPhone($userphone);
		
		echo json_encode($address);
	}else{
		$response["error_msg"] = "Required parameter (userphone) is missing!";
		echo json_encode($response);
	}

?>
