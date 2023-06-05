<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'coinbase';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name= $_POST['name'];
$username = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name,email, password) VALUES ('$name','$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo'<script>alert("Signup successful.")</script>';
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//header("Location: index.html");
    exit();
$conn->close();
?>
