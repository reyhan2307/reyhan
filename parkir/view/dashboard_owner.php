<?php

session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 'owner') {
    die("Akses ditolak.");
}

include_once __DIR__ . "/../model/m_koneksi.php";



// Data statistik
$query_transaksi = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tb_transaksi"
);
$total_transaksi = mysqli_fetch_assoc($query_transaksi)['total'];

$query_kendaraan = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tb_kendaraan"
);
$total_kendaraan = mysqli_fetch_assoc($query_kendaraan)['total'];

$query_area = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tb_area_parkir"
);
$total_area = mysqli_fetch_assoc($query_area)['total'];

$query_user = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tb_user"
);
$total_user = mysqli_fetch_assoc($query_user)['total'];

$nama_owner = $_SESSION['nama_lengkap'] ?? 'Owner';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Owner - ParkirKu</title>

    <link rel="stylesheet" href="../assets/admin.css">
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">P</div>

            <div>
                <h2>ParkirKu</h2>
                <span>Owner Panel</span>
            </div>
        </div>

        <nav class="menu">

            <a href="dashboard_owner.php" class="active">
                <span>⌂</span>
                Dashboard
            </a>

            <a href="rekap_transaksi.php">
                <span>📊</span>
                Rekap Transaksi
            </a>

            <a href="laporan_parkir.php">
                <span>📋</span>
                Laporan Parkir
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
                <div class="avatar">O</div>

                <div>
                    <strong><?= htmlspecialchars($nama_owner); ?></strong>
                    <small>Owner</small>
                </div>
            </div>

        </div>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- HEADER -->
        <header class="header">

            <div>
                <h1>Dashboard Owner</h1>
                <p>Selamat datang di sistem ParkirKu 👋</p>
            </div>

            <div class="admin-profile">

                <div class="avatar">O</div>

                <div>
                    <strong><?= htmlspecialchars($nama_owner); ?></strong>
                    <small>Owner</small>
                </div>

            </div>

        </header>


        <!-- STATISTIK -->
        <section class="statistics">

            <div class="card">

                <div class="card-icon purple">📊</div>

                <div>
                    <span>Total Transaksi</span>
                    <h2><?= $total_transaksi; ?></h2>
                </div>

            </div>


            <div class="card">

                <div class="card-icon green">🚗</div>

                <div>
                    <span>Total Kendaraan</span>
                    <h2><?= $total_kendaraan; ?></h2>
                </div>

            </div>


            <div class="card">

                <div class="card-icon orange">🅿</div>

                <div>
                    <span>Area Parkir</span>
                    <h2><?= $total_area; ?></h2>
                </div>

            </div>


            <div class="card">

                <div class="card-icon blue">👥</div>

                <div>
                    <span>Total User</span>
                    <h2><?= $total_user; ?></h2>
                </div>

            </div>

        </section>



