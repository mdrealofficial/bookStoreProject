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

if(isset($_POST['book_id'])){
    $book_id = $_POST['book_id'];
    $deleteResult = $booksObj->deleteBook($book_id);

    if($deleteResult){
        echo json_encode(["message" => "Book deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete book"]);
    }
} else {
    echo json_encode(["message" => "Book ID is required"]);
}
