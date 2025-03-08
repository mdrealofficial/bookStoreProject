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

if(isset($_GET['author_id'])){
    $author_id = $_GET['author_id'];
    $author = $authorsObj->getAuthorById($author_id);

    if($author){
        echo json_encode($author);
    } else {
        echo json_encode(["message" => "Author not found"]);
    }
} else {
    echo json_encode(["message" => "Author ID is required"]);
}
