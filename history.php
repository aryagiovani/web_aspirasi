<?php
include('koneksi.php');
$nis_cari = isset($_GET['nis_cari']) ? mysqli_real_escape_string($koneksi, $_GET['nis_cari']) : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Histori Aspirasi</title>
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
            overflow-y: scroll;
        }

        /* --- NAVIGASI IDENTIK --- */
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

        /* --- CONTAINER KONTEN --- */
        .main-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: none;
            border-top: 8px solid var(--primary-red);
        }

        /* --- SEARCH BOX --- */
        .search-container {
            max-width: 500px;
            margin: 0 auto 30px;
        }

        .form-control-search {
            border-radius: 12px 0 0 12px;
            border: 1px solid #ddd;
            padding: 12px 20px;
        }

        .btn-search {
            background-color: var(--primary-red);
            color: white;
            border-radius: 0 12px 12px 0;
            padding: 0 25px;
            font-weight: bold;
        }

        /* --- TABLE STYLE --- */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table-custom td {
            padding: 15px;
            background: white;
            border-top: 1px solid #f2f2f2;
            border-bottom: 1px solid #f2f2f2;
            vertical-align: middle;
        }

        .table-custom tr td:first-child {
            border-radius: 10px 0 0 10px;
            border-left: 1px solid #f2f2f2;
        }

        .table-custom tr td:last-child {
            border-radius: 0 10px 10px 0;
            border-right: 1px solid #f2f2f2;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 700;
        }

        /* --- FOTO PREVIEW STYLE --- */
        .photo-container {
            position: relative;
            max-width: 80px;
            height: 80px;
            margin: 0 auto 5px;
        }

        .photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }

        .photo-preview:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(230, 33, 41, 0.3);
            border-color: var(--primary-red);
        }

        .no-photo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.8rem;
        }

        .photo-label {
            font-size: 0.75rem;
            text-align: center;
            color: #6c757d;
            margin-top: 2px;
        }

        /* Modal untuk full view foto */
        .modal-img {
            max-width: 90%;
            max-height: 90%;
            width: auto;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <header class="row mb-5 align-items-center">
            <div class="col-md-4 text-center text-md-start">
                <h2 class="fw-bold m-0" style="color: var(--primary-red);">
                    <i class="fas fa-bullhorn me-2"></i>Layanan Aspirasi Pengaduan
                </h2>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-pills nav-pills-custom justify-content-center justify-content-md-end bg-white shadow-sm p-1 mt-3 mt-md-0" style="border-radius: 12px;">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'tambah_aspirasi.php') ? 'active' : ''; ?>" href="tambah_aspirasi.php">
                            <i class="fas fa-paper-plane me-1"></i> Aspirasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'history.php') ? 'active' : ''; ?>" href="history.php">
                            <i class="fas fa-history me-1"></i> History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'active' : ''; ?>" href="login.php">
                            <i class="fas fa-user-lock me-1"></i> Login (Admin)
                        </a>
                    </li>
                </ul>
            </div>
        </header>

        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold" style="color: var(--black); letter-spacing: -1px;">HISTORY LAPORAN</h1>
            <p class="text-muted lead">Lacak status penanganan laporan yang telah Anda kirimkan</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="main-card">
                    <div class="search-container">
                        <form action="" method="GET" class="input-group">
                            <input type="text" name="nis_cari" class="form-control form-control-search" placeholder="Cari berdasarkan NIS..." value="<?= htmlspecialchars($nis_cari) ?>" required>
                            <button type="submit" name="submit" class="btn btn-search">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <?php if (isset($_GET['submit']) && !empty($nis_cari)) :
                        $query = "SELECT tb_input_aspirasi.*, tb_siswa.nis, tb_aspirasi.status, tb_aspirasi.feedback, tb_kategori.ket_kategori 
                                FROM tb_input_aspirasi 
                                INNER JOIN tb_kategori ON tb_input_aspirasi.id_kategori = tb_kategori.id_kategori 
                                INNER JOIN tb_siswa ON tb_input_aspirasi.nis = tb_siswa.nis 
                                INNER JOIN tb_aspirasi ON tb_input_aspirasi.id_pelaporan = tb_aspirasi.id_pelaporan 
                                WHERE tb_siswa.nis = '$nis_cari' ORDER BY tb_input_aspirasi.id_pelaporan DESC";
                        $result = mysqli_query($koneksi, $query);
                    ?>
                        <div class="d-flex justify-content-between mb-4">
                            <h6 class="fw-bold">Hasil untuk NIS: <span class="text-danger"><?= htmlspecialchars($nis_cari) ?></span></h6>
                            <span class="badge bg-dark"><?= mysqli_num_rows($result) ?> Data</span>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-custom border-0">
                                <thead>
                                    <tr class="text-center text-muted small">
                                        <th class="border-0">ID</th>
                                        <th class="border-0 text-start">DETAIL LAPORAN</th>
                                        <th class="border-0 text-center">FOTO</th>
                                        <th class="border-0">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($result) > 0) :
                                        while ($row = mysqli_fetch_assoc($result)) : ?>
                                            <tr>
                                                <td class="text-center fw-bold text-muted" style="width: 80px;"><?= $row['id_pelaporan']; ?></td>
                                                <td>
                                                    <div class="mb-1">
                                                        <span class="badge bg-light text-dark border me-2"><?= $row['ket_kategori']; ?></span>
                                                        <small class="text-danger fw-bold"><i class="fas fa-map-marker-alt me-1"></i><?= $row['lokasi']; ?></small>
                                                    </div>
                                                    <p class="mb-2 small text-secondary"><?= nl2br(htmlspecialchars($row['ket'])); ?></p>
                                                    <?php if ($row['feedback']): ?>
                                                        <div class="p-2 rounded bg-light border-3 small">
                                                            <strong>Admin:</strong> <?= htmlspecialchars($row['feedback']); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center" style="width: 120px;">
                                                    <?php if ($row['tambah_foto'] && file_exists('uploads/aspirasi/' . $row['tambah_foto'])): ?>
                                                        <div class="photo-container">
                                                            <img src="uploads/aspirasi/<?= htmlspecialchars($row['tambah_foto']) ?>"
                                                                alt="Foto Bukti"
                                                                class="photo-preview"
                                                                onclick="openPhotoModal('uploads/aspirasi/<?= htmlspecialchars($row['tambah_foto']) ?>')"
                                                                title="Klik untuk memperbesar">
                                                        </div>
                                                        <div class="photo-label">Foto Bukti</div>
                                                    <?php else: ?>
                                                        <div class="no-photo">
                                                            <i class="fas fa-camera fa-lg"></i>
                                                        </div>
                                                        <div class="photo-label">Tidak ada foto</div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center" style="width: 150px;">
                                                    <?php
                                                    if ($row['status'] == "Menunggu") echo '<span class="status-badge bg-warning text-dark">Menunggu</span>';
                                                    elseif ($row['status'] == "Proses") echo '<span class="status-badge bg-primary text-white">Proses</span>';
                                                    else echo '<span class="status-badge bg-success text-white">Selesai</span>';
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endwhile;
                                    else : ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">Data tidak ditemukan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-light mb-3"></i>
                            <p class="text-muted">Silakan masukkan NIS Anda untuk melihat riwayat pengaduan.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- MODAL FULL VIEW FOTO -->
        <div class="modal fade" id="photoModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header border-0 bg-white">
                        <h6 class="modal-title fw-bold text-muted">Foto Bukti Laporan</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center p-5">
                        <img id="modalPhoto" src="" alt="Foto Bukti" class="modal-img">
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center mt-5 pt-4 text-muted small border-top">
            &copy; 2026 Arya Giovani. All rights reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk buka modal foto full view
        function openPhotoModal(photoSrc) {
            const modalImg = document.getElementById('modalPhoto');
            const photoModal = new bootstrap.Modal(document.getElementById('photoModal'));
            modalImg.src = photoSrc;
            photoModal.show();
        }
    </script>
</body>

</html>