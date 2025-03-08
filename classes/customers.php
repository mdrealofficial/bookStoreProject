<?php

class Customers {
    private $dbConn;
    private $table_name = "customers";

    public function __construct($databaseConnection) {
        $this->dbConn = $databaseConnection;
    }

    // Fetch all customers
    public function getCustomers() {
        $selectSQL = "SELECT * FROM " . $this->table_name;
        $stmt = $this->dbConn->prepare($selectSQL);

        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    // Fetch a single customer by ID
    public function getCustomerById($customer_id){
        $selectSQL = "SELECT * FROM " . $this->table_name . " WHERE customer_id = ?";
        $stmt = $this->dbConn->prepare($selectSQL);

        if($stmt){
            $stmt->bind_param("i", $customer_id);
            if($stmt->execute()){
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            }
        }
        return false;
    }

    // Insert a new customer
    public function createCustomer($name, $email, $phone){
        $insertSQL = "INSERT INTO " .$this->table_name . " (`name`, `email`, `phone`) VALUES (?,?,?)";
        $stmt = $this->dbConn->prepare($insertSQL);

        if($stmt){
            $stmt->bind_param("sss", $name, $email, $phone);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    // Update an existing customer
    public function updateCustomer($customer_id, $name, $email, $phone){
        $updateSQL = "UPDATE " . $this->table_name . " SET name = ?, email = ?, phone = ? WHERE customer_id = ?";
        $stmt = $this->dbConn->prepare($updateSQL);

        if($stmt){
            $stmt->bind_param("sssi", $name, $email, $phone, $customer_id);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    // Delete a customer by ID
    public function deleteCustomer($customer_id){
        $deleteSQL = "DELETE FROM " . $this->table_name . " WHERE customer_id = ?";
        $stmt = $this->dbConn->prepare($deleteSQL);

        if($stmt){
            $stmt->bind_param("i", $customer_id);
            return $stmt->execute();
        } else {
            return false;
        }
    }
}
