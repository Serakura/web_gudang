<?php
session_start();

//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "gudang");

//Tampilkan dalam format rupiah
function rupiah($angka)
{
    $hasil = "Rp. " . number_format($angka, '0', ',', '.');
    return $hasil;
}


//menambah rab
if (isset($_POST['rab'])) {
    $query = mysqli_query($conn, "SELECT * FROM rab ORDER BY idr DESC LIMIT 1");
    while ($rw = mysqli_fetch_row($query)) {
        $idr = $rw[0];
    }

    $str = preg_replace('/\D/', '', $idr);
    $hsl = (int)$str + 1;
    $hasil = "r" . $hsl;
    $namabarang = $_POST['namabarang'];
    $satuan = $_POST['satuan'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $hargasatuan = $_POST['hargasatuan'];
    $totalharga = $_POST['totalharga'];
    $totalharga = $hargasatuan * $jumlahbarang;

    $addtotable = mysqli_query($conn, "insert into rab (idrab, namabarang, satuan, jumlahbarang, hargasatuan, totalharga) values('$hasil','$namabarang','$satuan','$jumlahbarang','$hargasatuan','$totalharga')");
    if ($addtotable) {
        header('location:rab.php');
    } else {
        echo 'Gagal';
        header('location:rab.php');
    }
};

//menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $query = mysqli_query($conn, "SELECT * FROM stock ORDER BY idbarang DESC LIMIT 1");
    while ($rw = mysqli_fetch_row($query)) {
        $idb = $rw[0];
    }

    $str = preg_replace('/\D/', '', $idb);
    $hsl = (int)$str + 1;
    $hasil = "b" . $hsl;
    $idrab = $_POST['namabarang'];
    $query = mysqli_query($conn, "SELECT namabarang FROM rab WHERE idrab='$idrab'");
    while ($rw = mysqli_fetch_row($query)) {
        $namabarang = $rw[0];
    }
    $satuan = $_POST['satuan'];
    $stock = $_POST['stock'];
    $hargasatuan = $_POST['hargasatuan'];
    $totalharga = $_POST['totalharga'];
    $totalharga = $hargasatuan * $stock;

    $addtotable = mysqli_query($conn, "insert into stock (idbarang,idrab,namabarang, satuan, stock, hargasatuan, totalharga) values('$hasil','$idrab','$namabarang','$satuan','$stock','$hargasatuan','$totalharga')");
    if ($addtotable) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

//Menambah Barang Masuk
if (isset($_POST['barangmasuk'])) {
    $query = mysqli_query($conn, "SELECT * FROM masuk ORDER BY idmasuk DESC LIMIT 1");
    while ($rw = mysqli_fetch_row($query)) {
        $idb = $rw[0];
    }

    $str = preg_replace('/\D/', '', $idb);
    $hsl = (int)$str + 1;
    $hasil = "m" . $hsl;
    $barangnya = $_POST['barangnya'];
    $supplier = $_POST['suppliernya'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $idsupplier = $_POST['idsupplier'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganjumlahbarang = $stocksekarang + $jumlahbarang;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idmasuk,idbarang,idsupplier, supplier, jumlahbarang) values('$hasil','$barangnya','$idsupplier','$supplier','$jumlahbarang')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganjumlahbarang' where idbarang='$barangnya'");
    if ($addtomasuk && $updatestockmasuk) {
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//Menambah Barang Keluar
if (isset($_POST['addbarangkeluar'])) {
    $query = mysqli_query($conn, "SELECT * FROM keluar ORDER BY idkeluar DESC LIMIT 1");
    while ($rw = mysqli_fetch_row($query)) {
        $idb = $rw[0];
    }

    $str = preg_replace('/\D/', '', $idb);
    $hsl = (int)$str + 1;
    $hasil = "k" . $hsl;
    $barangnya = $_POST['barangnya'];
    $pelaksanalapangan = $_POST['pelaksanalapangan'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $permintaan = $_POST['permintaan'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];

    if ($stocksekarang >= $jumlahbarang) {
        //kalau barangnya cukup
        $tambahkanstocksekarangdenganjumlahbarang = $stocksekarang - $jumlahbarang;

        $addtokeluar = mysqli_query($conn, "insert into keluar (idkeluar,idbarang, idpermintaanbarang, pelaksanalapangan, jumlahbarang) values('$hasil','$barangnya','$permintaan','$pelaksanalapangan','$jumlahbarang')");
        $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganjumlahbarang' where idbarang='$barangnya'");
        if ($addtokeluar && $updatestockmasuk) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        //kalau barangya tidak cukup
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href="keluar.php";      
        </script>
        ';
    }
}

//Menambah Permintaan Barang 
if (isset($_POST['permintaanbarang'])) {
    $query = mysqli_query($conn, "SELECT * FROM permintaanbarang ORDER BY idpermintaanbarang DESC LIMIT 1");
    while ($rw = mysqli_fetch_row($query)) {
        $idb = $rw[0];
    }

    $str = preg_replace('/\D/', '', $idb);
    $hsl = (int)$str + 1;
    $hasil = "p" . $hsl;
    $barangnya = $_POST['barangnya'];
    $pelaksanalapangan = $_POST['pelaksanalapangan'];
    $jumlahbarang = $_POST['jumlahbarang'];

    $addtopermintaanbarang = mysqli_query($conn, "insert into permintaanbarang (idpermintaanbarang,idbarang, pelaksanalapangan, jumlahbarang) values('$hasil','$barangnya','$pelaksanalapangan','$jumlahbarang')");
    if ($addtopermintaanbarang) {
        header('location:permintaanbarang.php');
    } else {
        echo 'Gagal';
        header('location:permintaanbarang.php');
    }
}

//Menambah supplier
if (isset($_POST['supplier'])) {
    $query = mysqli_query($conn, "SELECT * FROM supplier ORDER BY idsupplier DESC LIMIT 1");
    while ($rw = mysqli_fetch_row($query)) {
        $idb = $rw[0];
    }

    $str = preg_replace('/\D/', '', $idb);
    $hsl = (int)$str + 1;
    $hasil = "s" . $hsl;
    $barangnya = $_POST['barangnya'];
    $namasupplier = $_POST['namasupplier'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $harga = $_POST['harga'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    $addtosupplier = mysqli_query($conn, "insert into supplier (idsupplier,idbarang, namasupplier, jumlahbarang, harga, alamat, kontak) values('$hasil','$barangnya','$namasupplier','$jumlahbarang','$harga','$alamat','$kontak')");
    if ($addtosupplier) {
        header('location:supplier.php');
    } else {
        echo 'Gagal';
        header('location:supplier.php');
    }
}

//Update info barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $stock = $_POST['stock'];
    $satuan = $_POST['satuan'];
    $hargasatuan = $_POST['hargasatuan'];
    $totalharga = $_POST['totalharga'];
    $totalharga = $hargasatuan * $stock;

    $update = mysqli_query($conn, "update stock set namabarang='$namabarang', satuan='$satuan', stock='$stock', hargasatuan='$hargasatuan', totalharga='$totalharga' where idbarang ='$idb'");
    if ($update) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Update info rab
if (isset($_POST['updaterab'])) {
    $idr = $_POST['idr'];
    $namabarang = $_POST['namabarang'];
    $satuan = $_POST['satuan'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $hargasatuan = $_POST['hargasatuan'];
    $totalharga = $_POST['totalharga'];
    $totalharga = $hargasatuan * $jumlahbarang;

    $update = mysqli_query($conn, "update rab set namabarang='$namabarang', satuan='$satuan', jumlahbarang='$jumlahbarang', hargasatuan='$hargasatuan', totalharga='$totalharga' where idrab ='$idr'");
    if ($update) {
        header('location:rab.php');
    } else {
        echo 'Gagal';
        header('location:rab.php');
    }
}

//Menghapus rab
if (isset($_POST['hapusrab'])) {
    $idr = $_POST['idr'];

    $hapus = mysqli_query($conn, "delete from rab where idrab='$idr'");
    if ($hapus) {
        header('location:rab.php');
    } else {
        echo 'Gagal';
        header('location:rab.php');
    }
};

//Menghapus barang dari stock
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapus) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

//Menghapus supplier
if (isset($_POST['hapussupplier'])) {
    $ids = $_POST['ids'];

    $hapus = mysqli_query($conn, "delete from supplier where idsupplier='$ids'");
    if ($hapus) {
        header('location:supplier.php');
    } else {
        echo 'Gagal';
        header('location:supplier.php');
    }
};

//Menghapus permintaan barang
if (isset($_POST['hapuspermintaanbarang'])) {
    $idp = $_POST['idp'];

    $hapus = mysqli_query($conn, "delete from permintaanbarang where idpermintaanbarang='$idp'");
    if ($hapus) {
        header('location:permintaanbarang.php');
    } else {
        echo 'Gagal';
        header('location:permintaanbarang.php');
    }
};

//Mengubah data barang masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $satuan = $_POST['keterangan'];
    $jumlahbarang = $_POST['jumlahbarang'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $jumlahbarangskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $jumlahbarangnya = mysqli_fetch_array($jumlahbarangskrg);
    $jumlahbarangskrg = $jumlahbarangnya['jumlahbarang'];

    if ($jumlahbarang > $jumlahbarangskrg) {
        $selisih = $jumlahbarang - $jumlahbarangskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set jumlahbarang='$jumlahbarang', keterangan='$satuan' where idmasuk='$idm'");
        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    } else {
        $selisih = $jumlahbarangskrg - $jumlahbarang;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set jumlahbarang='$jumlahbarang', keterangan='$satuan' where idmasuk='$idm'");
        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }
}

//Menghapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idb'];
    $jumlahbarang = $_POST['jb'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock - $jumlahbarang;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if ($update && $hapusdata) {
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}

//Mengubah data barang keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $jumlahbarang = $_POST['jumlahbarang'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $jumlahbarangskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $jumlahbarangnya = mysqli_fetch_array($jumlahbarangskrg);
    $jumlahbarangskrg = $jumlahbarangnya['jumlahbarang'];

    if ($jumlahbarang > $jumlahbarangskrg) {
        $selisih = $jumlahbarang - $jumlahbarangskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set jumlahbarang='$jumlahbarang', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        $selisih = $jumlahbarangskrg - $jumlahbarang;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set jumlahbarang='$jumlahbarang', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }
}



//Menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $jumlahbarang = $_POST['jb'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock + $jumlahbarang;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if ($update && $hapusdata) {
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}
