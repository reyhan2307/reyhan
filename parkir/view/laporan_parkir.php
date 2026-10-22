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

$tanggal_awal = $_GET['tanggal_awal'] ?? date('Y-m-01');
$tanggal_akhir = $_GET['tanggal_akhir'] ?? date('Y-m-d');

$tanggal_awal = mysqli_real_escape_string($conn, $tanggal_awal);
$tanggal_akhir = mysqli_real_escape_string($conn, $tanggal_akhir);

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
    die("Gagal mengambil laporan: " . mysqli_error($conn));
}

$total_transaksi = 0;
$total_pendapatan = 0;

$data_laporan = [];

while ($data = mysqli_fetch_assoc($query)) {

    $data_laporan[] = $data;

    $total_transaksi++;

    $total_pendapatan += (float) $data['biaya_total'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Parkir - ParkirKu</title>

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
            max-width: 1250px;
            margin: auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        .header h1 {
            color: #047857;
            margin-bottom: 8px;
        }

        .header p {
            color: #6b7280;
        }

        .filter {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        .filter form {
            display: flex;
            align-items: end;
            gap: 15px;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group label {
            font-weight: bold;
        }

        input[type="date"] {
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        button,
        .btn {
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            color: white;
            background: #059669;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        button:hover,
        .btn:hover {
            background: #047857;
        }

        .btn-print {
            background: #2563eb;
        }

        .btn-print:hover {
            background: #1d4ed8;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.07);
        }

        .card span {
            color: #6b7280;
        }

        .card h2 {
            margin-top: 8px;
            color: #047857;
        }

        .table-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .table-header h2 {
            color: #047857;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th {
            background: #059669;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 11px;
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

        @media print {

            body {
                background: white;
                padding: 0;
            }

            .filter,
            .back,
            .btn-print {
                display: none;
            }

            .header,
            .card,
            .table-box {
                box-shadow: none;
            }

            .container {
                max-width: none;
            }
        }

        @media(max-width: 600px) {
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

        <h1>📄 Laporan Parkir</h1>

        <p>
            Laporan transaksi parkir berdasarkan periode tanggal.
        </p>

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
                🔍 Tampilkan
            </button>


            <button
                type="button"
                class="btn-print"
                onclick="window.print()"
            >
                🖨️ Cetak Laporan
            </button>

        </form>

    </div>


    <!-- RINGKASAN -->

    <div class="cards">

        <div class="card">

            <span>Total Transaksi</span>

            <h2>
                <?= $total_transaksi; ?>
            </h2>

        </div>


        <div class="card">

            <span>Total Pendapatan</span>

            <h2>
                Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?>
            </h2>

        </div>

    </div>


    <!-- TABEL LAPORAN -->

    <div class="table-box">

        <div class="table-header">

            <h2>Detail Laporan Parkir</h2>

        </div>


        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Plat Nomor</th>

                    <th>Jenis Kendaraan</th>

                    <th>Penilik</th>

                    <th>Waktu Masuk</th>

                    <th>Waktu Keluar</th>

                    <th>Durasi</th>

                    <th>Biaya</th>

                    <th>Status</th>

                </tr>

            </thead>


            <tbody>

            <?php if (count($data_laporan) > 0) { ?>

                <?php $no = 1; ?>

                <?php foreach ($data_laporan as $data) { ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

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
                            Rp <?= number_format(
                                (float)$data['biaya_total'],
                                0,
                                ',',
                                '.'
                            ); ?>
                        </td>

                        <td>

                            <span class="status <?= 
                                $data['status'] == 'masuk'
                                ? 'masuk'
                                : 'keluar'
                            ?>">

                                <?= ucfirst($data['status']); ?>

                            </span>

                        </td>

                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>

                    <td colspan="9" style="text-align:center; padding:25px;">

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