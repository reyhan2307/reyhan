<?php
session_start();

include_once __DIR__ . "/../model/m_koneksi.php";

$query = mysqli_query($conn, "
    SELECT 
        l.*,
        u.nama_lengkap,
        u.username
    FROM tb_log_aktivitas l
    LEFT JOIN tb_user u 
        ON l.id_user = u.id_user
    ORDER BY l.id_log DESC
");

if (!$query) {
    die("Gagal mengambil log: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log Aktivitas - Parkirss</title>

        <link rel="stylesheet" href="../assets/kelola_user.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h2>Parkirss</h2>

    <ul>

        <li>
            <a href="dashboard.php">Dashboard</a>
        </li>

        <li>
            <a href="kelola_user.php">Kelola User</a>
        </li>

        <li>
            <a href="tarif_parkir.php">Tarif Parkir</a>
        </li>

        <li>
            <a href="area_parkir.php">Area Parkir</a>
        </li>

        <li>
            <a href="kendaraan.php">Kendaraan</a>
        </li>

        <li class="active">
            <a href="log_aktivitas.php">Log Aktivitas</a>
        </li>

    </ul>

</div>


<!-- CONTENT -->
<div class="main">

    <div class="header">

        <div>
            <h1>Log Aktivitas</h1>
            <p>Riwayat aktivitas pengguna pada sistem Parkirss</p>
        </div>

    </div>


    <!-- TABLE -->
    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Aktivitas</th>
                    <th>waktu aktivitas</th>
                </tr>

            </thead>

            <tbody>

            <?php

            $no = 1;

            if (mysqli_num_rows($query) > 0) {

                while ($log = mysqli_fetch_assoc($query)) {

            ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($log['username'] ?? '-'); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($log['aktivitas']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($log['waktu_aktivitas']); ?>
                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="4" style="text-align:center;">
                        Belum ada aktivitas
                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>