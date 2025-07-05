<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .dashboard-container {
      max-width: 600px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 12px;
      text-align: center;
    }

    .dashboard-container h2 {
      color: #2c3e50;
    }

    .dashboard-container p {
      font-size: 16px;
      margin: 15px 0;
      color: #555;
    }

    .dashboard-container a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #2980b9;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 6px;
    }

    .dashboard-container a:hover {
      background-color: #3498db;
    }

    .back-button {
      margin-top: 20px;
    }

    .back-button button {
      padding: 10px 15px;
      background-color: #34495e;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .back-button button:hover {
      background-color: #2c3e50;
    }
  </style>
</head>
<body>

  <div class="dashboard-container">
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?> 👋</h2>
    <p>You are successfully logged in.</p>

    <a href="tours.php">Explore Tours</a><br>
    <a href="my_bookings.php">📄 My Bookings</a>

    <a href="logout.php" style="margin-top:10px; background:#c0392b;">Logout</a>

    <div class="back-button">
      <button onclick="history.back()">← Back</button>
    </div>
  </div>

</body>
</html>
