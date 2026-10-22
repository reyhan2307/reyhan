<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah User - Parkirss</title>

    <link rel="stylesheet" href="../assets/kelola_user.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #333;
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 35px 45px;
            min-height: 100vh;
        }

        /* HEADER */
        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 7px;
            font-size: 28px;
            color: #222;
        }

        .header p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        /* FORM CARD */
        .form-container {
            width: 100%;
            max-width: 650px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.07);
        }

        .form-title {
            margin-bottom: 25px;
        }

        .form-title h2 {
            margin: 0 0 5px;
            font-size: 20px;
            color: #222;
        }

        .form-title p {
            margin: 0;
            font-size: 13px;
            color: #888;
        }

        /* FORM GROUP */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
            outline: none;
            transition: 0.2s;
        }

        .form-group input::placeholder {
            color: #aaa;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.10);
        }

        /* BUTTON */
        .form-action {
            display: flex;
            gap: 10px;
            margin-top: 28px;
        }

        .btn-simpan {
            border: none;
            background: #22c55e;
            color: white;
            padding: 12px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-simpan:hover {
            background: #16a34a;
        }

        .btn-kembali {
            display: inline-block;
            background: #e5e7eb;
            color: #333;
            padding: 12px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-kembali:hover {
            background: #d1d5db;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

            .content {
                margin-left: 0;
                padding: 25px 20px;
            }

            .form-container {
                max-width: 100%;
                padding: 25px;
            }

            .header h1 {
                font-size: 24px;
            }

            .form-action {
                flex-direction: column;
            }

            .btn-simpan,
            .btn-kembali {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        

        <div>
            <h2>Parkir</h2>

        </div>
    </div>

    <ul class="menu">

        <li>
            <a href="dashboard.php">
                Dashboard
            </a>
        </li>

        <li>
            <a href="kelola_user.php" class="active">
                Kelola User
            </a>
        </li>

        <li>
            <a href="tarif_parkir.php">
                Tarif Parkir
            </a>
        </li>

        <li>
            <a href="area_parkir.php">
                Area Parkir
            </a>
        </li>

        <li>
            <a href="kendaraan.php">
                Kendaraan
            </a>
        </li>

        <li>
            <a href="log_aktivitas.php">
                Log Aktivitas
            </a>
        </li>

    </ul>

</div>


<!-- CONTENT -->
<div class="content">

    <div class="header">
        <h1>Tambah User</h1>
        <p>Tambahkan pengguna baru ke dalam sistem Parkirss</p>
    </div>


    <div class="form-container">

        <div class="form-title">
            <h2>Data User</h2>
            <p>Silakan isi data pengguna dengan lengkap</p>
        </div>


        <form action="../controller/c_data.php" method="POST">

            <input type="hidden" name="tambah_user" value="1">


            <!-- NAMA LENGKAP -->
            <div class="form-group">

                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="nama_lengkap"
                    placeholder="Masukkan nama lengkap"
                    required
                >

            </div>


            <!-- USERNAME -->
            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                >

            </div>


            <!-- PASSWORD -->
            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <!-- ROLE -->
            <div class="form-group">

                <label>Role</label>

                <select name="role" required>

                    <option value="">
                        -- Pilih Role --
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                    <option value="petugas">
                        Petugas
                    </option>

                    <option value="owner">
                        Owner
                    </option>

                </select>

            </div>


            <!-- BUTTON -->
            <div class="form-action">

                <button
                    type="submit"
                    class="btn-simpan"
                >
                    ✓ Simpan User
                </button>

                <a
                    href="kelola_user.php"
                    class="btn-kembali"
                >
                    ← Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>