<?php
include_once __DIR__ . "/../model/m_koneksi.php";

/* =========================
   EDIT USER
========================= */

if (isset($_POST['edit'])) {

    $id = intval($_POST['id_user']);

    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $status = intval($_POST['status_aktif']);

    $sql = "UPDATE tb_user SET
                nama_lengkap = '$nama',
                username = '$username',
                password = '$password',
                role = '$role',
                status_aktif = $status
            WHERE id_user = $id";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("Gagal mengedit user: " . mysqli_error($conn));
    }

    header("Location: ../view/kelola_user.php");
    exit;
}


/* =========================
   HAPUS USER
========================= */

if (isset($_GET['hapus'])) {

    $id = intval($_GET['hapus']);

    mysqli_begin_transaction($conn);

    try {

        // hapus transaksi user
        $query = mysqli_query(
            $conn,
            "DELETE FROM tb_transaksi WHERE id_user = $id"
        );

        if (!$query) {
            throw new Exception(mysqli_error($conn));
        }

        // hapus log aktivitas user
        $query = mysqli_query(
            $conn,
            "DELETE FROM tb_log_aktivitas WHERE id_user = $id"
        );

        if (!$query) {
            throw new Exception(mysqli_error($conn));
        }

        // hapus user
        $query = mysqli_query(
            $conn,
            "DELETE FROM tb_user WHERE id_user = $id"
        );

        if (!$query) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);

        header("Location: ../view/kelola_user.php");
        exit;

    } catch (Exception $e) {

        mysqli_rollback($conn);

        die("Gagal menghapus user: " . $e->getMessage());
    }
}
  /* TAMBAH TARIF */
if (isset($_POST['tambah_tarif'])) {

    $jenis = mysqli_real_escape_string(
        $conn,
        $_POST['jenis_kendaraan']
    );

    $tarif = intval($_POST['tarif_per_jam']);

    // Cek apakah jenis kendaraan sudah memiliki tarif
    $cek = mysqli_query(
        $conn,
        "SELECT id_tarif FROM tb_tarif
         WHERE jenis_kendaraan = '$jenis'"
    );

    if (mysqli_num_rows($cek) > 0) {
        die("Tarif untuk jenis kendaraan tersebut sudah tersedia.");
    }

    $sql = "INSERT INTO tb_tarif
            (jenis_kendaraan, tarif_per_jam)
            VALUES
            ('$jenis', $tarif)";

    if (!mysqli_query($conn, $sql)) {
        die("Gagal menambahkan tarif: " . mysqli_error($conn));
    }

    header("Location: ../view/tarif_parkir.php");
    exit;
}
?>