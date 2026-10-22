<?php
include_once __DIR__ . "/../model/m_koneksi.php";

/* AMBIL DATA KENDARAAN */
$query = mysqli_query($conn, "
    SELECT
        id_kendaraan,
        plat_nomer,
        jenis_kendaraan,
        warna,
        penilik
    FROM tb_kendaraan
    ORDER BY id_kendaraan DESC
");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kendaraan Saya - ParkirKu</title>

    <link rel="stylesheet" href="../assets/kendaraan_saya.css">
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">

            <div class="logo-icon">
                P
            </div>

            <div>
                <h2>ParkirKu</h2>
                <span>User</span>
            </div>

        </div>


        <nav class="menu">

            <a href="user.php">
                <span>⌂</span>
                Beranda
            </a>

            <a href="kendaraan_saya.php" class="active">
                <span>🚗</span>
                Kendaraan Saya
            </a>

            <a href="riwayat.php">
                <span>📋</span>
                Riwayat Parkir
            </a>

            <a href="profil.php">
                <span>👤</span>
                Profil
            </a>

        </nav>


        <div class="sidebar-bottom">

            <div class="user-mini">

                <div class="avatar">
                    U
                </div>

                <div>
                    <strong>User</strong>
                    <small>Pengguna</small>
                </div>

            </div>

        </div>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- HEADER -->
        <header class="header">

            <div>
                <h1>Kendaraan Saya</h1>

                <p>
                    Daftar kendaraan yang terdaftar di ParkirKu
                </p>
            </div>

            <div class="profile">

                <div class="avatar">
                    U
                </div>

                <div>
                    <strong>User</strong>
                    <small>Pengguna</small>
                </div>

            </div>

        </header>


        <!-- JUDUL -->
        <section class="content">

            <div class="section-title">

                <h2>
                    Daftar Kendaraan
                </h2>

                <p>
                    Informasi kendaraan yang terdaftar
                </p>

            </div>


            <!-- DATA KENDARAAN -->
            <div class="vehicle-list">

                <?php if (mysqli_num_rows($query) > 0) { ?>

                    <?php while ($data = mysqli_fetch_assoc($query)) { ?>

                        <div class="vehicle-card">

                            <div class="vehicle-icon">
                                🚗
                            </div>

                            <div class="vehicle-info">

                                <h3>
                                    <?= htmlspecialchars($data['plat_nomer']); ?>
                                </h3>

                                <p>
                                    <?= htmlspecialchars($data['jenis_kendaraan']); ?>
                                </p>

                                <span>
                                    Warna: <?= htmlspecialchars($data['warna']); ?>
                                </span>

                                <small>
                                    Pemilik: <?= htmlspecialchars($data['penilik']); ?>
                                </small>

                            </div>

                        </div>

                    <?php } ?>

                <?php } else { ?>

                    <div class="empty">

                        <div>
                            🚗
                        </div>

                        <h3>
                            Belum ada kendaraan
                        </h3>

                        <p>
                            Belum ada kendaraan yang terdaftar.
                        </p>

                    </div>

                <?php } ?>

            </div>

        </section>


        <!-- INFO -->
        <div class="info-box">

            <div class="info-icon">
                ℹ️
            </div>

            <div>

                <h3>
                    Informasi Kendaraan
                </h3>

                <p>
                    Pastikan data kendaraan seperti plat nomor,
                    jenis kendaraan, dan warna sudah benar.
                </p>

            </div>

        </div>

    </main>

</div>

</body>
</html>