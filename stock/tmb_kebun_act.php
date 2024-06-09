<?php 
include '../dbconnect.php';

$kode_kebun = $_POST['kode_kebun'];
$nama_kebun = $_POST['nama_kebun'];

$query = mysqli_query($conn, "INSERT INTO tbl_kebun (kode_kebun, nama_kebun) VALUES ('$kode_kebun', '$nama_kebun')");

if ($query){
    echo "<div class='alert alert-success'>
        <strong>Success!</strong> Redirecting you back in 1 second.
    </div>
    <meta http-equiv='refresh' content='1; url= stock.php'/>";  // Ubah URL redirect sesuai kebutuhan
} else {
    echo "<div class='alert alert-warning'>
        <strong>Failed!</strong> Redirecting you back in 1 second.
    </div>
    <meta http-equiv='refresh' content='1; url= kebun.php'/>";  // Ubah URL redirect sesuai kebutuhan
}
?>

<html>
<head>
  <title>Tambah Kebun</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- Tambahkan form atau konten lain yang diperlukan di sini -->
</body>
</html>
