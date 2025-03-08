<?php
require_once '../../config/dbConfig.php';
require_once '../../classes/books.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();

$booksObj = new Books($databaseConnection);

if(isset($_POST['title'], $_POST['price'], $_POST['stock_qty'], $_POST['author_id'])){
    $title = $_POST['title'];
    $price = $_POST['price'];
    $stock = $_POST['stock_qty'];
    $author_id = $_POST['author_id'];

    $bookInsertResult = $booksObj->createBook($title, $price, $stock, $author_id);

    if($bookInsertResult){
        echo json_encode(["message" => "Book inserted successfully"]);
    } else {
        echo json_encode(["message" => "Internal server error"]);
    }
} else {
    echo json_encode(["message" => "All fields are required"]);
}
