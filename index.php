<?php
#ambil get message jika ada
$errorMessage = @$_GET["error"];
#memulai session
session_start();
#ambil status aksessnya
$akses = @$_SESSION["akses"];
#cek akses apakah sudah login
if($akses == true){
    header("location:./dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url('background.jpg');
    background-size: cover;
    background-position: center;
}

.login-container {
    display: flex;
    flex-direction: row;
    width: 800px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 20px;
    overflow: hidden;
    background-color: #fff;
}

.login-container .image-side {
    width: 50%;
    background: url('xx.png') no-repeat center center;
    background-size: cover;
    background-color: #7b3f00;
}

.login-container .form-side {
    width: 50%;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #f5f5f5;
}

.form-side h1 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
}

.form-side form {
    display: flex;
    flex-direction: column;
}

.form-side input {
    margin-bottom: 20px;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-side button {
    padding: 10px;
    font-size: 16px;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-side button:hover {
    background-color: #c0392b;
}

.form-side a {
    text-align: center;
    color: #3498db;
    text-decoration: none;
}

.form-side a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="login-container">
        <div class="image-side"></div> 
        <div class="form-side">
            <h1>Form Login</h1>
            <form action="./login.php" method="POST">
                <label>Masukan Username</label>
                <input type="text" name="username">
                <label>Masukan Password</label>
                <input type="password" name="password">
                <button type="submit">Login</button>
            </form>
            <a href="#">Forgot password?</a><br>
            <a href="index2.php">Don't have an account? Register here</a>
        </div>
    </div>
</body>
</html>