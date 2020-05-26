<?php
require_once 'db_functions.php';
$db = new DB_Functions();

$menu = $db->getMenu();
if ($menu) {
    echo json_encode($menu);
} else {
    echo json_encode("Error !");
}


?>
