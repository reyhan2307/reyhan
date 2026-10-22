<?php
session_start();

if (isset($_SESSION['id_user'])) {

    if ($_SESSION['role'] == 'admin') {
        header("Location: dashboard.php");
        exit;
    }

    if ($_SESSION['role'] == 'petugas') {
        header("Location: dashboard_petugas.php");
        exit;
    }

    if ($_SESSION['role'] == 'owner') {
        header("Location: dashboard_owner.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login ParkirKu</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #d1fae5, #ecfdf5);
}

.login-box {
    width: 380px;
    background: white;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(0,0,0,.12);
}

.logo {
    text-align: center;
    font-size: 45px;
}

h2 {
    text-align: center;
    color: #047857;
    margin-bottom: 8px;
}

.subtitle {
    text-align: center;
    color: #6b7280;
    margin-bottom: 25px;
    font-size: 14px;
}

label {
    display: block;
    margin-top: 15px;
    margin-bottom: 7px;
    font-weight: bold;
    color: #374151;
}

input {
    width: 100%;
    padding: 13px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 14px;
}

input:focus {
    outline: none;
    border-color: #059669;
}

button {
    width: 100%;
    margin-top: 25px;
    padding: 14px;
    border: none;
    border-radius: 10px;
    background: #059669;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #047857;
}
</style>
</head>

<body>

<div class="login-box">

    <div class="logo">🅿️</div>

    <h2>ParkirKu</h2>

    <p class="subtitle">
        Silakan login untuk melanjutkan
    </p>

    <form action="../controller/c_login.php" method="POST">

        <label>Username</label>
        <input
            type="text"
            name="username"
            placeholder="Masukkan username"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            placeholder="Masukkan password"
            required
        >

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>