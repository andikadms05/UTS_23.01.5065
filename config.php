<?php

//server yang digunakan
$server = "localhost";

//userame server
$user = "root";

//password server
$password = "";

//database yang digunakan
$nama_database = "db_5065";

$sambung = mysqli_connect($server, $user, $password, $nama_database);
if( !$sambung ) {
    die("Ada masalah koneksi ke database: " .mysqli_connect_error());
}
?>