<?php

require_once '../../db_functions.php';
$db = new DB_Functions();

if(isset($_POST['size'])&& isset($_POST["productId"])){
    $size = $_POST['size'];
    $productId = $_POST['productId'];

    $result = $db->insertNewSize($size , $productId);
    if($result)
        echo json_encode("Add Size success !");
    else
        echo json_encode("Error while write to database");
}
else{
    echo(json_encode("Required parameters (name, imgPath) is missing!"));
}


?>