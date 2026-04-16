<?php
include('koneksi.php');

// Statistik sederhana
$total_aspirasi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_aspirasi"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #e62129;
            --bg-cream: #fbf9f1;
            --text-dark: #333;
        }

        body {
            background-color: var(--bg-cream);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: var(--text-dark);
        }

        .nav-pills-custom .nav-link {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            color: #666;
            transition: 0.3s;
        }

        .nav-pills-custom .nav-link.active {
            background-color: var(--primary-red) !important;
            color: white !important;
        }

        .welcome-box {
            background: white;
            border-radius: 25px;
            padding: 50px 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            border-top: 8px solid var(--primary-red);
            text-align: center;
        }

        /* --- STYLES UNTUK ALUR BARU (SESUAI GAMBAR) --- */
        .process-row {
            position: relative;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        /* Garis penghubung antar lingkaran (hanya muncul di layar lebar) */
        @media (min-width: 768px) {
            .process-row::before {
                content: "";
                position: absolute;
                top: 35px;
                left: 50px;
                right: 50px;
                height: 2px;
                background: #e0e0e0;
                z-index: 0;
            }
        }

        .step-item {
            position: relative;
            z-index: 1;
            flex: 1;
            min-width: 180px;
            padding: 10px;
            text-align: center;
        }

        .step-icon-circle {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-size: 1.5rem;
            color: #444;
            transition: 0.3s;
        }

        .step-item.active .step-icon-circle {
            background: var(--primary-red);
            color: white;
        }

        .step-title {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 8px;
            color: #222;
        }

        .step-desc {
            font-size: 0.85rem;
            color: #777;
            line-height: 1.4;
        }

        .step-time {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .btn-massive {
            padding: 18px 45px;
            font-size: 1.1rem;
            font-weight: 800;
            text-transform: uppercase;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .stats-pill {
            display: inline-block;
            padding: 12px 30px;
            background: #f8f9fa;
            border-radius: 50px;
            border: 1px solid #eee;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <main class="container py-4">
        <div class="row mb-5 align-items-center">
            <div class="col-md-4 text-center text-md-start">
                <h2 class="fw-bold m-0" style="color: var(--primary-red);">
                    <i class="fas fa-bullhorn me-2"></i>Layanan Aspirasi Pengaduan
                </h2>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-pills nav-pills-custom justify-content-center justify-content-md-end bg-white shadow-sm p-1 mt-3 mt-md-0" style="border-radius: 12px;">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="tambah_aspirasi.php"><i class="fas fa-paper-plane me-1"></i> Aspirasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="history.php"><i class="fas fa-history me-1"></i> History</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-user-lock me-1"></i> Login (Admin)</a></li>
                </ul>
            </div>
        </div>

        <div class="welcome-box shadow-sm">
            <h2 class="fw-bold text-dark mb-3">Selamat Datang di Portal Aspirasi</h2>
            <p class="text-muted mx-auto mb-4" style="max-width: 700px;">
                Sampaikan keluhan atau saran Anda mengenai sarana prasarana sekolah. Kami siap mendengarkan dan menindaklanjuti laporan Anda demi kenyamanan bersama.
            </p>
            <div class="stats-pill">
                <i class="fas fa-database me-2 text-danger"></i> Total Laporan Terkirim: <?php echo $total_aspirasi; ?>
            </div>
        </div>

        <div class="mb-5">
            <div class="text-center mb-5">
                <h3 class="fw-bold">Alur Pengaduan</h3>
                <div style="width: 50px; height: 3px; background: var(--primary-red); margin: 10px auto;"></div>
            </div>

            <div class="process-row">
                <div class="step-item active">
                    <div class="step-icon-circle shadow">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h5 class="step-title">Tulis Laporan</h5>
                    <p class="step-desc">Laporkan keluhan atau aspirasi Anda dengan jelas dan lengkap</p>
                </div>

                <div class="step-item">
                    <div class="step-icon-circle">
                        <i class="fas fa-share"></i>
                    </div>
                    <h5 class="step-title">Proses Verifikasi</h5>
                    <p class="step-desc"><span class="step-time">Dalam 3 hari</span> laporan Anda akan diverifikasi dan diteruskan ke instansi berwenang</p>
                </div>

                <div class="step-item">
                    <div class="step-icon-circle">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h5 class="step-title">Proses Tindak Lanjut</h5>
                    <p class="step-desc"><span class="step-time">Dalam 5 hari</span> instansi akan menindaklanjuti dan membalas laporan Anda</p>
                </div>

                <div class="step-item">
                    <div class="step-icon-circle">
                        <i class="fas fa-comment-dots"></i>
                    </div>
                    <h5 class="step-title">Beri Tanggapan</h5>
                    <p class="step-desc">Anda dapat menanggapi kembali balasan dari instansi <span class="step-time">dalam waktu 10 hari</span></p>
                </div>

                <div class="step-item">
                    <div class="step-icon-circle">
                        <i class="fas fa-check"></i>
                    </div>
                    <h5 class="step-title">Selesai</h5>
                    <p class="step-desc">Laporan Anda akan terus ditindaklanjuti hingga terselesaikan</p>
                </div>
            </div>
        </div>

        <div class="text-center py-4">
            <a href="tambah_aspirasi.php" class="btn btn-danger btn-massive shadow">
                <i class="fas fa-edit me-2"></i> Buat Laporan Sekarang
            </a>
        </div>

        <footer class="text-center mt-5 pt-4 border-top">
            <p class="text-muted small">&copy; 2026 Arya Giovani. All rights reserved.</p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>