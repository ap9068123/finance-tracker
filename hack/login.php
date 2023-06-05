<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'coinbase';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['email'];
$password = $_POST['password'];


session_start();
$_SESSION['email']=$username;
$sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    header("Location: main.php");
    exit();
} else {
    echo'<script>alert("Invalid username or password.")</script>';
    
}
//header("Location: index.html");
$conn->close();
?>