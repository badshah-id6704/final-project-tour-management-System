<?php
include '../db/config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Get tour details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tours WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $tour = mysqli_fetch_assoc($result);
} else {
    header("Location: manage_tours.php");
    exit();
}

// Update tour if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $update = "UPDATE tours SET title='$title', description='$description', price='$price' WHERE id=$id";
    if (mysqli_query($conn, $update)) {
        header("Location: manage_tours.php");
        exit();
    } else {
        $error = "Failed to update tour.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Tour</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../css/style.css" />
  <style>
    .form-container {
      max-width: 600px;
      margin: 60px auto;
      padding: 30px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
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

    input, textarea {
      padding: 10px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #27ae60;
      color: white;
      padding: 12px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2ecc71;
    }

    .back-button {
      margin-top: 20px;
      text-align: center;
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

    .error {
      color: red;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Edit Tour Package</h2>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="post">
      <input type="text" name="title" placeholder="Tour Title" value="<?= htmlspecialchars($tour['title']) ?>" required>
      <textarea name="description" rows="5" placeholder="Tour Description" required><?= htmlspecialchars($tour['description']) ?></textarea>
      <input type="number" name="price" placeholder="Price" value="<?= $tour['price'] ?>" required>

      <button type="submit">Update Tour</button>
    </form>

    <div class="back-button">
      <button onclick="history.back()">← Back</button>
    </div>
  </div>

</body>
</html>
