<?php
session_start();

include_once __DIR__ . "/../model/m_koneksi.php";

// Pastikan form login dikirim
if (!isset($_POST['login'])) {
    header("Location: ../view/login.php");
    exit;
}

// Ambil input
$username = mysqli_real_escape_string(
    $conn,
    trim($_POST['username'] ?? '')
);

$password = $_POST['password'] ?? '';

// Cek username
$query = mysqli_query($conn, "
    SELECT *
    FROM tb_user
    WHERE username = '$username'
    LIMIT 1
");

if (!$query) {
    die("Gagal login: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($query);

// Username tidak ditemukan atau password salah
if (
    !$user ||
    $password !== (string) $user['password']
) {
    echo "<script>
        alert('Username atau password salah!');
        window.location.href = '../view/login.php';
    </script>";
    exit;
}

// Cek status akun jika kolom tersedia
if (
    isset($user['status_aktif']) &&
    (int) $user['status_aktif'] !== 1
) {
    echo "<script>
        alert('Akun kamu sedang tidak aktif!');
        window.location.href = '../view/login.php';
    </script>";
    exit;
}

// Simpan session
session_regenerate_id(true);

$_SESSION['id_user'] = $user['id_user'];
$_SESSION['nama_lengkap'] = $user['nama_lengkap'];
$_SESSION['role'] = $user['role'];

// Redirect sesuai role
if ($user['role'] === 'admin') {

    header("Location: ../view/dashboard.php");
    exit;

} elseif ($user['role'] === 'petugas') {

    header("Location: ../view/dashboard_petugas.php");
    exit;

} elseif ($user['role'] === 'owner') {

    header("Location: ../view/dashboard_owner.php");
    exit;

} else {

    session_unset();
    session_destroy();

    die("Role user tidak dikenali.");
}
