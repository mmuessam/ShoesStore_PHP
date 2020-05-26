<?php

require_once '../../db_functions.php';
$db = new DB_Functions();

if(isset($_POST['productID']) && isset($_POST['imgPath'])){
    $productID = $_POST['productID'];
    $imgPath = $_POST['imgPath'];

    $result = $db->insertNewBanner($productID,$imgPath);
    if($result)
        echo json_encode("Add Banner success !");
    else
        echo json_encode("Error while write to database");
}
else{
    echo(json_encode("Required parameters (id, imgPath) is missing!"));
}


?>