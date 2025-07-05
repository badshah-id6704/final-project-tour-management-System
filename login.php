<?php
session_start();
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Login</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .login-box {
      max-width: 400px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 12px;
      text-align: center;
    }

    .login-box h2 {
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .login-box input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .login-box button {
      width: 100%;
      background: #2980b9;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
    }

    .login-box button:hover {
      background: #3498db;
    }

    .error {
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
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
  <div class="login-box">
    <h2>User Login</h2>

    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <p style="margin-top: 15px;">Don't have an account? <a href="register.php">Register here</a></p>

    <div class="back-button">
      <button onclick="history.back()">← Back</button>
    </div>
  </div>
</body>
</html>
