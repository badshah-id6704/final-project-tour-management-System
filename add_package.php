<?php
session_start();
include '../db/config.php';

// Admin authentication check
if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php");
  exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Upload photo
  $photo = $_FILES['photo']['name'];
  $photo_tmp = $_FILES['photo']['tmp_name'];
  $photo_path = "../uploads/" . basename($photo);

  if (move_uploaded_file($photo_tmp, $photo_path)) {
    // Save to DB
    $query = "INSERT INTO tours (title, description, price, photo) 
              VALUES ('$title', '$description', '$price', '$photo')";
    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Tour added successfully!'); window.location='manage_tours.php';</script>";
    } else {
      echo "<script>alert('Database error!');</script>";
    }
  } else {
    echo "<script>alert('Failed to upload image.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Tour Package</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f7fa;
      margin: 0;
      padding: 0;
    }

    .form-container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input, textarea {
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      resize: none;
    }

    button {
      padding: 12px;
      background: #27ae60;
      color: white;
      font-weight: bold;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    button:hover {
      background: #2ecc71;
    }

    .back-button {
      text-align: center;
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

  <div class="form-container">
    <h2>Add New Tour Package</h2>

    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="title" placeholder="Tour Title" required>
      <textarea name="description" rows="5" placeholder="Tour Description" required></textarea>
      <input type="number" name="price" placeholder="Price (in ₹)" required>
      <input type="file" name="photo" accept="image/*" required>

      <button type="submit">Add Tour</button>
    </form>

    <div class="back-button">
      <button onclick="history.back()">← Back</button>
    </div>
  </div>

</body>
</html>
