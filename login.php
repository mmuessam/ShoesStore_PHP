<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

/*
* Endpoint : http://<domain>/drinkshop/login.php
.php
* Method : POST
* Params : phone
* Result : JSON
*/

	$response = array();
	if(isset($_POST['phone'], $_POST['password'])){
		$phone = $_POST['phone'];
        $password = $_POST['password'];
		if($db->checkExistsUserforLogin($phone, $password )){
			$response["exists"] = TRUE;
			echo json_encode($response);
		}else{
			$response["exists"] = FALSE;
			echo json_encode($response);
		}
	}else{
		$response["error_msg"] = "Required parameter (phone) is missing!";
		echo json_encode($response);
	}

?>