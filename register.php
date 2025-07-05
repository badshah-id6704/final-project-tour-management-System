<?php
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Check if user already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered. Try logging in.";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $success = "Registration successful! You can now log in.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Registration</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .register-box {
      max-width: 450px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 12px;
      text-align: center;
    }

    .register-box h2 {
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .register-box input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .register-box button {
      width: 100%;
      background: #27ae60;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
    }

    .register-box button:hover {
      background: #2ecc71;
    }

    .error {
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .success {
      color: green;
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
  <div class="register-box">
    <h2>User Registration</h2>

    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <?php if (isset($success)) echo "<div class='success'>$success</div>"; ?>

    <form method="post">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Create Password" required>
      <button type="submit">Register</button>
    </form>

    <p style="margin-top: 15px;">Already have an account? <a href="login.php">Login here</a></p>

    <div class="back-button">
      <button onclick="history.back()">← Back</button>
    </div>
  </div>
</body>
</html>
