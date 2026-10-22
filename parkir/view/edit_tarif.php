<?php
include_once __DIR__ . "/../model/m_koneksi.php";

if (!isset($_GET['id'])) {
    die("ID tarif tidak ditemukan.");
}

$id = intval($_GET['id']);

$query = mysqli_query($conn, "SELECT * FROM tb_tarif WHERE id_tarif = $id");

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data tarif tidak ditemukan.");
}

$tarif = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tarif Parkir</title>

    <link rel="stylesheet" href="../assets/edit_tarif.css">
</head>

<body>

<div class="container">

    <div class="form-card">

        <div class="form-header">
            <div class="icon">💰</div>

            <div>
                <h1>Edit Tarif Parkir</h1>
                <p>Perbarui tarif parkir kendaraan</p>
            </div>
        </div>

        <form action="../controller/c_data.php" method="POST">

            <input type="hidden" name="id_tarif"
                   value="<?= $tarif['id_tarif']; ?>">

            <div class="form-group">
                <label>Jenis Kendaraan</label>

                <select name="jenis_kendaraan" required>

                    <option value="Motor"
                        <?= $tarif['jenis_kendaraan'] == 'Motor' ? 'selected' : ''; ?>>
                        🛵 Motor
                    </option>

                    <option value="Mobil"
                        <?= $tarif['jenis_kendaraan'] == 'Mobil' ? 'selected' : ''; ?>>
                        🚗 Mobil
                    </option>

                    

                </select>
            </div>


            <div class="form-group">
                <label>Tarif Parkir / Jam</label>

                <div class="input-rupiah">
                    <span>Rp</span>

                    <input type="number"
                           name="tarif_per_jam"
                           value="<?= $tarif['tarif_per_jam']; ?>"
                           min="0"
                           required>
                </div>
            </div>


            <div class="preview">

                <div class="preview-icon">💳</div>

                <div>
                    <small>Tarif saat ini</small>

                    <strong>
                        Rp <?= number_format($tarif['tarif_per_jam'], 0, ',', '.'); ?>
                        <span>/ jam</span>
                    </strong>
                </div>

            </div>


            <div class="button-group">

                <a href="tarif_parkir.php" class="btn-kembali">
                    ← Kembali
                </a>

                <button type="submit"
                        name="edit_tarif"
                        class="btn-simpan">
                    ✓ Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

</body>
  </html>