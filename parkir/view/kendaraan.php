<?php
include_once __DIR__ . "/../model/m_koneksi.php";

$query = mysqli_query($conn, "
    SELECT *
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
    <title>Kendaraan - ParkirKu</title>

    <link rel="stylesheet" href="../assets/kendaraan.css">
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
            <a href="area_parkir.php" >
                🅿 Area Parkir
            </a>
        </li>

        <li>
            <a href="kendaraan.php"class="active">
                🚗 Kendaraan
            </a>
        </li>

        <li>
            <a href="log_aktivitas.php">
                📋 Log Aktivitas
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

    <!-- HEADER -->
    <div class="header">

        <div>
            <h1>Kendaraan</h1>
            <p>Kelola data kendaraan yang terdaftar</p>
        </div>

        <a href="tambah_kendaraan.php" class="btn-tambah">
            + Tambah Kendaraan
        </a>

    </div>


    <!-- TABLE -->
    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Jenis Kendaraan</th>
                    <th>Warna</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            if (mysqli_num_rows($query) > 0) {

                while ($kendaraan = mysqli_fetch_assoc($query)) {
            ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>
                        <b>
                            <?= htmlspecialchars($kendaraan['plat_nomer']); ?>
                        </b>
                    </td>

                    <td>
                        <?= htmlspecialchars($kendaraan['jenis_kendaraan']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($kendaraan['warna']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($kendaraan['penilik']); ?>
                    </td>

                    <td>

                        <div class="aksi">

                            <a
                                href="edit_kendaraan.php?id=<?= $kendaraan['id_kendaraan']; ?>"
                                class="btn-edit">
                                ✏ Edit
                            </a>

                            <a
                                href="../controller/c_data.php?hapus_kendaraan=<?= $kendaraan['id_kendaraan']; ?>"
                                class="btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus kendaraan ini?');">
                                🗑 Hapus
                            </a>

                        </div>

                    </td>

                </tr>

            <?php
                }

            } else {
            ?>

                <tr>
                    <td colspan="6" class="kosong">
                        Belum ada data kendaraan
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