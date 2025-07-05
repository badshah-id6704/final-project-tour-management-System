<?php
include 'db/config.php';
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

// Handle form data
$name  = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date  = $_POST['date'];
$title = $_POST['title'];

// Handle optional photo upload
$photoName = '';
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $photoName = basename($_FILES['photo']['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $photoName;
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
}

// Insert booking into database
$query = "INSERT INTO bookings (name, email, phone, travel_date, tour_title, id_proof)
          VALUES ('$name', '$email', '$phone', '$date', '$title', '$photoName')";

if (mysqli_query($conn, $query)) {
  $success = true;
} else {
  $error = mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f4f7;
      margin: 0;
      padding: 0;
    }

    .confirmation-box {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .confirmation-box h2 {
      color: #27ae60;
    }

    .confirmation-box p {
      font-size: 16px;
      color: #333;
      margin: 10px 0;
    }

    .error {
      color: red;
      font-weight: bold;
    }

    .btn {
      display: inline-block;
      margin-top: 25px;
      padding: 10px 20px;
      background: #2980b9;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #1c5980;
    }
  </style>
</head>
<body>

  <div class="confirmation-box">
    <?php if (isset($success) && $success): ?>
      <h2>🎉 Booking Confirmed!</h2>
      <p>Thank you, <strong><?= htmlspecialchars($name) ?></strong>.</p>
      <p>Your booking for <strong><?= htmlspecialchars($title) ?></strong> on <strong><?= htmlspecialchars($date) ?></strong> has been received.</p>

      <?php if ($photoName): ?>
        <p>ID Proof Uploaded: <?= htmlspecialchars($photoName) ?></p>
      <?php endif; ?>

      <a href="my_bookings.php" class="btn">View My Bookings</a>
    <?php else: ?>
      <h2 class="error">❌ Booking Failed</h2>
      <p class="error">Error: <?= $error ?></p>
      <a href="tours.php" class="btn">← Back to Tours</a>
    <?php endif; ?>
  </div>

</body>
</html>
