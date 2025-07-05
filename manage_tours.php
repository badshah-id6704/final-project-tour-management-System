<?php
include '../db/config.php';
session_start();

// Admin session check
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM tours");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Tours</title>
  <link rel="stylesheet" href="../css/style.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f7fa;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #2980b9;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    a {
      text-decoration: none;
      color: #2980b9;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
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

  <div class="container">
    <h2>Manage Tour Packages</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price (₹)</th>
        <th>Actions</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= $row['price'] ?></td>
        <th>Photo</th>
...
<td>
  <?php if ($row['photo']): ?>
    <img src="../uploads/<?= $row['photo'] ?>" width="100">
  <?php else: ?>
    N/A
  <?php endif; ?>
</td>

        <td>
          <a href="edit_tour.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
          <a href="delete_tour.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this tour?');">🗑️ Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
    <?php else: ?>
      <p style="text-align: center; color: #777;">No tours found.</p>
    <?php endif; ?>

    <div class="back-button">
      <button onclick="history.back()">← Back</button>
    </div>
  </div>

</body>
</html>
