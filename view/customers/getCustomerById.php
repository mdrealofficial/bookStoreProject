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

if(isset($_GET['customer_id'])){
    $customer_id = $_GET['customer_id'];
    $customer = $customersObj->getCustomerById($customer_id);

    if($customer){
        echo json_encode($customer);
    } else {
        echo json_encode(["message" => "Customer not found"]);
    }
} else {
    echo json_encode(["message" => "Customer ID is required"]);
}
