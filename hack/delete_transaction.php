<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'coinbase';
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_GET['id'];

$sql = "DELETE FROM transactions WHERE id = '$id'";
if ($conn->query($sql) === TRUE) {
    
    header("Location: main.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
