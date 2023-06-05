<?php
// Establish database connection and retrieve transactions
$host = 'localhost';
$dbUsername = 'your_username';
$dbPassword = 'your_password';
$dbName = 'your_database';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM transactions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>$" . $row['amount'] . "</td>";
        echo "<td><a href='edit_transaction.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_transaction.php?id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No transactions found</td></tr>";
}

$conn->close();
?>
