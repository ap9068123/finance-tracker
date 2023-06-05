                    <?php
                   
                    $host = 'localhost';
                    $dbUsername = 'root';
                    $dbPassword = '';
                    $dbName = 'coinbase';


                    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT SUM(amount) AS balance FROM transactions";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $balance = $row['balance'] ?? 0;

                    echo "$" . $balance;

                    $conn->close();
                    ?>