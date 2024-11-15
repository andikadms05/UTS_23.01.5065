<?php
require "./config.php"; // Memanggil koneksi database

// Cek jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($sambung, $_POST["nama"]);

    // Query untuk menambah data ke database
    $sql = "INSERT INTO responsi (nama) VALUES ('$nama')";
    
    if (mysqli_query($sambung, $sql)) {
        // Redirect kembali ke home
        header("location: ./dashboard.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($sambung);
    }
}
?>