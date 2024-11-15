<?php
include "config.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

//validasi input
if (!empty($username)&& !empty($password)){
    $query = mysqli_query($sambung,"select * from users where username = '$username' and password = '$password'");

    $result = mysqli_num_rows($query);

        if($result>0){
            session_start();
            $_SESSION["akses"] = true;
            header("location:./dashboard.php");

        }else{
            header(header:"location:../index.php?app=gagal");
    }
}else{
        header(header: "location:../index.php?app=gagal");
}
?>