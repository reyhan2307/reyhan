<?php
ob_start();
session_start();

include_once __DIR__ . "/../model/m_koneksi.php";

$query = mysqli_query($conn, "
    SELECT 
        t.id_parkir,
        t.waktu_masuk,
        k.plat_nomer,
        k.jenis_kendaraan,
        k.penilik
    FROM tb_transaksi t
    INNER JOIN tb_kendaraan k
        ON t.id_kendaraan = k.id_kendaraan
    WHERE t.status = 'masuk'
    ORDER BY t.waktu_masuk ASC
");

if (!$query) {
    die("Gagal mengambil data: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kendaraan Keluar - ParkirKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            min-height: 100vh;
            padding: 30px;
            color: #1f2937;
        }

        .container {
            max-width: 1100px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.10);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .header h2 {
            color: #047857;
            font-size: 27px;
            margin-bottom: 6px;
        }

        .header p {
            color: #6b7280;
            font-size: 14px;
        }

        .btn-kembali {
            text-decoration: none;
            background: #e5e7eb;
            color: #374151;
            padding: 11px 17px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-kembali:hover {
            background: #d1d5db;
        }

        .table-box {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th {
            background: #047857;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 13px;
        }

        th:first-child {
            border-radius: 10px 0 0 0;
        }

        th:last-child {
            border-radius: 0 10px 0 0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        tr:hover td {
            background: #ecfdf5;
        }

        .plat {
            font-weight: bold;
            color: #047857;
        }

        .btn-keluar {
            display: inline-block;
            padding: 10px 14px;
            background: #059669;
            color: white;
            text-decoration: none;
            border-radius: 9px;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-keluar:hover {
            background: #065f46;
            transform: translateY(-2px);
        }

        .kosong {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 11px;
            font-weight: bold;
        }

        @media (max-width: 600px) {

            body {
                padding: 15px;
            }

            .container {
                padding: 20px;
                margin: 10px auto;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h2 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h2>🚗 Kendaraan Keluar</h2>
            <p>Daftar kendaraan yang masih berada di area parkir.</p>
        </div>

        <a href="dashboard_petugas.php" class="btn-kembali">
            ← Kembali
        </a>

    </div>

    <div class="table-box">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Jenis Kendaraan</th>
                    <th>Penilik</th>
                    <th>Waktu Masuk</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php

            $no = 1;

            if (mysqli_num_rows($query) > 0) {

                while ($data = mysqli_fetch_assoc($query)) {

            ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td>
                        <span class="plat">
                            <?= htmlspecialchars($data['plat_nomer']); ?>
                        </span>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['jenis_kendaraan']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['penilik']); ?>
                    </td>

                    <td>
                        <?= date(
                            'd-m-Y H:i',
                            strtotime($data['waktu_masuk'])
                        ); ?>
                    </td>

                    <td>
                        <span class="status">
                            MASIH PARKIR
                        </span>
                    </td>

                    <td>

                        <a
                            href="../controller/c_data.php?kendaraan_keluar=<?= $data['id_parkir']; ?>"
                            class="btn-keluar"
                            onclick="return confirm('Yakin kendaraan ini keluar?')"
                        >
                            Kendaraan Keluar
                        </a>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>
                    <td colspan="7" class="kosong">
                        🚗 Tidak ada kendaraan yang sedang parkir.
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>