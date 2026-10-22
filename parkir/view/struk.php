<?php

include_once __DIR__ . "/../model/m_koneksi.php";

if (!isset($_GET['id_parkir'])) {
    die("ID parkir tidak ditemukan.");
}

$id_parkir = intval($_GET['id_parkir']);

$query = mysqli_query($conn, "
    SELECT
        t.id_parkir,
        t.waktu_masuk,
        t.waktu_keluar,
        t.durasi_jam,
        t.biaya_total,
        k.plat_nomer,
        k.jenis_kendaraan,
        k.penilik
    FROM tb_transaksi t
    INNER JOIN tb_kendaraan k
        ON t.id_kendaraan = k.id_kendaraan
    WHERE t.id_parkir = $id_parkir
    LIMIT 1
");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

if (mysqli_num_rows($query) == 0) {
    die("Data transaksi tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>

    <style>
        body {
            font-family: Arial;
            background: #eee;
        }

        .struk {
            width: 300px;
            margin: 30px auto;
            padding: 20px;
            background: white;
        }

        h2, p {
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 10px;
            background: green;
            color: white;
            border: 0;
            cursor: pointer;
        }

        @media print {
            button {
                display: none;
            }

            body {
                background: white;
            }
        }
    </style>
</head>

<body>

<div class="struk">

    <h2>PARKIRKU</h2>
    <p>STRUK PARKIR</p>

    <hr>

    <div class="row">
        <span>ID Parkir</span>
        <span><?= $data['id_parkir']; ?></span>
    </div>

    <div class="row">
        <span>Plat</span>
        <span><?= htmlspecialchars($data['plat_nomer']); ?></span>
    </div>

    <div class="row">
        <span>Kendaraan</span>
        <span><?= htmlspecialchars($data['jenis_kendaraan']); ?></span>
    </div>

    <div class="row">
        <span>Penilik</span>
        <span><?= htmlspecialchars($data['penilik']); ?></span>
    </div>

    <hr>

    <div class="row">
        <span>Masuk</span>
        <span><?= $data['waktu_masuk']; ?></span>
    </div>

    <div class="row">
        <span>Keluar</span>
        <span><?= $data['waktu_keluar']; ?></span>
    </div>

    <div class="row">
        <span>Durasi</span>
        <span><?= $data['durasi_jam']; ?> jam</span>
    </div>

    <hr>

    <div class="row total">
        <span>TOTAL</span>
        <span>
            Rp <?= number_format($data['biaya_total'], 0, ',', '.'); ?>
        </span>
    </div>

    <hr>

    <p>Terima kasih</p>

    <button onclick="window.print()">
        🖨 Cetak
    </button>

</div>

</body>
</html>