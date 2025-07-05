<?php
include '../db/config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // First delete bookings related to the tour
    mysqli_query($conn, "DELETE FROM bookings WHERE tour_id = $id");

    // Then delete the tour
    $query = "DELETE FROM tours WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_tours.php");
        exit();
    } else {
        echo "Failed to delete tour: " . mysqli_error($conn);
    }
} else {
    header("Location: manage_tours.php");
    exit();
}
?>
