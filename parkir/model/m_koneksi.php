<?php
$server   = "sql305.infinityfree.com";
$username = "if0_43233460";
$password = "p86JFQ9ynjrIq"; // kalau tanpa password isi ""
$database = "parkir";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// else {
//     echo "Koneksi berhasil";
// }
?>