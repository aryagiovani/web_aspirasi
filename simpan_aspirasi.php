<?php
include('koneksi.php');

// Ambil data POST
$nis                = $_POST['nis'];
$kelas              = $_POST['kelas'];
$id_kategori        = $_POST['id_kategori'];
$lokasi             = $_POST['lokasi'];
$ket                = $_POST['ket'];
$tanggal_input      = date('Y-m-d');
$tambah_foto        = NULL; // Default NULL jika tidak ada upload

// BUAT FOLDER UPLOAD JIKA BELUM ADA
$upload_dir = 'uploads/aspirasi/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// PENANGANAN UPLOAD FOTO
if (isset($_FILES['tambah_foto']) && $_FILES['tambah_foto']['error'] == 0) {
    $file_name = $_FILES['tambah_foto']['name'];
    $file_tmp  = $_FILES['tambah_foto']['tmp_name'];
    $file_size = $_FILES['tambah_foto']['size'];
    $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validasi tipe file
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($file_ext, $allowed_ext)) {
        // Validasi ukuran (max 5MB)
        if ($file_size <= 5000000) {
            // Nama file unik
            $new_filename = time() . '_' . uniqid() . '.' . $file_ext;
            $upload_path = $upload_dir . $new_filename;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $tambah_foto = $new_filename; // Simpan nama file ke DB
            } else {
                $error = "Gagal upload file";
            }
        } else {
            $error = "Ukuran file terlalu besar (max 5MB)";
        }
    } else {
        $error = "Tipe file tidak diizinkan. Gunakan JPG, PNG, atau GIF";
    }
}

// CEK SISWA
$cekSiswa = "SELECT nis FROM tb_siswa WHERE nis = '$nis'";
$eksekusiCek = mysqli_query($koneksi, $cekSiswa);

if (mysqli_num_rows($eksekusiCek) == 0) {
    $querySiswa = "INSERT INTO tb_siswa (nis, kelas) VALUES ('$nis', '$kelas')";
    mysqli_query($koneksi, $querySiswa);
}

// INSERT tb_input_aspirasi (TANPA id_pelaporan dulu)
$sql1 = mysqli_query($koneksi, "INSERT INTO tb_input_aspirasi(nis, id_kategori, lokasi, ket, tanggal_input, tambah_foto) 
                                VALUES('$nis', '$id_kategori', '$lokasi', '$ket', '$tanggal_input', '$tambah_foto')")
    or die(mysqli_error($koneksi));

$id_pelaporan = mysqli_insert_id($koneksi);

// INSERT tb_aspirasi
$sql2 = mysqli_query($koneksi, "INSERT INTO tb_aspirasi(id_pelaporan, status, id_kategori) 
                                VALUES('$id_pelaporan', 'Menunggu', '$id_kategori')")
    or die(mysqli_error($koneksi));

if ($sql1 && $sql2) {
    echo '<script>alert("Berhasil menambahkan data aspirasi!"); 
        document.location="index.php";</script>';
} else {
    // Hapus file jika gagal insert ke DB
    if ($tambah_foto && file_exists($upload_dir . $tambah_foto)) {
        unlink($upload_dir . $tambah_foto);
    }
    echo '<script>alert("Gagal melakukan proses tambah data: ' . mysqli_error($koneksi) . '"); 
        document.location="index.php";</script>';
}
