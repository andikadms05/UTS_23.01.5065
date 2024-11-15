<?php
require "./config.php";

session_start();

if (!isset($_SESSION["akses"]) || $_SESSION["akses"] !== true) {
    header("location:./index.php?error=Anda harus login untuk mengakses halaman ini");
    exit;
}

if (isset($_POST['nama'])) {
    $nama = mysqli_real_escape_string($sambung, $_POST['nama']);

    $sql = "DELETE FROM responsi WHERE nama = '$nama'";
    if (mysqli_query($sambung, $sql)) {
        header("location:dashboard.php?message=Data berhasil dihapus");
        exit;
    } else {
        echo "Error: " . mysqli_error($sambung);
    }
} else {
    echo "Data tidak lengkap untuk menghapus.";
}

# Tutup koneksi
mysqli_close($sambung);
?>