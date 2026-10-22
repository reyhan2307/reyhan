<?php
ob_start();
session_start();

include_once __DIR__ . "/../model/m_koneksi.php";

$query = mysqli_query($conn, "
    SELECT
        t.id_parkir,
        t.id_kendaraan,
        t.waktu_masuk,
        t.waktu_keluar,
        t.durasi_jam,
        t.biaya_total,
        t.status,
        k.plat_nomer,
        k.jenis_kendaraan,
        k.penilik
    FROM tb_transaksi t
    INNER JOIN tb_kendaraan k
        ON t.id_kendaraan = k.id_kendaraan
    ORDER BY t.waktu_masuk DESC
");

if (!$query) {
    die("Gagal mengambil riwayat transaksi: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Transaksi - ParkirKu</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            min-height: 100vh;
            padding: 30px;
            color: #1f2937;
        }

        .container {
            max-width: 1150px;
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
            gap: 15px;
            margin-bottom: 25px;
        }

        .header h2 {
            color: #2563eb;
            font-size: 27px;
            margin-bottom: 7px;
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
            min-width: 1000px;
            border-collapse: collapse;
        }

        th {
            background: #059830;
            color: white;
            padding: 14px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        tr:hover td {
            background: #eff6ff;
        }

        .plat {
            font-weight: bold;
            color: #1d4ed8;
        }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-masuk {
            background: #fef3c7;
            color: #92400e;
        }

        .status-keluar {
            background: #dcfce7;
            color: #166534;
        }

        .biaya {
            font-weight: bold;
            color: #047857;
        }

        .kosong {
            text-align: center;
            padding: 40px;
            color: #6b7280;
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
            <h2>📋 Riwayat Transaksi</h2>

            <p>
                Daftar seluruh transaksi kendaraan parkir.
            </p>
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

                    <th>Waktu Keluar</th>

                    <th>Durasi</th>

                    <th>Biaya</th>

                    <th>Status</th>

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

                            <?= htmlspecialchars(
                                $data['plat_nomer']
                            ); ?>

                        </span>

                    </td>


                    <td>

                        <?= htmlspecialchars(
                            $data['jenis_kendaraan']
                        ); ?>

                    </td>


                    <td>

                        <?= htmlspecialchars(
                            $data['penilik']
                        ); ?>

                    </td>


                    <td>

                        <?= date(
                            'd-m-Y H:i',
                            strtotime($data['waktu_masuk'])
                        ); ?>

                    </td>


                    <td>

                        <?php

                        if (!empty($data['waktu_keluar'])) {

                            echo date(
                                'd-m-Y H:i',
                                strtotime($data['waktu_keluar'])
                            );

                        } else {

                            echo "-";

                        }

                        ?>

                    </td>


                    <td>

                        <?php

                        if (
                            $data['durasi_jam'] !== null &&
                            $data['durasi_jam'] !== ''
                        ) {

                            echo $data['durasi_jam'] . " jam";

                        } else {

                            echo "-";

                        }

                        ?>

                    </td>


                    <td>

                        <span class="biaya">

                            Rp <?= number_format(
                                $data['biaya_total'],
                                0,
                                ',',
                                '.'
                            ); ?>

                        </span>

                    </td>


                    <td>

                        <?php

                        if ($data['status'] == 'keluar') {

                        ?>

                            <span class="status status-keluar">
                                KELUAR
                            </span>

                        <?php

                        } else {

                        ?>

                            <span class="status status-masuk">
                                MASUK
                            </span>

                        <?php

                        }

                        ?>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td
                        colspan="9"
                        class="kosong"
                    >

                        📋 Belum ada riwayat transaksi.

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>