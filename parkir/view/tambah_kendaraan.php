<?php
include_once __DIR__ . "/../model/m_koneksi.php";

// ambil semua user
$query_user = mysqli_query($conn, "
    SELECT id_user, nama_lengkap, username
    FROM tb_user
    WHERE status_aktif = 1
    ORDER BY nama_lengkap ASC
");

if (!$query_user) {
    die("Gagal mengambil data user: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan</title>

    <link rel="stylesheet" href="../assets/kendaraan.css">

    <style>
        .form-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            max-width: 700px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #47eb25;
        }

        .form-action {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-simpan {
            border: none;
            padding: 12px 20px;
            background: #47eb25;
            color: white;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-simpan:hover {
            background: #38d81d;
        }

        .btn-batal {
            display: inline-block;
            padding: 12px 20px;
            background: #ef4444;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-batal:hover {
            background: #dc2626;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <div class="logo-box">P</div>
        <div>
            <h2>Parkirss</h2>
            <p>Parking Management</p>
        </div>
    </div>

    <ul class="menu">

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
            <a href="kendaraan.php" class="active">Kendaraan</a>
        </li>

        <li>
            <a href="log_aktivitas.php">Log Aktivitas</a>
        </li>

    </ul>

</div>


<!-- CONTENT -->
<div class="content">

    <div class="header">
        <div>
            <h1>Tambah Kendaraan</h1>
            <p>Tambahkan data kendaraan baru</p>
        </div>
    </div>


    <div class="form-container">

        <form action="../controller/c_data.php" method="POST">

    <input type="hidden" name="tambah_kendaraan" value="1">

    <!-- PLAT NOMOR -->
    <div class="form-group">
        <label>Plat Nomor</label>

        <input
            type="text"
            name="plat_nomer"
            placeholder="Contoh: D 1234 ABC"
            required
        >
    </div>

    <!-- JENIS KENDARAAN -->
    <div class="form-group">
        <label>Jenis Kendaraan</label>

        <select name="jenis_kendaraan" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="motor">Motor</option>
            <option value="mobil">Mobil</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <!-- WARNA -->
    <div class="form-group">
        <label>Warna</label>

        <input
            type="text"
            name="warna"
            placeholder="Contoh: Hitam"
            required
        >
    </div>

    <!-- PEMILIK -->
    <div class="form-group">
        <label>Pemilik</label>

        <input
            type="text"
            name="penilik"
            placeholder="Masukkan nama pemilik"
            required
        >
    </div>

    <!-- BUTTON -->
    <div class="form-action">

        <button type="submit" class="btn-simpan">
            Simpan Kendaraan
        </button>

        <a href="kendaraan.php" class="btn-batal">
            Batal
        </a>

    </div>

</form>

    </div>

</div>

</body>
</html>