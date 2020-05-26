<?php 
	require_once 'db_functions.php';
	$db = new DB_Functions();
	$response = array();
	if(isset($_POST['id'])){
		
		$id = $_POST['id'];
		
		$product = $db->getproductInfbyId($id);
		if($product){
			$response["iD"] = $product["ID"];
			$response["name"] = $product["Name"];
			$response["link"] = $product["Link"];
            $response["price"] = $product["Price"];
            $response["priceDes"] = $product["PriceDes"];
            $response["description"] = $product["Description"];
            $response["details"] = $product["Details"];


			echo json_encode($response);
		}
		else{
			$response["error_msg"] = "Product does not exists";
			echo json_encode($response);	
		}
	}else{
		$response["error_msg"] = "Required parameter (id) is missing!";
		echo json_encode($response);
	}

?>
