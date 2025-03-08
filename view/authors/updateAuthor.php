<?php
require_once '../../config/dbConfig.php';
require_once '../../classes/authors.php';

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();

$authorsObj = new Authors($databaseConnection);

if(isset($_POST['author_id'], $_POST['name'], $_POST['email'])){
    $author_id = $_POST['author_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $updateResult = $authorsObj->updateAuthor($author_id, $name, $email);

    if($updateResult){
        echo json_encode(["message" => "Author updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update author"]);
    }
} else {
    echo json_encode(["message" => "All fields are required"]);
}
