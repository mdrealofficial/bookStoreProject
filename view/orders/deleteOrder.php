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

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $deleteResult = $ordersObj->deleteOrder($order_id);

    if ($deleteResult) {
        echo json_encode(["message" => "Order deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete order"]);
    }
} else {
    echo json_encode(["message" => "Order ID is required"]);
}
?>
