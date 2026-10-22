<?php
include_once __DIR__ . "/../model/m_koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Area Parkir</title>

    <link rel="stylesheet" href="../assets/edit_area.css">
</head>

<body>

<div class="container">

    <div class="card">

        <div class="icon">🅿️</div>

        <h1>Tambah Area Parkir</h1>
        <p class="subtitle">Tambahkan area parkir baru</p>

        <form action="../controller/c_data.php" method="POST">

            <div class="form-group">
                <label>Nama Area</label>

                <input
                    type="text"
                    name="nama_area"
                    placeholder="Contoh: Area A"
                    required
                >
            </div>

            <div class="form-group">
                <label>Kapasitas</label>

                <input
                    type="number"
                    name="kapasitas"
                    min="1"
                    placeholder="Contoh: 50"
                    required
                >
            </div>

            <div class="form-group">
                <label>Jumlah Terisi</label>

                <input
                    type="number"
                    name="terisi"
                    min="0"
                    value="0"
                    placeholder="Contoh: 0"
                    required
                >
            </div>

            <button
                type="submit"
                name="tambah_area"
                class="btn-simpan">
                ➕ Tambah Area
            </button>

            <a href="area_parkir.php" class="btn-kembali">
                ← Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>