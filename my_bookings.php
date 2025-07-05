<?php
session_start();
include 'db/config.php';

// ✅ Step 1: Check if user is logged in
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

// ✅ Step 2: Get user email from session
// Use this if you stored user like ['email' => ..., 'name' => ...]
$user_email = is_array($_SESSION['user']) ? $_SESSION['user']['email'] : $_SESSION['user'];

// ✅ Step 3: Prepare query
$query = "SELECT * FROM bookings WHERE email = '$user_email' ORDER BY travel_date DESC";

// ✅ Step 4: Execute query
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Bookings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f7fa;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    .booking-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
      padding: 20px;
      position: relative;
    }

    .card h3 {
      margin: 0 0 10px;
      color: #2980b9;
    }

    .card p {
      margin: 4px 0;
      color: #555;
    }

    .card .date {
      font-weight: bold;
      color: #27ae60;
    }

    .card img {
      max-width: 100%;
      max-height: 120px;
      object-fit: cover;
      margin-top: 10px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }

    .no-bookings {
      text-align: center;
      color: #999;
      margin-top: 50px;
    }

    .back-btn {
      text-align: center;
      margin-top: 30px;
    }

    .back-btn a {
      text-decoration: none;
      background: #34495e;
      color: white;
      padding: 10px 18px;
      border-radius: 6px;
      font-weight: bold;
    }

    .back-btn a:hover {
      background: #2c3e50;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>🧳 My Bookings</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
      <div class="booking-list">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="card">
            <h3><?= htmlspecialchars($row['tour_title']) ?></h3>
            <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
            <p class="date">📅 Travel Date: <?= htmlspecialchars($row['travel_date']) ?></p>

            <?php if (!empty($row['id_proof']) && file_exists("uploads/" . $row['id_proof'])): ?>
              <p><strong>ID Proof:</strong></p>
              <img src="uploads/<?= $row['id_proof'] ?>" alt="ID Proof">
            <?php else: ?>
              <p><em>No ID proof uploaded.</em></p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="no-bookings">
        <p>No bookings found. Go explore some tours!</p>
      </div>
    <?php endif; ?>

    <div class="back-btn">
      <a href="tours.php">← Back to Tours</a>
    </div>
  </div>

</body>
</html>
