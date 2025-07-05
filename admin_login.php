<?php
session_start();
include '../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple check — replace with secure login in production
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .admin-login-container {
      max-width: 400px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 12px;
      text-align: center;
    }
    .admin-login-container h2 {
      margin-bottom: 20px;
      color: #2c3e50;
    }
    .error {
      color: red;
      margin-bottom: 10px;
      font-weight: bold;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      background-color: #2980b9;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      width: 100%;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #3498db;
    }
  </style>
</head>
<body>
  <div class="admin-login-container">
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Admin Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
