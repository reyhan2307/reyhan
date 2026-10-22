<?php

include_once __DIR__ . "/../model/m_koneksi.php";

if (!isset($conn) || !($conn instanceof mysqli)) {
    die("Koneksi database tidak tersedia.");
}

/* AMBIL DATA */
$query = mysqli_query($conn, "
    SELECT 
        a.id_area,
        a.nama_area,
        a.kapasitas,
        COUNT(t.id_parkir) AS terisi
    FROM tb_area_parkir a
    LEFT JOIN tb_transaksi t
        ON a.id_area = t.id_area
        AND t.status = 'masuk'
    GROUP BY 
        a.id_area,
        a.nama_area,
        a.kapasitas
    ORDER BY a.id_area DESC
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

    <title>Area Parkir - ParkirKu</title>

    <!-- CSS -->
<link rel="stylesheet" href="../assets/area_parkir.css">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <div class="logo-box">P</div>

        <div>
            <h2>ParkirKu</h2>
            <p>Admin Panel</p>
        </div>
    </div>

    <ul class="menu">

        <li>
            <a href="dashboard.php">
                🏠 Dashboard
            </a>
        </li>

        <li>
            <a href="kelola_user.php">
                👥 Kelola User
            </a>
        </li>

        <li>
            <a href="tarif_parkir.php">
                🪙 Tarif Parkir
            </a>
        </li>

        <li>
            <a href="area_parkir.php" class="active">
                🅿 Area Parkir
            </a>
        </li>

        <li>
            <a href="kendaraan.php">
                🚗 Kendaraan
            </a>
        </li>

        <li>
            <a href="log_aktivitas.php">
                📋 Log Aktivitas
            </a>
        </li>

    </ul>

    <div class="admin">
        <div class="admin-icon">A</div>

        <div>
            <b>Administrator</b>
            <br>
            <small>Admin</small>
        </div>
    </div>

</div>


<!-- CONTENT -->
<div class="content">

    <div class="header">

        <div>
            <h1>Area Parkir</h1>
            <p>Kelola area dan kapasitas parkir kendaraan</p>
        </div>

        <a href="tambah_area.php" class="btn-tambah">
            + Tambah Area
        </a>

    </div>


    <!-- TABLE -->
    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Area</th>
                    <th>Kapasitas</th>
                    <th>Terisi</th>
                    <th>Tersedia</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            while ($area = mysqli_fetch_assoc($query)):

                $kapasitas = (int) $area['kapasitas'];
                $terisi = (int) $area['terisi'];
                $tersedia = $kapasitas - $terisi;
            ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td>
                        <b>
                            <?= htmlspecialchars($area['nama_area']); ?>
                        </b>
                    </td>

                    <td>
                        <?= $kapasitas; ?> kendaraan
                    </td>

                    <td>
                        <?= $terisi; ?> kendaraan
                    </td>

                    <td>
                        <?= $tersedia; ?> slot
                    </td>

                    <td>

                        <?php if ($tersedia > 0): ?>

                            <span class="tersedia">
                                ● Tersedia
                            </span>

                        <?php else: ?>

                            <span class="penuh">
                                ● Penuh
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>
    <div class="aksi">

        <a
            href="edit_area.php?id=<?= $area['id_area']; ?>"
            class="btn-edit">
            ✏ Edit
        </a>

        <a
            href="../controller/c_data.php?hapus_area=<?= $area['id_area']; ?>"
            class="btn-hapus"
            onclick="return confirm('Yakin ingin menghapus area ini?');">
            🗑 Hapus
        </a>

    </div>
</td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
