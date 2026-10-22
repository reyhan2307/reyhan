<?php
include_once __DIR__ . "/../model/m_koneksi.php";

// hapus tarif
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);

    mysqli_query($conn, "DELETE FROM tb_tarif WHERE id_tarif = $id");

    header("Location: tarif_parkir.php");
    exit;
}

// ambil data tarif
$query = mysqli_query($conn, "
    SELECT *
    FROM tb_tarif
    ORDER BY id_tarif DESC
");

// cek query
if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tarif Parkir - Parkirss</title>

<link rel="stylesheet" href="../assets/kelola_user.css">
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
            <a href="tarif_parkir.php"class="active">
                🪙 Tarif Parkir
            </a>
        </li>

        <li>
            <a href="area_parkir.php" >
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
        </li>

    </ul>

</div>


<div class="main">

    <div class="header">

        <div>
            <h1>Tarif Parkir</h1>
            <p>Kelola tarif parkir kendaraan</p>
        </div>

        <a href="tambah_tarif.php" class="btn-tambah">
            + Tambah Tarif
        </a>

    </div>


    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Kendaraan</th>
                    <th>Tarif Per Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            if (mysqli_num_rows($query) > 0) {

                while ($tarif = mysqli_fetch_assoc($query)) {
            ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($tarif['jenis_kendaraan']); ?>
                    </td>

                    <td>
                        Rp <?= number_format($tarif['tarif_per_jam'], 0, ',', '.'); ?>
                    </td>

                    <td>

                        <a
                            href="edit_tarif.php?id=<?= $tarif['id_tarif']; ?>"
                            class="btn-edit">
                            Edit
                        </a>

                        <a
                            href="tarif_parkir.php?hapus=<?= $tarif['id_tarif']; ?>"
                            class="btn-hapus"
                            onclick="return confirm('Yakin ingin menghapus tarif ini?');">
                            Hapus
                        </a>

                    </td>

                </tr>

            <?php
                }

            } else {
            ?>

                <tr>
                    <td colspan="4" style="text-align:center;">
                        Belum ada data tarif parkir
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>