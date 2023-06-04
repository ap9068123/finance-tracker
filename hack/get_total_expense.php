<?php
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'coinbase';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SUM(amount) AS total_expense FROM transactions WHERE amount < 0";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalExpense = $row['total_expense'] ?? 0;

echo "$" . $totalExpense;

$conn->close();
?>
