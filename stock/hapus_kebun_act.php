<?php
include '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = $_POST['id'];

    // Buat query untuk menghapus data kebun
    $query = "DELETE FROM tbl_kebun WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 second.
        </div>
        <meta http-equiv='refresh' content='1; url= stock.php'/>";  // Ubah URL redirect sesuai kebutuhan
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 second.
        </div>
        <meta http-equiv='refresh' content='1; url= stock.php'/>";  // Ubah URL redirect sesuai kebutuhan
    }
} else {
    // Jika bukan POST request, redirect ke halaman form atau tampilkan pesan error
    header("Location: stock.php"); // Ubah sesuai halaman form
    exit();
}
?>
