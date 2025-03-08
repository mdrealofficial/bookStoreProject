<?php
require_once '../../config/dbConfig.php';
require_once '../../classes/reports.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();

$reportsObj = new Reports($databaseConnection);
$summaryReport = $reportsObj->getSummaryReport();

if (!empty($summaryReport)) {
    echo json_encode($summaryReport);
} else {
    echo json_encode(["message" => "No data available"]);
}
?>
