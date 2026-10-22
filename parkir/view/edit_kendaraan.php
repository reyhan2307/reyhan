<?php
include_once __DIR__ . "/../model/m_koneksi.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = mysqli_query($conn,
    "SELECT * FROM tb_kendaraan
     WHERE id_kendaraan = $id"
);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data kendaraan tidak ditemukan.");
}

$kendaraan = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Kendaraan</title>

    <link rel="stylesheet" href="../assets/kendaraan.css">

    <style>
        .form-container {
            max-width: 600px;
            background: white;
            padding: 30px;
            margin: 30px auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
        }

        .btn-simpan {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #4a6cf7;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-kembali {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #555;
        }
      .content {
    width: 100%;
    min-height: 100vh;
    padding: 40px 20px;
    margin: 0;
    box-sizing: border-box;
}

.header {
    max-width: 600px;
    margin: 0 auto 25px auto;
}

.form-container {
    width: 100%;
    max-width: 600px;
    background: white;
    padding: 30px;
    margin: 0 auto;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,.08);
    box-sizing: border-box;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
}

.btn-simpan {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 8px;
    background: #4a6cf7;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.btn-kembali {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: #555;
          }
    </style>
</head>

<body>

<div class="content">

    <div class="header">
        <h1>Edit Kendaraan</h1>
        <p>Perbarui data kendaraan</p>
    </div>

    <div class="form-container">

        <form action="../controller/c_data.php" method="POST">

            <input type="hidden"
                   name="id_kendaraan"
                   value="<?= $kendaraan['id_kendaraan']; ?>">

            <div class="form-group">
                <label>Plat Nomor</label>

                <input
                    type="text"
                    name="plat_nomer"
                    value="<?= htmlspecialchars($kendaraan['plat_nomer']); ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Jenis Kendaraan</label>

                <select name="jenis_kendaraan" required>

                    <option value="Motor"
                        <?= $kendaraan['jenis_kendaraan'] == 'Motor' ? 'selected' : ''; ?>>
                        Motor
                    </option>

                    <option value="Mobil"
                        <?= $kendaraan['jenis_kendaraan'] == 'Mobil' ? 'selected' : ''; ?>>
                        Mobil
                    </option>

                    <option value="Truk"
                        <?= $kendaraan['jenis_kendaraan'] == 'Truk' ? 'selected' : ''; ?>>
                        Truk
                    </option>

                </select>
            </div>

            <div class="form-group">
                <label>Warna</label>

                <input
                    type="text"
                    name="warna"
                    value="<?= htmlspecialchars($kendaraan['warna']); ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Penilik</label>

                <input
                    type="text"
                    name="penilik"
                    value="<?= htmlspecialchars($kendaraan['penilik']); ?>"
                    required
                >
            </div>

            <button
                type="submit"
                name="edit_kendaraan"
                class="btn-simpan">
                💾 Simpan Perubahan
            </button>

            <a href="kendaraan.php" class="btn-kembali">
                ← Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>