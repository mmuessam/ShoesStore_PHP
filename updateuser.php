<?php

   require_once 'db_functions.php';
   $db = new DB_Functions();

if(isset($_POST['phone']) && isset($_POST['name']) && isset($_POST['address'])){
    $phone =  $_POST['phone'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    $result = $db->updateUser($phone,$name,$address);
    if($result)
        echo json_encode("update User success !");
    else
        echo json_encode("Error while update data");
}
else{
    echo(json_encode("Required parameters (phone,name,address) is missing!"));
}


?>