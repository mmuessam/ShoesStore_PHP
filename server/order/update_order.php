<?php

require_once '../../db_functions.php';
$db = new DB_Functions();

if(isset($_POST['orderId']) && isset($_POST['orderstatus'])){
    $orderId =  $_POST['orderId'];
    $orderstatus = $_POST['orderstatus'];

    $result = false;
    $result = $db->updateOrders($orderId,$orderstatus);
    if($result)
        echo json_encode("DONE");
    else
        echo json_encode("Error");
}
else{
    echo(json_encode("Required parameters (orderId,orderstatus) is missing!"));
}


?>