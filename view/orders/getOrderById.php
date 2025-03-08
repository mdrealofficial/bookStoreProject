<?php
require_once '../../config/dbConfig.php';
require_once '../../classes/orders.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();

$ordersObj = new Orders($databaseConnection);

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order = $ordersObj->getOrderById($order_id);

    if ($order) {
        echo json_encode($order);
    } else {
        echo json_encode(["message" => "Order not found"]);
    }
} else {
    echo json_encode(["message" => "Order ID is required"]);
}


?>
