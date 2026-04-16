<?php
include "koneksi.php";
session_start();

$username = $_POST["username"];
$password = $_POST["password"];


$sql = mysqli_query($koneksi, "select * from tb_admin where username= '$username' and password= '$password'");

$cek = mysqli_num_rows($sql);

if ($cek == 1) {
    while ($data = mysqli_fetch_array($sql)) {
        $_SESSION['username'] = $data['username'];
    }
    header("location:data_aspirasi.php");
} else {
    echo "'<script>alert('username/password Salah!.'); document.location='login.php';</script>'";
}
