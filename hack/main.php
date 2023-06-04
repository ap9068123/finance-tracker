<!DOCTYPE html>
<html>
<head>
    <title>Finance Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<header>
    <div class="logo">CoinCount</div>
    <nav>
      <ul class="nav-links">
      <li><a href="profile.php">Profile</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#testimonials">Testimonials</a></li>
        <li><a href="#faq">FAQ</a></li>
        <li>  <a href="logout.html">
          <span class="glyphicon glyphicon-log-out"></span>
        </a></li>
      </ul>
    </nav>
  </header>
  <br><br>
    <div class="container">
       
      <div class="transactions">
            <table >
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                   session_start();
                   $email=$_SESSION['email'];

                    $host = 'localhost';
                    $dbUsername = 'root';
                    $dbPassword = '';
                    $dbName = 'coinbase';

                    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM transactions where email='$email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>$" . $row['amount'] . "</td>";
                            echo "<td><a href='update_amount.html?id=" . $row['id'] . "'><button class='c1'>Edit</button></a> <a href='delete_transaction.php?id=" . $row['id'] . "'><button class='c2'>Delete</button></a></td>";
                           
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No transactions found</td></tr>";
                    }

                    $conn->close();
                    ?>


                    
                </tbody>
            </table>

                </div>
            <div class="add-transaction">
                <h2>Add Transaction</h2>
                <br>
                <form id="transaction-form" action="add_transaction.php" method="POST">
                  
                    <input type="text" name="description" placeholder="Description" required><br><br>
                    <input type="number" name="amount" placeholder="Amount" step="0.01" required><br><br>
                    <input type="submit" value="Add">
                </form>
                <br>
            </div>
        
        <div class="total">
            
         
                <h2 class="p">Total Expense: </h2>
                <!-- <span> -->
                    
                    <?php
                   
                     $email=$_SESSION['email'];
                    $host = 'localhost';
                    $dbUsername = 'root';
                    $dbPassword = '';
                    $dbName = 'coinbase';
                    


                    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT SUM(amount) AS balance FROM transactions where email='$email'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $balance = $row['balance'] ?? 0;

                    echo '<h2 class="p">' . '$' . $balance.'</h2><br>';

                    $conn->close();
                    ?>
                    

    
           
           
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h2 class="p">Current Balance: </h2>
                <h2 class="p"><?php include 'get_total_expense.php'; ?></h2>
          
        </div>
    </div>
</body>
</html>
