<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <style>
    body {
      background-color: #f9f9f9;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .profile-card {
      background-color: #ffffff;
      border-radius: 6px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 40px;
      text-align: center;
      max-width: 400px;
      width: 100%;
    }

    .profile-picture {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin-bottom: 30px;
      background-color: #e6e6e6;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 48px;
      color: #888888;
      margin: 0 auto 30px;
    }

    .profile-name {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .profile-info {
      margin-bottom: 30px;
    }

    .profile-info p {
      color: #888888;
      margin-bottom: 10px;
    }

    .edit-profile-button {
      background-color:  rgb(115, 35, 219);
      color: #ffffff;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .edit-profile-button:hover {
      background-color:  rgb(115, 35, 219);
    }
  </style>
</head>
<body>
  <div class="profile-card">
    <div class="profile-picture">
      <span>&#128100;</span>
    </div>

   
    <div class="profile-info">
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

                    $sql = "SELECT * FROM users where email='$email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            
                           echo "<h2>Name :".$row['name']."</h2>";
                           echo "<h2>E-mail : ".$row['email']."</h2>";
                           
                          
                        }
                    } else {
                        echo "<tr><td colspan='3'>No transactions found</td></tr>";
                    }

                    $conn->close();
                    ?>

    
 
    </div>
    <button class="edit-profile-button">Edit Profile</button>
  </div>
</body>
</html>
