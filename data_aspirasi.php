<?php
include('koneksi.php');
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$sort   = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Aspirasi</title>
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
            min-height: 100vh;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
        }

        .header-section {
            padding: 40px 0 20px;
            text-align: center;
        }

        .header-section h1 {
            font-weight: 800;
            text-transform: uppercase;
            color: var(--primary-red);
        }

        .main-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
            margin-bottom: 50px;
        }

        /* Navbar & Nav-Pills */
        .nav-pills-custom {
            border-bottom: 2px solid #eee;
            margin-bottom: 30px;
        }

        .nav-pills-custom .nav-link {
            color: #555;
            background: none;
            padding: 12px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            border-bottom: 3px solid transparent;
            border-radius: 0;
        }

        .nav-pills-custom .nav-link.active {
            color: var(--primary-red);
            border-bottom-color: var(--primary-red);
        }

        /* Filter Box */
        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        /* Table Styling */
        .table-custom {
            font-size: 0.9rem;
        }

        .table-custom thead th {
            background-color: #f8f9fa;
            color: #666;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 15px;
            border-top: none;
        }

        .table-custom tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        /* Date styling */
        .date-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Status Badge */
        .status-badge {
            font-size: 0.7rem;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* --- FOTO PREVIEW STYLE ADMIN --- */
        .admin-photo-container {
            position: relative;
            max-width: 60px;
            height: 60px;
            margin: 0 auto 3px;
        }

        .admin-photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .admin-photo-preview:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(230, 33, 41, 0.3);
            border-color: var(--primary-red);
        }

        .admin-no-photo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.75rem;
        }

        .photo-label-admin {
            font-size: 0.65rem;
            text-align: center;
            color: #6c757d;
            margin-top: 1px;
            font-weight: 500;
        }

        /* Modal untuk full view foto */
        .modal-img-admin {
            max-width: 90%;
            max-height: 80%;
            width: auto;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
        }

        .footer {
            padding: 25px 0;
            background-color: white;
            border-top: 1px solid #eee;
            color: #777;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <header class="header-section container">
        <h1><i class="fas fa-database me-2"></i>Panel Admin</h1>
        <p>Kelola dan tindak lanjuti laporan aspirasi dari siswa.</p>
    </header>

    <main class="container-fluid px-lg-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="main-card">

                    <ul class="nav nav-pills nav-pills-custom mb-4">
                        <li class="nav-item">
                            <a class="nav-link" href="data_aspirasi.php"><i class="fas fa-list me-2"></i>Data Aspirasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                        </li>
                    </ul>

                    <div class="filter-section">
                        <form action="" method="GET" class="row g-3">
                            <div class="col-md-5">
                                <label class="small fw-bold text-muted mb-1">Cari Laporan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted"><i class="fas fa-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Cari NIS atau Lokasi..." value="<?= htmlspecialchars($search) ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted mb-1">Urutkan</label>
                                <select name="sort" class="form-select">
                                    <option value="DESC" <?= $sort == 'DESC' ? 'selected' : '' ?>>Terbaru (ID Terbesar)</option>
                                    <option value="ASC" <?= $sort == 'ASC' ? 'selected' : '' ?>>Terlama (ID Terkecil)</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-danger w-100 fw-bold shadow-sm" style="background-color: var(--primary-red);">
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-custom border">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>NIS / Kelas</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th width="16%">Foto Bukti</th>
                                    <th width="16%">Isi Laporan</th>
                                    <th width="14%">Feedback Admin</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT 
                                    tb_input_aspirasi.id_pelaporan, 
                                    tb_input_aspirasi.tanggal_input,
                                    tb_input_aspirasi.tambah_foto,
                                    tb_siswa.nis, 
                                    tb_siswa.kelas, 
                                    tb_input_aspirasi.lokasi, 
                                    tb_input_aspirasi.ket, 
                                    tb_aspirasi.id_aspirasi,
                                    tb_aspirasi.status,
                                    tb_aspirasi.feedback,
                                    tb_kategori.ket_kategori
                                FROM tb_input_aspirasi
                                INNER JOIN tb_kategori ON tb_input_aspirasi.id_kategori = tb_kategori.id_kategori
                                INNER JOIN tb_siswa ON tb_input_aspirasi.nis = tb_siswa.nis
                                INNER JOIN tb_aspirasi ON tb_input_aspirasi.id_pelaporan = tb_aspirasi.id_pelaporan";

                                if ($search != '') {
                                    $query .= " WHERE tb_siswa.nis LIKE '%$search%' OR tb_input_aspirasi.lokasi LIKE '%$search%'";
                                }

                                $query .= " ORDER BY tb_input_aspirasi.id_pelaporan $sort";
                                $result = mysqli_query($koneksi, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td class="text-center fw-bold text-muted"><?= $row['id_pelaporan']; ?></td>
                                            <td class="text-center">
                                                <span>
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    <?= date('d/m/y', strtotime($row['tanggal_input'])); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="fw-bold"><?= $row['nis']; ?></div>
                                                <small class="text-muted"><?= $row['kelas']; ?></small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border px-2 py-1"><?= $row['ket_kategori']; ?></span>
                                            </td>
                                            <td>
                                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                                <small><?= $row['lokasi']; ?></small>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['tambah_foto'] && file_exists('uploads/aspirasi/' . $row['tambah_foto'])): ?>
                                                    <div class="admin-photo-container">
                                                        <img src="uploads/aspirasi/<?= htmlspecialchars($row['tambah_foto']) ?>"
                                                            alt="Foto Bukti"
                                                            class="admin-photo-preview"
                                                            onclick="openAdminPhotoModal('uploads/aspirasi/<?= htmlspecialchars($row['tambah_foto']) ?>')"
                                                            title="Klik untuk memperbesar">
                                                    </div>
                                                    <div class="photo-label-admin">Bukti Foto</div>
                                                <?php else: ?>
                                                    <div class="admin-no-photo">
                                                        <i class="fas fa-camera"></i>
                                                    </div>
                                                    <div class="photo-label-admin">Tidak ada</div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted d-block"><?= nl2br(htmlspecialchars(substr($row['ket'], 0, 80))); ?>
                                                    <?php if (strlen($row['ket']) > 80): ?>...<?php endif; ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php if ($row['feedback']): ?>
                                                    <div class="small text-success fw-bold">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        <?= htmlspecialchars(substr($row['feedback'], 0, 50)); ?>
                                                        <?php if (strlen($row['feedback']) > 50): ?>...<?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-muted small"><em>Belum ditanggapi</em></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($row['status'] == "Menunggu") {
                                                    echo '<span class="badge bg-warning text-dark status-badge">Menunggu</span>';
                                                } elseif ($row['status'] == "Proses") {
                                                    echo '<span class="badge bg-primary status-badge">Proses</span>';
                                                } else {
                                                    echo '<span class="badge bg-success status-badge">Selesai</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="edit_aspirasi.php?id_aspirasi=<?= $row['id_aspirasi']; ?>"
                                                    class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3 py-1"
                                                    title="Tanggapi Laporan">
                                                    <i class="fas fa-comment-dots me-1"></i> Tanggapi
                                                </a>
                                            </td>
                                        </tr>
                                <?php endwhile;
                                } else {
                                    echo "<tr><td colspan='10' class='text-center py-5 text-muted'>Data tidak ditemukan</td></tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MODAL FULL VIEW FOTO ADMIN -->
    <div class="modal fade" id="adminPhotoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 bg-white">
                    <h6 class="modal-title fw-bold text-muted">
                        <i class="fas fa-image me-2 text-primary"></i>Foto Bukti Laporan
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <img id="adminModalPhoto" src="" alt="Foto Bukti" class="modal-img-admin">
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p class="m-0">&copy; 2026 Arya Giovani. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk buka modal foto full view admin
        function openAdminPhotoModal(photoSrc) {
            const modalImg = document.getElementById('adminModalPhoto');
            const photoModal = new bootstrap.Modal(document.getElementById('adminPhotoModal'));
            modalImg.src = photoSrc;
            photoModal.show();
        }
    </script>
</body>

</html>