<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

/*
* Endpoint : http://<domain>/drinkshop/register.php
* Method : POST
* Params : phone, name, birthdate,address
* Result : JSON
*/

	$response = array();
	if(isset($_POST['phone'])
		&& isset($_POST['name'])
		&& isset($_POST['address'])){
		
		$phone = $_POST['phone'];
		$name = $_POST['name'];
		$address = $_POST['address'];
	

		if($db->checkExistsUser($phone)){
			$response["error_msg"] = "User already existed with ".$phone;
			echo json_encode($response);
		}else{
			//create new user
			$user = $db->registerNewUser($phone, $name, $address);
			if($user){
				$response["phone"] = $user["Phone"];
				$response["name"] = $user["Name"];
				$response["address"] = $user["Address"];
				echo json_encode($response);
			}
			else{
				$response["error_msg"] = "Unknown error occurred in registration!";
				echo json_encode($response);	
			}
		}
	}else{
		$response["error_msg"] = "Required parameter (phone, name, address) is missing!";
		echo json_encode($response);
	}

?>
