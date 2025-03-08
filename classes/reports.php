<?php

class Reports {
    private $dbConn;

    public function __construct($databaseConnection) {
        $this->dbConn = $databaseConnection;
    }

    // Get summary report data
    public function getSummaryReport() {
        $report = [];

        // Total Books
        $query = "SELECT COUNT(*) as total_books FROM books";
        $stmt = $this->dbConn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $report['total_books'] = $result['total_books'];

        // Total Customers
        $query = "SELECT COUNT(*) as total_customers FROM customers";
        $stmt = $this->dbConn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $report['total_customers'] = $result['total_customers'];

        // Total Orders & Total Order Value
        $query = "SELECT COUNT(*) as total_orders, COALESCE(SUM(total_amount), 0) as total_order_value FROM orders";
        $stmt = $this->dbConn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $report['total_orders'] = $result['total_orders'];
        $report['total_order_value'] = $result['total_order_value'];

        // Today's Orders & Today's Order Value
        $query = "SELECT COUNT(*) as todays_orders, COALESCE(SUM(total_amount), 0) as todays_order_value 
                  FROM orders WHERE DATE(order_date) = CURDATE()";
        $stmt = $this->dbConn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $report['todays_orders'] = $result['todays_orders'];
        $report['todays_order_value'] = $result['todays_order_value'];

        // Monthly Orders & Monthly Order Value
        $query = "SELECT COUNT(*) as monthly_orders, COALESCE(SUM(total_amount), 0) as monthly_order_value 
                  FROM orders WHERE MONTH(order_date) = MONTH(CURDATE()) AND YEAR(order_date) = YEAR(CURDATE())";
        $stmt = $this->dbConn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $report['monthly_orders'] = $result['monthly_orders'];
        $report['monthly_order_value'] = $result['monthly_order_value'];

        return $report;
    }
}
