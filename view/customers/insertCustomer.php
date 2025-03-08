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

if(isset($_POST['name'], $_POST['email'], $_POST['phone'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $customerInsertResult = $customersObj->createCustomer($name, $email, $phone);

    if($customerInsertResult){
        echo json_encode(["message" => "Customer inserted successfully"]);
    } else {
        echo json_encode(["message" => "Internal server error"]);
    }
} else {
    echo json_encode(["message" => "All fields are required"]);
}
