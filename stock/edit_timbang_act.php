<?php
include '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = $_POST['id'];
    $penyusutan = $_POST['penyusutan'];
    $netto_kebun = $_POST['netto_kebun'];
    $netto_ppl = $_POST['netto_ppl'];

    // Buat query untuk mengupdate data timbang
    $query = "UPDATE tbl_timbang SET penyusutan = '$penyusutan', netto_kebun = '$netto_kebun', netto_ppl = '$netto_ppl' WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 second.
        </div>
        <meta http-equiv='refresh' content='1; url= masuk.php'/>";  // Ubah URL redirect sesuai kebutuhan
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 second.
        </div>
        <meta http-equiv='refresh' content='1; url= masuk.php'/>";  // Ubah URL redirect sesuai kebutuhan
    }
} else {
    // Jika bukan POST request, redirect ke halaman form atau tampilkan pesan error
    header("Location: masuk.php"); // Ubah sesuai halaman form
    exit();
}
?>
