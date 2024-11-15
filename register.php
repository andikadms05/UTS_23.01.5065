<?php
include 'config.php';

//ambil data dari form
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

//buat query
    $sql = "INSERT INTO users (nama, username, password) VALUES ('$nama', '$username', '$password')";
    $query = mysqli_query($sambung, $sql);


    if ($query) {
        echo "Registrasi Berhasil";
        exit;
    }else {
        echo "Gagal Registrasi";
        exit;
    }
?>