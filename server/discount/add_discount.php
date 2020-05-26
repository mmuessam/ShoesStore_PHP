<?php

require_once '../../db_functions.php';
$db = new DB_Functions();

if(isset($_POST['id']) && isset($_POST['discount'])){
    $id =  $_POST['id'];
    $discount = $_POST['discount'];

    $result = $db->insertDiscount($discount , $id);
    if($result)
        echo json_encode("Add discount success !");
    else
        echo json_encode("Error while write to database");
}
else{
    echo(json_encode("Required parameters ( discount , id ) is missing!"));
}


?>