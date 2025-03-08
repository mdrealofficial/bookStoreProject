<?php
require_once '../../config/dbConfig.php';
require_once '../../classes/customers.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();

$customersObj = new Customers($databaseConnection);

if(isset($_POST['customer_id'])){
    $customer_id = $_POST['customer_id'];
    $deleteResult = $customersObj->deleteCustomer($customer_id);

    if($deleteResult){
        echo json_encode(["message" => "Customer deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete customer"]);
    }
} else {
    echo json_encode(["message" => "Customer ID is required"]);
}
