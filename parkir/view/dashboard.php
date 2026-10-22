<?php

session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak.");
}

include_once __DIR__ . "/../model/m_koneksi.php";



/* DATA STATISTIK */

// Total User
$query_user = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_user");
$total_user = mysqli_fetch_assoc($query_user)['total'];

// Total Kendaraan
$query_kendaraan = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_kendaraan");
$total_kendaraan = mysqli_fetch_assoc($query_kendaraan)['total'];

// Total Area Parkir
$query_area = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_area_parkir");
$total_area = mysqli_fetch_assoc($query_area)['total'];

// Total Transaksi
$query_transaksi = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_transaksi");
$total_transaksi = mysqli_fetch_assoc($query_transaksi)['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - ParkirKu</title>

    <link rel="stylesheet" href="../assets/admin.css">
</head>

<body>


<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="logo">
        <div class="logo-icon">P</div>

        <div>
            <h2>ParkirKu</h2>
            <span>Admin Panel</span>
        </div>
    </div>

    <nav class="menu">

    <a href="dashboard_admin.php" class="active">
        <span>⌂</span>
        Dashboard
    </a>

    <a href="kelola_user.php">
        <span>👥</span>
        Kelola User
    </a>

    <a href="tarif_parkir.php">
        <span>💰</span>
        Tarif Parkir
    </a>

    <a href="area_parkir.php">
        <span>🅿</span>
        Area Parkir
    </a>

    <a href="kendaraan.php">
        <span>🚗</span>
        Kendaraan
    </a>

    <a href="log_aktivitas.php">
        <span>📋</span>
        Log Aktivitas
    </a>

    <a href="../controller/logout.php"
       class="logout"
       onclick="return confirm('Apakah Anda yakin ingin keluar dari akun ini?');">
        <span>🚪</span>
        Logout
    </a>

</nav>
    <div class="sidebar-bottom">

        <div class="admin-mini">
            <div class="avatar">A</div>

            <div>
                <strong>Administrator</strong>
                <small>Admin</small>
            </div>
        </div>

    </div>

</aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- HEADER -->
        <header class="header">

            <div>
                <h1>Dashboard</h1>
                <p>Selamat datang di sistem ParkirKu 👋</p>
            </div>

            <div class="admin-profile">

                <div class="avatar">
                    A
                </div>

                <div>
                    <strong>Administrator</strong>
                    <small>Admin</small>
                </div>

            </div>

        </header>


        <!-- STATISTIK -->
        <section class="statistics">

            <div class="card">

                <div class="card-icon blue">
                    👥
                </div>

                <div>
                    <span>Total User</span>
                    <h2><?= $total_user; ?></h2>
                </div>

            </div>


            <div class="card">

                <div class="card-icon green">
                    🚗
                </div>

                <div>
                    <span>Total Kendaraan</span>
                    <h2><?= $total_kendaraan; ?></h2>
                </div>

            </div>


            <div class="card">

                <div class="card-icon orange">
                    🅿
                </div>

                <div>
                    <span>Area Parkir</span>
                    <h2><?= $total_area; ?></h2>
                </div>

            </div>


            <div class="card">

                <div class="card-icon purple">
                    📊
                </div>

                <div>
                    <span>Total Transaksi</span>
                    <h2><?= $total_transaksi; ?></h2>
                </div>

            </div>

        </section>


        


                

                    

</body>
</html>
