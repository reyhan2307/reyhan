<?php
include_once __DIR__ . "/../model/m_koneksi.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = mysqli_query($conn,
    "SELECT * FROM tb_area_parkir WHERE id_area = $id"
);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data area parkir tidak ditemukan.");
}

$area = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Area Parkir</title>

    <link rel="stylesheet" href="../assets/edit_area.css">
</head>

<body>

<div class="container">

    <div class="card">

        <div class="icon">🅿️</div>

        <h1>Edit Area Parkir</h1>
        <p class="subtitle">Perbarui informasi area parkir</p>

        <form action="../controller/c_data.php" method="POST">

            <input type="hidden"
                   name="id_area"
                   value="<?= $area['id_area']; ?>">

            <div class="form-group">
                <label>Nama Area</label>

                <input
                    type="text"
                    name="nama_area"
                    value="<?= htmlspecialchars($area['nama_area']); ?>"
                    placeholder="Contoh: Area A"
                    required
                >
            </div>

            <div class="form-group">
                <label>Kapasitas</label>

                <input
                    type="number"
                    name="kapasitas"
                    value="<?= $area['kapasitas']; ?>"
                    min="1"
                    placeholder="Masukkan kapasitas"
                    required
                >
            </div>

            <div class="form-group">
                <label>Jumlah Terisi</label>

                <input
                    type="number"
                    name="terisi"
                    value="<?= $area['terisi']; ?>"
                    min="0"
                    placeholder="Masukkan jumlah kendaraan"
                    required
                >
            </div>

            <button type="submit"
                    name="edit_area"
                    class="btn-simpan">
                💾 Simpan Perubahan
            </button>

            <a href="area_parkir.php" class="btn-kembali">
                ← Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>