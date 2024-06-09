<!doctype html>
<html class="no-js" lang="en">

<?php
include '../dbconnect.php';
include 'cek.php';

if (isset($_POST['update'])) {
    $id = $_POST['id']; //iddata
    $idx = $_POST['idx']; //idbarang
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];

    $lihatstock = mysqli_query($conn, "select * from sstock_brg where idx='$idx'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock']; //jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn, "select * from sbrg_masuk where id='$id'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg);
    $qtyskrg = $preqtyskrg['jumlah']; //jumlah skrg

    if ($jumlah >= $qtyskrg) {
        //ternyata inputan baru lebih besar jumlah masuknya, maka tambahi lagi stock barang
        $hitungselisih = $jumlah - $qtyskrg;
        $tambahistock = $stockskrg + $hitungselisih;

        $queryx = mysqli_query($conn, "update sstock_brg set stock='$tambahistock' where idx='$idx'");
        $updatedata1 = mysqli_query($conn, "update sbrg_masuk set tgl='$tanggal',jumlah='$jumlah',keterangan='$keterangan' where id='$id'");

        //cek apakah berhasil
        if ($updatedata1 && $queryx) {

            echo " <div class='alert alert-success'>
                    <strong>Success!</strong> Redirecting you back in 1 seconds.
                </div>
                <meta http-equiv='refresh' content='1; url= masuk.php'/>  ";
        } else {
            echo "<div class='alert alert-warning'>
                    <strong>Failed!</strong> Redirecting you back in 3 seconds.
                </div>
                <meta http-equiv='refresh' content='3; url= masuk.php'/> ";
        };
    } else {
        //ternyata inputan baru lebih kecil jumlah masuknya, maka kurangi lagi stock barang
        $hitungselisih = $qtyskrg - $jumlah;
        $kurangistock = $stockskrg - $hitungselisih;

        $query1 = mysqli_query($conn, "update sstock_brg set stock='$kurangistock' where idx='$idx'");

        $updatedata = mysqli_query($conn, "update sbrg_masuk set tgl='$tanggal', jumlah='$jumlah', keterangan='$keterangan' where id='$id'");

        //cek apakah berhasil
        if ($query1 && $updatedata) {

            echo " <div class='alert alert-success'>
                    <strong>Success!</strong> Redirecting you back in 1 seconds.
                </div>
                <meta http-equiv='refresh' content='1; url= masuk.php'/>  ";
        } else {
            echo "<div class='alert alert-warning'>
                    <strong>Failed!</strong> Redirecting you back in 3 seconds.
                </div>
                <meta http-equiv='refresh' content='3; url= masuk.php'/> ";
        };
    };
};

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $idx = $_POST['idx'];

    $lihatstock = mysqli_query($conn, "select * from sstock_brg where idx='$idx'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock']; //jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn, "select * from sbrg_masuk where id='$id'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg);
    $qtyskrg = $preqtyskrg['jumlah']; //jumlah skrg

    $adjuststock = $stockskrg - $qtyskrg;

    $queryx = mysqli_query($conn, "update sstock_brg set stock='$adjuststock' where idx='$idx'");
    $del = mysqli_query($conn, "delete from sbrg_masuk where id='$id'");


    //cek apakah berhasil
    if ($queryx && $del) {

        echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
              </div>
            <meta http-equiv='refresh' content='1; url= masuk.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 1 seconds.
              </div>
             <meta http-equiv='refresh' content='1; url= masuk.php'/> ";
    }
};
?>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Logistics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-144808195-1');
    </script>

    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->

        <div class="sidebar-menu">
            <div class="sidebar-header">
                <a href="index.php"><img src="../logo1.png" alt="logo1" width="80%"></a>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="home.php"><span>Home</span></a>
                            </li>
                            <li>
                                <a href="stock.php"></i><span>Kebun</span></a>
                            </li>
                            <li>
                                <a href="masuk.php"></i><span>Hasil Timbang</span></a>
                            </li>
                            <li>
                                <a href="keluar.php"></i><span>Netto Inti Sawit</span></a>
                            </li>

                            <li>
                                <a href="logout.php"><span>Logout</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <h2>Hi, <?= $_SESSION['user']; ?>!</h2>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li>
                                <h3>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            <!--
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            var date = new Date();
                                            var day = date.getDate();
                                            var month = date.getMonth();
                                            var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                            var yy = date.getYear();
                                            var year = (yy < 1000) ? yy + 1900 : yy;
                                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                            //
                                            -->
                                        </script></b>
                                    </div>
                                </h3>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Hasil Timbang</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right" style="color:black; padding:0px;">
                            <img src="log.jpg" width="220px" class="user-name dropdown-toggle" data-toggle="dropdown" \>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">

                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <h2>Hasil Timbang</h2>
                                    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah</button>
                                </div>
                                <div class="market-status-table mt-4">
                                    <div class="table-responsive">
                                        <table id="dataTable3" class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Penyusutan</th>
                                                    <th>Netto Kebun</th>
                                                    <th>Netto PPL</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $timbang = mysqli_query($conn, "SELECT * FROM tbl_timbang ORDER BY id DESC");
                                                $no = 1;
                                                while ($t = mysqli_fetch_array($timbang)) {
                                                    $id = $t['id'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $t['penyusutan'] ?></td>
                                                        <td><?php echo $t['netto_kebun'] ?></td>
                                                        <td><?php echo $t['netto_ppl'] ?></td>
                                                        <td>
                                                            <button data-toggle="modal" data-target="#edit<?= $id; ?>" class="btn btn-warning">E</button>
                                                            <button data-toggle="modal" data-target="#del<?= $id; ?>" class="btn btn-danger">D</button>
                                                        </td>
                                                    </tr>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="edit<?= $id; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="post" action="edit_timbang_act.php">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data Timbang</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        <label for="penyusutan">Penyusutan</label>
                                                                        <input type="text" id="penyusutan" name="penyusutan" class="form-control" value="<?php echo $t['penyusutan'] ?>" required>

                                                                        <label for="netto_kebun">Netto Kebun</label>
                                                                        <input type="text" id="netto_kebun" name="netto_kebun" class="form-control" value="<?php echo $t['netto_kebun'] ?>" required>

                                                                        <label for="netto_ppl">Netto PPL</label>
                                                                        <input type="text" id="netto_ppl" name="netto_ppl" class="form-control" value="<?php echo $t['netto_ppl'] ?>" required>

                                                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                                                    </div>

                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-success" name="update">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="del<?= $id; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="post" action="hapus_timbang_act.php">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Hapus Data Timbang</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin menghapus data timbang ini?
                                                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                                                    </div>

                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <a href="exportbrgmsk.php" target="_blank" class="btn btn-info">Export Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>By Richard's Lab</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- modal input -->
 <!-- Modal Input Data Timbang -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Timbang</h4>
            </div>
            <div class="modal-body">
                <form action="timbang_masuk_act.php" method="post">
                    <div class="form-group">
                        <label>Penyusutan</label>
                        <input name="penyusutan" type="text" class="form-control" placeholder="Penyusutan" required>
                    </div>
                    <div class="form-group">
                        <label>Netto Kebun</label>
                        <input name="netto_kebun" type="text" class="form-control" placeholder="Netto Kebun" required>
                    </div>
                    <div class="form-group">
                        <label>Netto PPL</label>
                        <input name="netto_ppl" type="text" class="form-control" placeholder="Netto PPL" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
                </form>
        </div>
    </div>
</div>


    <script>
        $(document).ready(function() {
            $('input').on('keydown', function(event) {
                if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
                    var $t = $(this);
                    event.preventDefault();
                    var char = String.fromCharCode(event.keyCode);
                    $t.val(char + $t.val().slice(this.selectionEnd));
                    this.setSelectionRange(1, 1);
                }
            });
        });

        $(document).ready(function() {
            $('#dataTable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>