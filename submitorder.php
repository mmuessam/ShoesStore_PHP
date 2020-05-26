<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();

	$response = array();
	if(isset($_POST['orderDetail'])
		&& isset($_POST['orderphone'])
		&& isset($_POST['userphone'])
		&& isset($_POST['address'])
		&& isset($_POST['comment'])
		&& isset($_POST['price'])){
		
		$orderphone = $_POST['orderphone'];
		$userphone = $_POST['userphone'];
		$orderdetail = $_POST['orderDetail'];
		$price = $_POST['price'];
		$comment = $_POST['comment'];
		$address = $_POST['address'];

		$result = $db->insertNewOrder($price, $orderdetail, $comment, $address,$orderphone , $userphone);
		if($result){
			echo json_encode("true");
		}			
		else{
			echo json_encode($result);	 
		}
	}else{
		echo json_encode("Required parameter (price,comment,address,detail,phone) is missing!");
	}

?>
