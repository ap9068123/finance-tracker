<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'coinbase';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$newDescription = $_POST['desc'];
$newAmount = $_POST['amt'];

  
    $updateSql = "UPDATE transactions SET amount = '$newAmount' WHERE description = '$newDescription'";
    if ($conn->query($updateSql)) {
        echo"Updated successfully ";
        header("Location: main.php");
        exit();
    } else {
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }


$conn->close();
?>
