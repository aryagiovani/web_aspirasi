<?php
include('koneksi.php');
$id_aspirasi        =    $_POST['id_aspirasi'];
$id_pelaporan       =    $_POST['id_pelaporan'];
$status             =    $_POST['status'];
$id_kategori        =    $_POST['id_kategori'];
$feedback           =    $_POST['feedback'];
$tanggal_feedback   =    date('Y-m-d');

$sql = mysqli_query($koneksi, "UPDATE tb_aspirasi SET id_aspirasi='$id_aspirasi', id_pelaporan='$id_pelaporan', status='$status', id_kategori='$id_kategori', feedback='$feedback', tanggal_feedback='$tanggal_feedback' WHERE id_aspirasi='$id_aspirasi'") 
or die(mysqli_error($koneksi));

if ($sql) //berhasil
{
    echo '<script>alert("Berhasil mengedit data."); document.location="data_aspirasi.php";</script>';
} else //gagal
{
    echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
}
