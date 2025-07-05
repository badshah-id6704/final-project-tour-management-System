<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

$tour_title = isset($_GET['title']) ? $_GET['title'] : 'Unknown Tour';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Tour - <?= htmlspecialchars($tour_title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f0f4f7;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #2c3e50;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-weight: bold;
      color: #333;
    }

    input, textarea, select {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      width: 100%;
    }

    button {
      padding: 12px;
      background-color: #27ae60;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #2ecc71;
    }

    .back-btn {
      margin-top: 20px;
      text-align: center;
    }

    .back-btn a {
      text-decoration: none;
      background: #34495e;
      padding: 10px 15px;
      color: white;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .back-btn a:hover {
      background: #2c3e50;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Book Tour: <?= htmlspecialchars($tour_title) ?></h2>
    <form method="POST" action="save_booking.php" enctype="multipart/form-data">
      <input type="hidden" name="title" value="<?= htmlspecialchars($tour_title) ?>">

      <label>Your Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Phone:</label>
      <input type="text" name="phone" required>

      <label>Preferred Travel Date:</label>
      <input type="date" name="date" required>

      <label>Upload ID Proof (Optional):</label>
      <input type="file" name="photo" accept="image/*">

      <button type="submit">Confirm Booking</button>
    </form>

    <div class="back-btn">
      <a href="tours.php">← Back to Tours</a>
    </div>
  </div>

</body>
</html>
