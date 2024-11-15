<?php
// Include database configuration
require "./config.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION["akses"]) || $_SESSION["akses"] != true) {
    header("Location: ./index.php?error=Anda harus login terlebih dahulu");
    exit();
}

// Check if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data from POST request
    $nama = mysqli_real_escape_string($sambung, $_POST['nama']);
    $tugas1 = mysqli_real_escape_string($sambung, $_POST['tugas_1']);
    $tugas2 = mysqli_real_escape_string($sambung, $_POST['tugas_2']);
    $tugas3 = mysqli_real_escape_string($sambung, $_POST['tugas_3']);
    $uts = mysqli_real_escape_string($sambung, $_POST['uts']);
    $uas = mysqli_real_escape_string($sambung, $_POST['uas']);

    // SQL query to update the values of the selected row
    $sql = "UPDATE responsi SET `tugas 1` = '$tugas1', `tugas 2` = '$tugas2', `tugas 3` = '$tugas3', `UTS` = '$uts', `UAS` = '$uas' WHERE nama = '$nama'";

    // Execute the query and check if the update was successful
    if (mysqli_query($sambung, $sql)) {
        // Redirect to the dashboard with a success message
        header("Location: ./dashboard.php?success=Data berhasil diperbarui");
    } else {
        // Redirect to the dashboard with an error message
        header("Location: ./dashboard.php?error=Gagal memperbarui data");
    }
} else {
    // Redirect to dashboard if accessed directly without POST data
    header("Location: ./dashboard.php");
}

// Close the database connection
mysqli_close($sambung);
?>