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
$booksData = $booksObj->getBooks();

if(!empty($booksData)){
    echo json_encode($booksData);
} else {
    echo json_encode(["message" => "No books found"]);
}
