<?php 

require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['firstname']) &&
  isset($_POST['lastname']) &&
  isset($_POST['city']) &&
  isset($_POST['governorate']) &&
  isset($_POST['country']) &&
  isset($_POST['phone']) &&
  isset($_POST['otherphone']) &&
  isset($_POST['userphone']) ){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$city = $_POST['city'];
    $governorate = $_POST['governorate'];
    $country = $_POST['country'];
	$phone = $_POST['phone'];
	$otherphone = $_POST['otherphone'];
	$userphone = $_POST['userphone'];

	$result = $db->insertNewAddress($firstname,$lastname,$city,$governorate,$country,$phone,$otherphone,$userphone);
	if($result)
		echo json_encode("Add product success !");
	else
		echo json_encode("Error while write to database");
}
else{
	echo(json_encode("Required parameters (firstname,lastname,city,governorate,country,phone,otherphone,userphone) is missing!"));
}


 ?>