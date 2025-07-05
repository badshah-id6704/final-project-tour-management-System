<?php
include 'db/config.php';

$result = mysqli_query($conn, "SELECT title, description, price, photo FROM tours");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Tours</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .header {
      text-align: center;
      background: #2980b9;
      color: white;
      padding: 20px;
    }

    .tour-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      padding: 30px;
      max-width: 1200px;
      margin: auto;
    }

    .tour-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
    }

    .tour-card:hover {
      transform: translateY(-5px);
    }

    .tour-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .tour-card .content {
      padding: 15px;
    }

    .tour-card h3 {
      margin: 0 0 10px;
      color: #2c3e50;
    }

    .tour-card p {
      margin: 0;
      color: #555;
    }

    .price {
      margin-top: 10px;
      font-weight: bold;
      color: #27ae60;
    }

    .back-button {
      text-align: center;
      margin-bottom: 20px;
    }

    .back-button a {
      padding: 10px 15px;
      background: #34495e;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }

    .back-button a:hover {
      background: #2c3e50;
    }
    .book-btn {
  display: inline-block;
  margin-top: 10px;
  padding: 10px 15px;
  background-color: #e67e22;
  color: white;
  text-decoration: none;
  border-radius: 6px;
  font-weight: bold;
  transition: background 0.3s ease;
}

.book-btn:hover {
  background-color: #d35400;
}

  </style>
</head>
<body>

  <div class="header">
    <h1>Available Tour Packages</h1>
  </div>

<div class="tour-list">
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="tour-card">
      <?php if (!empty($row['photo']) && file_exists("uploads/" . $row['photo'])): ?>
        <img src="uploads/<?= $row['photo'] ?>" alt="<?= htmlspecialchars($row['title']) ?>">
      <?php else: ?>
        <img src="https://via.placeholder.com/300x180?text=No+Image" alt="No image">
      <?php endif; ?>
      <div class="content">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p><?= htmlspecialchars($row['description']) ?></p>
        <p class="price">₹<?= $row['price'] ?></p>

        <a href="book_tour.php?title=<?= urlencode($row['title']) ?>" class="book-btn">Book Now</a>
      </div>
    </div>
  <?php endwhile; ?>
</div>

   <div class="back-button">
    <a href="index.html">← Back to Home</a>
  </div>

</body>
</html>
