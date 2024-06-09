<?php 
include 'cek.php';
include '../dbconnect.php';

function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
     
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Data Stock Kebun">
    <meta name="author" content="">
    <title>Data Stock Kebun</title>
    <link rel="icon" type="image/png" href="favicon.png">

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/new/offline-font.css" rel="stylesheet">
    <link href="../assets/new/custom-report.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../assets/new/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <section id="header-kop">
        <div class="container-fluid">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td rowspan="3" width="16%" class="text-center">
                            <img src="../logo1.png" alt="logo" width="110px" height="110px" />
                        </td>
                        <td class="text-center">
                            <h3 style="margin-top: 10px; font-size:38px">PMKS Kebun Tanjung Kasau</h3>
                        </td>
                        <td rowspan="3" width="16%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-center" style="font-size: larger;">Perkebunan Tj. Kasau, Kec. Sei Suka, Kabupaten Batu Bara, Sumatera Utara</td>
                    </tr>
                </tbody>
            </table>
            <hr class="line-top" />
        </div>
    </section>

    <section id="body-of-report">
        <div class="container-fluid">
            <h4 class="text-center">Laporan Data Kebun</h4>
            <br />
            <table id="dataTable3" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Kode Kebun</th>
                        <th>Nama Kebun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $kebuns = mysqli_query($conn, "SELECT * from tbl_kebun order by nama_kebun ASC");
                    $no = 1;
                    while ($p = mysqli_fetch_array($kebuns)) {
                    ?>
                        <tr align="center">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $p['kode_kebun'] ?></td>
                            <td><?php echo $p['nama_kebun'] ?></td>
                        </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            <div style="text-align:right;margin-right:50px;">
                <p style="padding-right: 145px;">Batu Bara, <?php echo tgl_indo(date('Y-m-d')); ?></p>
                <p style="padding-right: 100px;">Manajer PMKS Tanjung Kasau</p>
                <br><br><br>
                <p style="padding-right: 250px;">Manajer</p>
            </div>
        </div><!-- /.container -->
    </section>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable3').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                   'copy', 'csv', 'excel', 'pdf', 'print',
                ]
            } );

            // Fungsi untuk mengunduh PDF
            $('#download-pdf').click(function () {
                var element = document.getElementById('report-content');
                html2pdf(element, {
                    margin:       1,
                    filename:     'Laporan_Data_Kebun.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                });
            });
        });
    </script>
</body>

</html>
