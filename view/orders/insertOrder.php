<?php
require_once '../../config/dbConfig.php';
require_once '../../classes/orders.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// Handle preflight OPTIONS request for CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();
$ordersObj = new Orders($databaseConnection);

// Read JSON body
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);

// Check if JSON decoding was successful
if ($data === null) {
    echo json_encode(["message" => "Invalid JSON format"]);
    exit();
}

// Validate required fields
if (!isset($data['customer_id']) || !isset($data['order_details']) || !is_array($data['order_details'])) {
    echo json_encode(["message" => "Customer ID and order details are required"]);
    exit();
}

$customer_id = $data['customer_id'];
$order_details = $data['order_details'];

// Call the createOrder function
$orderInsertResult = $ordersObj->createOrder($customer_id, $order_details);

if ($orderInsertResult) {
    echo json_encode(["message" => "Order created successfully"]);
} else {
    echo json_encode(["message" => "Internal server error"]);
}

?>
