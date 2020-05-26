<?php 

require_once '../../db_functions.php';
$db = new DB_Functions();

if(isset($_POST['id'])){
	$id =  $_POST['id'];

	$result = $db->deleteBanner($id);
	if($result)
		echo json_encode("delete Banner success !");
	else
		echo json_encode("Error while update data");
}
else{
	echo(json_encode("Required parameters (id) is missing!"));
}


 ?>