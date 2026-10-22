<?php
include_once __DIR__ . "/../model/m_koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tarif Parkir</title>

    <link rel="stylesheet" href="../assets/edit_tarif.css">
</head>

<body>

<div class="container">

    <div class="form-card">

        <div class="form-header">
            <div class="icon">💰</div>

            <div>
                <h1>Tambah Tarif Parkir</h1>
                <p>Tambahkan tarif parkir kendaraan baru</p>
            </div>
        </div>

        <form action="../controller/c_data.php" method="POST">

            <div class="form-group">
                <label>Jenis Kendaraan</label>

                <select name="jenis_kendaraan" required>
                     value="">-- Pilih Jenis Kendaraan --</>
                    <option value="Motor">🛵 Motor</option>
                    <option value="Mobil">🚗 Mobil</option>
                    
                </select>
            </div>

            <div class="form-group">
                <label>Tarif Parkir / Jam</label>

                <div class="input-rupiah">
                    <span>Rp</span>

                    <input type="number"
                           name="tarif_per_jam"
                           min="0"
                           placeholder="Contoh: 3000"
                           required>
                </div>
            </div>

            <div class="preview">

                <div class="preview-icon">💳</div>

                <div>
                    <small>Status tarif</small>

                    <strong>Tarif baru</strong>
                </div>

            </div>

            <div class="button-group">

                <a href="tarif_parkir.php" class="btn-kembali">
                    ← Kembali
                </a>

                <button type="submit"
                        name="tambah_tarif"
                        class="btn-simpan">
                    ✓ Tambah Tarif
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>