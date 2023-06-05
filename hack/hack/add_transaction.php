<?php
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'coinbase';

session_start();
$email=$_SESSION['email'];

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$description = $_POST['description'];
$amount = $_POST['amount'];


$sql = "INSERT INTO transactions (email,description, amount) VALUES ('$email','$description', '$amount')";
if ($conn->query($sql) === TRUE) {
  
    header("Location: main.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
