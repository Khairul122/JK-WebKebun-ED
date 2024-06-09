<?php
include '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $tgl_terima = $_POST['tgl_terima'];
    $tgl_dikirim = $_POST['tgl_dikirim'];
    $no_spb = $_POST['no_spb'];
    $netto_kebun = $_POST['netto_kebun'];
    $alb = $_POST['alb'];
    $kadar_air = $_POST['kadar_air'];

    // Buat query untuk memasukkan data nettosawit
    $query = "INSERT INTO tbl_nettosawit (tgl_terima, tgl_dikirim, no_spb, netto_kebun, alb, kadar_air) VALUES ('$tgl_terima', '$tgl_dikirim', '$no_spb', '$netto_kebun', '$alb', '$kadar_air')";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 second.
        </div>
        <meta http-equiv='refresh' content='1; url= keluar.php'/>";  // Ubah URL redirect sesuai kebutuhan
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 second.
        </div>
        <meta http-equiv='refresh' content='1; url= keluar.php'/>";  // Ubah URL redirect sesuai kebutuhan
    }
} else {
    // Jika bukan POST request, redirect ke halaman form atau tampilkan pesan error
    header("Location: keluar.php"); // Ubah sesuai halaman form
    exit();
}
?>
