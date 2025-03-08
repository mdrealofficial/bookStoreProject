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

if(isset($_POST['customer_id'], $_POST['name'], $_POST['email'], $_POST['phone'])){
    $customer_id = $_POST['customer_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $updateResult = $customersObj->updateCustomer($customer_id, $name, $email, $phone);

    if($updateResult){
        echo json_encode(["message" => "Customer updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update customer"]);
    }
} else {
    echo json_encode(["message" => "All fields are required"]);
}
