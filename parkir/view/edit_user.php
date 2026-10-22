
<?php
include_once __DIR__ . "/../model/m_koneksi.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID user tidak valid.");
}

$id = (int) $_GET['id'];

$query = mysqli_query($conn, "
    SELECT id_user, nama_lengkap, username, role
    FROM tb_user
    WHERE id_user = $id
    LIMIT 1
");

if (!$query) {
    die("Gagal mengambil data user: " . mysqli_error($conn));
}

if (mysqli_num_rows($query) == 0) {
    die("User tidak ditemukan.");
}

$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - ParkirKu</title>
    <link rel="stylesheet" href="../assets/edit_user.css">
</head>
<body>

<div class="page">

    <div class="topbar">
        <a href="kelola_user.php" class="back">← Kembali</a>
        <span class="brand">PARKIRKU</span>
    </div>

    <div class="form-card">

        <div class="form-heading">
            <div class="icon">✎</div>
            <div>
                <h1>Edit User</h1>
                <p>Perbarui informasi akun pengguna ParkirKu.</p>
            </div>
        </div>

        <div class="user-info">
            <div class="avatar">
                <?= strtoupper(substr($user['nama_lengkap'], 0, 1)); ?>
            </div>
            <div>
                <strong><?= htmlspecialchars($user['nama_lengkap']); ?></strong>
                <p>ID Pengguna: <?= $user['id_user']; ?></p>
            </div>
        </div>

        <form action="../controller/c_data.php" method="POST">

            <input type="hidden" name="id_user"
                   value="<?= $user['id_user']; ?>">

            <div class="field">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input
                    type="text"
                    id="nama_lengkap"
                    name="nama_lengkap"
                    value="<?= htmlspecialchars($user['nama_lengkap']); ?>"
                    placeholder="Masukkan nama lengkap"
                    required>
            </div>

            <div class="field">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= htmlspecialchars($user['username']); ?>"
                    placeholder="Masukkan username"
                    required>
            </div>

            <div class="field">
                <label for="role">Role Pengguna</label>
                <select id="role" name="role" required>
                    <option value="admin"
                        <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>
                        Admin
                    </option>
                    <option value="petugas"
                        <?= $user['role'] == 'petugas' ? 'selected' : ''; ?>>
                        Petugas
                    </option>
                    <option value="owner"
                        <?= $user['role'] == 'owner' ? 'selected' : ''; ?>>
                        Owner
                    </option>
                </select>
            </div>

            <div class="note">
                <span>ⓘ</span>
                <p>Password tidak diubah pada halaman ini.</p>
            </div>

            <div class="actions">
                <a href="kelola_user.php" class="btn-cancel">
                    Batal
                </a>

                <button type="submit" name="edit_user" class="btn-save">
                    ✓ Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

    <p class="footer">© ParkirKu · Parking Management System</p>

</div>

</body>
</html>
