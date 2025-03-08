<?php

class Books{
    private $dbConn;
    private $table_name = "books";

    public function __construct($databseConnection){
        $this->dbConn = $databseConnection;
    }


    public function getBooks(){
        $selectSQLNew = "SELECT * FROM ". $this->table_name;
        $stmt = $this->dbConn->prepare($selectSQLNew);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    // Fetch a single book by ID
    public function getBookById($book_id){
        $selectSQL = "SELECT * FROM " . $this->table_name . " WHERE book_id = ?";
        $stmt = $this->dbConn->prepare($selectSQL);

        if($stmt){
            $stmt->bind_param("i", $book_id);
            if($stmt->execute()){
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            }
        }
        return false;
    }

    public function createBook($title,$price,$stock,$author_id){
        $insertSQL = "INSERT INTO " .$this->table_name . " (`title`, `price`, `stock_quantity`, `author_id`) VALUES (?,?,?,?)";
        $stmt = $this->dbConn->prepare($insertSQL);
        
        if($stmt){
            $stmt->bind_param("sdii",$title,$price,$stock,$author_id);
            return $stmt->execute();
        }else{
            return false;
        }
        
    }

    // Update an existing book
    public function updateBook($book_id, $title, $price, $stock, $author_id){
        $updateSQL = "UPDATE " . $this->table_name . " SET title = ?, price = ?, stock_quantity = ?, author_id = ? WHERE book_id = ?";
        $stmt = $this->dbConn->prepare($updateSQL);

        if($stmt){
            $stmt->bind_param("sdiii", $title, $price, $stock, $author_id, $book_id);
            return $stmt->execute();
        }else{
            return false;
        }
    }

    // Delete a book by ID
    public function deleteBook($book_id){
        $deleteSQL = "DELETE FROM " . $this->table_name . " WHERE book_id = ?";
        $stmt = $this->dbConn->prepare($deleteSQL);

        if($stmt){
            $stmt->bind_param("i", $book_id);
            return $stmt->execute();
        }else{
            return false;
        }
    }


}