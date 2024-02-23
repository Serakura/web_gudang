<?php
require 'fungsi.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Rencana Anggaran Biaya</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="rab.php">PT. TERANG JAYA ABADI</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="rab.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Rencana Anggaran Biaya
                        </a>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Supplier
                        </a>
                        <a class="nav-link" href="permintaanbarang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Permintaan Barang
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small"></div>
                    @ariisdw
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Rencana Anggaran Biaya</h1>



                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah RAB
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Jumlah Barang</th>
                                            <th>Harga Satuan</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>

                                        <?php

                                        // perintah tampil data

                                        $totalharga = 0;
                                        $jumlah = 0;


                                        ?>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadatarab = mysqli_query($conn, "select * from rab");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatarab)) {
                                            $namabarang = $data['namabarang'];
                                            $satuan = $data['satuan'];
                                            $jumlahbarang = $data['jumlahbarang'];
                                            $hargasatuan = $data['hargasatuan'];
                                            $totalharga = $data['totalharga'];
                                            $jumlah += $totalharga;
                                            $idr = $data['idrab'];
                                        ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $satuan; ?></td>
                                                <td><?= $jumlahbarang; ?></td>
                                                <td><?= rupiah($data['hargasatuan']); ?></td>
                                                <td><?= rupiah($data['totalharga']); ?></td>
                                                <td>

                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idr; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idr; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?= $idr; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Rab</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="satuan" value="<?= $satuan; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="jumlahbarang" value="<?= $jumlahbarang; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="hargasatuan" value="<?= $hargasatuan; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idr" value="<?= $idr; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updaterab">Submit</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?= $idr; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Rab?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus <?= $namabarang; ?>?
                                                                <input type="hidden" name="idr" value="<?= $idr; ?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusrab">Hapus</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        };

                                        ?>

                                        <tr>
                                            <td colspan="5">Jumlah </td>
                                            <td><?= rupiah($jumlah); ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                <script src="js/scripts.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                <script src="assets/demo/chart-area-demo.js"></script>
                <script src="assets/demo/chart-bar-demo.js"></script>
                <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
                <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Rab</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">

                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="satuan" placeholder="Satuan" class="form-control" required>
                    <br>
                    <input type="number" name="jumlahbarang" class="form-control" placeholder="Jumlah Barang" required>
                    <br>
                    <input type="number" name="hargasatuan" class="form-control" placeholder="Harga Satuan" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="rab">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

</html>