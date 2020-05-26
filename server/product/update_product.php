<?php 

require_once '../../db_functions.php';
$db = new DB_Functions();

if(isset($_POST['id']) &&
    isset($_POST['name']) &&
    isset($_POST['imgPath']) &&
    isset($_POST['price']) &&
    isset($_POST['priceDes']) &&
    isset($_POST['description']) &&
    isset($_POST['details']) &&
    isset($_POST['menuId'])){
	$id =  $_POST['id'];
    $name = $_POST['name'];
    $imgPath = $_POST['imgPath'];
    $price = $_POST['price'];
    $priceDes = $_POST['priceDes'];
    $description = $_POST['description'];
    $details = $_POST['details'];
    $menuId = $_POST['menuId'];

	$result = $db->updateProduct($id,$name,$imgPath,$price,$priceDes,$description,$details,$menuId);
	if($result)
		echo json_encode("update product success !");
	else
		echo json_encode("Error while update data");
}
else{
	echo(json_encode("Required parameters (id, name, imgPath,price,menuId) is missing!"));}
 ?>