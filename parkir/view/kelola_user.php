<?php
include_once __DIR__ . "/../model/m_koneksi.php";


// tampilkan data user
$query = mysqli_query($conn, "SELECT * FROM tb_user ORDER BY id_user DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola User - Parkirss</title>

    <!-- CSS -->
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
            <a href="kelola_user.php" class="active">
                👥 Kelola User
            </a>
        </li>

        <li>
            <a href="tarif_parkir.php">
                🪙 Tarif Parkir
            </a>
        </li>

        <li>
            <a href="area_parkir.php">
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

</div>


<!-- CONTENT -->
<div class="main">

    <div class="header">

        <div>
            <h1>Kelola User</h1>
            <p>Kelola pengguna aplikasi Parkirss</p>
        </div>

        <a href="tambah_user.php" class="btn-tambah">
            + Tambah User
        </a>

    </div>


    <!-- TABLE -->
    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            if (mysqli_num_rows($query) > 0) {

                while ($user = mysqli_fetch_assoc($query)) {
            ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($user['username']); ?>
                    </td>

                    <td>
                        <span class="status">
                            <?= htmlspecialchars($user['role']); ?>
                        </span>
                    </td>

                    <td>

                        <td class="kolom-aksi">

    <a href="edit_user.php?id=<?= $user['id_user']; ?>"
       class="btn-edit">
        Edit
    </a>

    <a href="../controller/c_data.php?hapus_user=<?= $user['id_user']; ?>"
       class="btn-hapus"
       onclick="return confirm('Yakin ingin menghapus user ini?');">
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
                        Belum ada data user
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>