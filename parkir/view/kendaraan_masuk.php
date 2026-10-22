<?php
ob_start();
session_start();

date_default_timezone_set('Asia/Jakarta');

include_once __DIR__ . "/../model/m_koneksi.php";

/* =========================
   DATA KENDARAAN
========================= */
$kendaraan = mysqli_query($conn, "
    SELECT *
    FROM tb_kendaraan
    ORDER BY id_kendaraan DESC
");

/* =========================
   DATA AREA PARKIR
========================= */
$area = mysqli_query($conn, "
    SELECT *
    FROM tb_area_parkir
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kendaraan Masuk</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 25px;
            background: linear-gradient(135deg, #d1fae5, #f0fdf4);
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 35px;
            background: white;
            border-radius: 22px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.12);
        }

        h2 {
            text-align: center;
            color: #047857;
            margin-bottom: 12px;
            font-size: 28px;
        }

        .container > p {
            text-align: center;
            color: #6b7280;
            margin-bottom: 28px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: bold;
            color: #374151;
            margin-top: 10px;
        }

        select,
        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            background: #f9fafb;
        }

        select:focus,
        input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px #d1fae5;
        }

        button {
            margin-top: 20px;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: #059669;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #047857;
        }

        /* WAKTU MASUK */
        #waktu_masuk {
            background: #f3f4f6;
            color: #374151;
            cursor: not-allowed;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>🚗 Kendaraan Masuk</h2>

    <p>
        Silakan isi data kendaraan yang masuk.
    </p>


    <form action="../controller/c_data.php" method="POST">


        <!-- KENDARAAN -->

        <label>Kendaraan</label>

        <select name="id_kendaraan" required>

            <option value="">
                -- Pilih Kendaraan --
            </option>

            <?php while ($data = mysqli_fetch_assoc($kendaraan)) { ?>

                <option value="<?= $data['id_kendaraan']; ?>">

                    <?= htmlspecialchars($data['plat_nomer']); ?>

                    -

                    <?= htmlspecialchars($data['jenis_kendaraan']); ?>

                </option>

            <?php } ?>

        </select>


        <!-- AREA PARKIR -->

        <label>Area Parkir</label>

        <select name="id_area" required>

            <option value="">
                -- Pilih Area --
            </option>

            <?php while ($data = mysqli_fetch_assoc($area)) { ?>

                <option value="<?= $data['id_area']; ?>">

                    <?= htmlspecialchars(
                        $data['nama_area'] ?? $data['id_area']
                    ); ?>

                </option>

            <?php } ?>

        </select>


        <!-- WAKTU MASUK -->

        <label>Waktu Masuk</label>

        <input
            type="datetime-local"
            id="waktu_masuk"
            name="waktu_masuk"
            readonly
            required
        >


        <!-- TOMBOL -->

        <button
            type="submit"
            name="kendaraan_masuk"
        >
            Simpan Kendaraan Masuk
        </button>


    </form>

</div>


<script>

/*
|--------------------------------------------------------------------------
| WAKTU OTOMATIS WIB
|--------------------------------------------------------------------------
*/

function updateWaktu() {

    const sekarang = new Date();

    const tahun =
        sekarang.getFullYear();

    const bulan =
        String(sekarang.getMonth() + 1)
        .padStart(2, '0');

    const tanggal =
        String(sekarang.getDate())
        .padStart(2, '0');

    const jam =
        String(sekarang.getHours())
        .padStart(2, '0');

    const menit =
        String(sekarang.getMinutes())
        .padStart(2, '0');


    document.getElementById('waktu_masuk').value =
        `${tahun}-${bulan}-${tanggal}T${jam}:${menit}`;
}


/* Jalankan pertama kali */

updateWaktu();


/* Update setiap detik */

setInterval(updateWaktu, 1000);

</script>


</body>

</html>