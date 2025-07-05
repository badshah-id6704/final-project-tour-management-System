<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .dashboard {
      max-width: 600px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 12px;
      text-align: center;
    }
    .dashboard h2 {
      color: #2c3e50;
    }
    .dashboard a {
      display: block;
      margin: 15px 0;
      background: #2980b9;
      color: white;
      padding: 12px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }
    .dashboard a:hover {
      background: #3498db;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <h2>Welcome, Admin!</h2>
    <a href="add_package.php">➕ Add New Tour Package</a>
    <a href="view_bookings.php">📋 View All Bookings</a>
    <a href="manage_tours.php" class="dashboard-button">🛠️ Manage Tours</a>
    <a href="logout.php">🚪 Logout</a>
  </div>
</body>
</html>
