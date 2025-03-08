<?php

class Authors {
    private $dbConn;
    private $table_name = "authors";

    public function __construct($databaseConnection) {
        $this->dbConn = $databaseConnection;
    }

    // Fetch all authors
    public function getAuthors() {
        $selectSQL = "SELECT * FROM " . $this->table_name;
        $stmt = $this->dbConn->prepare($selectSQL);

        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    // Fetch a single author by ID
    public function getAuthorById($author_id){
        $selectSQL = "SELECT * FROM " . $this->table_name . " WHERE author_id = ?";
        $stmt = $this->dbConn->prepare($selectSQL);

        if($stmt){
            $stmt->bind_param("i", $author_id);
            if($stmt->execute()){
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            }
        }
        return false;
    }

    // Insert a new author
    public function createAuthor($name, $email){
        $insertSQL = "INSERT INTO " .$this->table_name . " (`name`, `email`) VALUES (?,?)";
        $stmt = $this->dbConn->prepare($insertSQL);

        if($stmt){
            $stmt->bind_param("ss", $name, $email);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    // Update an existing author
    public function updateAuthor($author_id, $name, $email){
        $updateSQL = "UPDATE " . $this->table_name . " SET name = ?, email = ? WHERE author_id = ?";
        $stmt = $this->dbConn->prepare($updateSQL);

        if($stmt){
            $stmt->bind_param("ssi", $name, $email, $author_id);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    // Delete an author by ID
    public function deleteAuthor($author_id){
        $deleteSQL = "DELETE FROM " . $this->table_name . " WHERE author_id = ?";
        $stmt = $this->dbConn->prepare($deleteSQL);

        if($stmt){
            $stmt->bind_param("i", $author_id);
            return $stmt->execute();
        } else {
            return false;
        }
    }
}
