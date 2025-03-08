<?php
require_once '../../config/dbConfig.php';
require_once '../../classes/orders.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();

$ordersObj = new Orders($databaseConnection);
$ordersData = $ordersObj->getOrders();

if (!empty($ordersData)) {
    echo json_encode($ordersData);
} else {
    echo json_encode(["message" => "No orders found"]);
}
?>
