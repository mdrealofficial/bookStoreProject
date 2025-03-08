<?php

class Orders {
    private $dbConn;
    private $table_orders = "orders";
    private $table_order_details = "order_details";

    public function __construct($databaseConnection) {
        $this->dbConn = $databaseConnection;
    }

    public function getOrders() {
        $orders = [];

        // Fetch all orders with customer info
        $orderSQL = "SELECT o.*, c.name as customer_name, c.email as customer_email
                 FROM " . $this->table_orders . " o
                 JOIN customers c ON o.customer_id = c.customer_id";
        $stmt = $this->dbConn->prepare($orderSQL);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($order = $result->fetch_assoc()) {
                // Fetch order details for this order
                $orderDetailsSQL = "SELECT od.*, b.title as book_title, b.price 
                                FROM " . $this->table_order_details . " od
                                JOIN books b ON od.book_id = b.book_id
                                WHERE od.order_id = ?";
                $stmtDetails = $this->dbConn->prepare($orderDetailsSQL);
                $stmtDetails->bind_param("i", $order['order_id']);
                $stmtDetails->execute();
                $detailsResult = $stmtDetails->get_result();
                $order["order_details"] = $detailsResult->fetch_all(MYSQLI_ASSOC);

                // Add the order to the list
                $orders[] = $order;
            }
            return $orders;
        } else {
            return false;
        }
    }


    // Fetch a single order with order details
    public function getOrderById($order_id) {
        // Fetch order details along with customer info
        $orderSQL = "SELECT o.*, c.name as customer_name, c.email as customer_email
                 FROM " . $this->table_orders . " o
                 JOIN customers c ON o.customer_id = c.customer_id
                 WHERE o.order_id = ?";
        $stmt = $this->dbConn->prepare($orderSQL);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $orderResult = $stmt->get_result();
        $order = $orderResult->fetch_assoc(); // Fetch single order

        if ($order) {
            // Fetch order items in a single query
            $orderDetailsSQL = "SELECT od.*, b.title as book_title, b.price 
                            FROM " . $this->table_order_details . " od
                            JOIN books b ON od.book_id = b.book_id
                            WHERE od.order_id = ?";
            $stmtDetails = $this->dbConn->prepare($orderDetailsSQL);
            $stmtDetails->bind_param("i", $order_id);
            $stmtDetails->execute();
            $detailsResult = $stmtDetails->get_result();
            $order["order_details"] = $detailsResult->fetch_all(MYSQLI_ASSOC); // Fetch all as an array

            return $order;
        }
        return false;
    }


    // Create a new order with details
    public function createOrder($customer_id, $orderDetails) {
        $this->dbConn->begin_transaction();
        try {
            // Insert order
            $insertOrderSQL = "INSERT INTO " . $this->table_orders . " (customer_id, total_amount) VALUES (?, 0)";
            $stmt = $this->dbConn->prepare($insertOrderSQL);
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $order_id = $stmt->insert_id;

            $totalAmount = 0;

            // Insert order details
            foreach ($orderDetails as $detail) {
                $book_id = $detail["book_id"];
                $quantity = $detail["quantity"];
                $line_total = $detail["line_total"];
                $totalAmount += $line_total;

                $insertDetailSQL = "INSERT INTO " . $this->table_order_details . " (order_id, book_id, quantity, line_total) VALUES (?, ?, ?, ?)";
                $stmt = $this->dbConn->prepare($insertDetailSQL);
                $stmt->bind_param("iiid", $order_id, $book_id, $quantity, $line_total);
                $stmt->execute();
            }

            // Update total amount in order
            $updateOrderSQL = "UPDATE " . $this->table_orders . " SET total_amount = ? WHERE order_id = ?";
            $stmt = $this->dbConn->prepare($updateOrderSQL);
            $stmt->bind_param("di", $totalAmount, $order_id);
            $stmt->execute();

            $this->dbConn->commit();
            return true;
        } catch (Exception $e) {
            $this->dbConn->rollback();
            return false;
        }
    }

    // Delete an order and related details
    public function deleteOrder($order_id) {
        $deleteSQL = "DELETE FROM " . $this->table_orders . " WHERE order_id = ?";
        $stmt = $this->dbConn->prepare($deleteSQL);
        $stmt->bind_param("i", $order_id);
        return $stmt->execute();
    }
}
