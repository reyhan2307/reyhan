<?php
ob_start();
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 'owner') {
    die("Akses ditolak.");
}

include_once __DIR__ . "/../model/m_koneksi.php";

/* TANGGAL */
$tanggal_awal = isset($_GET['tanggal_awal'])
    ? $_GET['tanggal_awal']
    : date('Y-m-01');

$tanggal_akhir = isset($_GET['tanggal_akhir'])
    ? $_GET['tanggal_akhir']
    : date('Y-m-d');

/* REKAP TRANSAKSI */
$query = mysqli_query($conn, "
    SELECT
        t.id_parkir,
        k.plat_nomer,
        k.jenis_kendaraan,
        k.penilik,
        t.waktu_masuk,
        t.waktu_keluar,
        t.durasi_jam,
        t.biaya_total,
        t.status
    FROM tb_transaksi t
    LEFT JOIN tb_kendaraan k
        ON t.id_kendaraan = k.id_kendaraan
    WHERE DATE(t.waktu_masuk)
        BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
    ORDER BY t.waktu_masuk DESC
");

if (!$query) {
    die("Gagal mengambil data: " . mysqli_error($conn));
}

/* STATISTIK */
$total_transaksi = 0;
$total_pendapatan = 0;
$total_masuk = 0;
$total_keluar = 0;

$data_transaksi = [];

while ($data = mysqli_fetch_assoc($query)) {

    $data_transaksi[] = $data;

    $total_transaksi++;

    $total_pendapatan += (float) $data['biaya_total'];

    if ($data['status'] == 'masuk') {
        $total_masuk++;
    }

    if ($data['status'] == 'keluar') {
        $total_keluar++;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rekap Transaksi - ParkirKu</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0fdf4;
            color: #374151;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        .header h1 {
            color: #047857;
            margin-bottom: 7px;
        }

        .header p {
            color: #6b7280;
        }

        .filter {
            background: white;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        .filter form {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        button {
            padding: 11px 20px;
            border: none;
            border-radius: 8px;
            background: #059669;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #047857;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,.07);
        }

        .card span {
            color: #6b7280;
            font-size: 14px;
        }

        .card h2 {
            color: #047857;
            margin-top: 8px;
        }

        .table-box {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
            overflow-x: auto;
        }

        .table-box h2 {
            color: #047857;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            background: #059669;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover {
            background: #f0fdf4;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .masuk {
            background: #fef3c7;
            color: #92400e;
        }

        .keluar {
            background: #d1fae5;
            color: #065f46;
        }

        .back {
            display: inline-block;
            margin-bottom: 15px;
            color: #047857;
            text-decoration: none;
            font-weight: bold;
        }

        @media(max-width: 800px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 500px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="dashboard_owner.php" class="back">
        ← Kembali ke Dashboard Owner
    </a>

    <div class="header">
        <h1>📊 Rekap Transaksi</h1>
        <p>Laporan transaksi parkir berdasarkan periode tanggal.</p>
    </div>

    <!-- FILTER -->
    <div class="filter">

        <form method="GET">

            <div class="form-group">
                <label>Tanggal Awal</label>
                <input
                    type="date"
                    name="tanggal_awal"
                    value="<?= htmlspecialchars($tanggal_awal); ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Tanggal Akhir</label>
                <input
                    type="date"
                    name="tanggal_akhir"
                    value="<?= htmlspecialchars($tanggal_akhir); ?>"
                    required
                >
            </div>

            <button type="submit">
                🔍 Tampilkan Rekap
            </button>

        </form>

    </div>

    <!-- STATISTIK -->
    <div class="cards">

        <div class="card">
            <span>Total Transaksi</span>
            <h2><?= $total_transaksi; ?></h2>
        </div>

        <div class="card">
            <span>Kendaraan Masuk</span>
            <h2><?= $total_masuk; ?></h2>
        </div>

        <div class="card">
            <span>Kendaraan Keluar</span>
            <h2><?= $total_keluar; ?></h2>
        </div>

        <div class="card">
            <span>Total Pendapatan</span>
            <h2>
                Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?>
            </h2>
        </div>

    </div>

    <!-- TABEL -->
    <div class="table-box">

        <h2>Detail Transaksi</h2>

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Penilik</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Durasi</th>
                    <th>Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php if (count($data_transaksi) > 0) { ?>

                <?php $no = 1; ?>

                <?php foreach ($data_transaksi as $data) { ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td>
                            <?= htmlspecialchars($data['plat_nomer'] ?? '-'); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['jenis_kendaraan'] ?? '-'); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($data['penilik'] ?? '-'); ?>
                        </td>

                        <td>
                            <?= $data['waktu_masuk'] ?? '-'; ?>
                        </td>

                        <td>
                            <?= $data['waktu_keluar'] ?? '-'; ?>
                        </td>

                        <td>
                            <?= $data['durasi_jam'] ?? '-'; ?> jam
                        </td>

                        <td>
                            Rp <?= number_format((float)$data['biaya_total'], 0, ',', '.'); ?>
                        </td>

                        <td>
                            <span class="status <?= $data['status'] == 'masuk' ? 'masuk' : 'keluar'; ?>">
                                <?= ucfirst($data['status']); ?>
                            </span>
                        </td>

                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="9" style="text-align:center;">
                        Tidak ada transaksi pada periode tersebut.
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>