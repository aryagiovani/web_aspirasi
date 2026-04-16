<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kirim Aspirasi</title>
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

        /* --- NAVIGASI KONSISTEN (Sama Persis dengan Dashboard) --- */
        .nav-pills-custom .nav-link {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            color: #666;
            transition: 0.3s;
            font-size: 1rem;
        }

        .nav-pills-custom .nav-link.active {
            background-color: var(--primary-red) !important;
            color: white !important;
        }

        .nav-pills-custom .nav-link:hover:not(.active) {
            background-color: #eee;
        }

        /* --- FORM & CARD STYLING --- */
        .main-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 30px;
            border-top: 8px solid var(--primary-red);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 12px 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.25px rgba(230, 33, 41, 0.1);
        }

        .btn-submit {
            background-color: var(--primary-red);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 50px;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #c41a21;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 33, 41, 0.3);
            color: white;
        }

        /* Steps Icon */
        .step-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            color: #ccc;
            border: 1px solid #eee;
        }

        .step-icon.active {
            background-color: var(--primary-red);
            color: white;
            border: none;
        }

        /* --- PHOTO UPLOAD STYLING --- */
        .photo-upload {
            border: 2px dashed #ddd;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: #fafafa;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .photo-upload:hover {
            border-color: var(--primary-red);
            background: #fff5f5;
        }

        .photo-upload input[type="file"] {
            position: absolute;
            left: -9999px;
        }

        .photo-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }

        .file-info {
            background: linear-gradient(135deg, var(--primary-red), #c41a21);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            margin-top: 15px;
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
        </div>

        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold" style="color: var(--black); letter-spacing: -1px;">BUAT LAPORAN</h1>
            <p class="text-muted lead">Sampaikan aspirasi atau keluhan Anda secara resmi</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="main-card">
                    <form action="simpan_aspirasi.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nis" class="form-label">Nomor Induk Siswa (NIS) *</label>
                                <input type="text" class="form-control" id="nis" placeholder="Contoh: 2223101" name="nis" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kelas" class="form-label">Kelas *</label>
                                <select class="form-select" id="kelas" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    <optgroup label="Kelas XII">
                                        <option value="XII PPLG">XII PPLG</option>
                                        <option value="XII MPLB">XII MPLB</option>
                                    </optgroup>
                                    <optgroup label="Kelas XI">
                                        <option value="XI PPLG">XI PPLG</option>
                                        <option value="XI MPLB">XI MPLB</option>
                                    </optgroup>
                                    <optgroup label="Kelas X">
                                        <option value="X PPLG">X PPLG</option>
                                        <option value="X MPLB">X MPLB</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori Laporan *</label>
                            <select name="id_kategori" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <?php
                                $kat = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                                while ($row = mysqli_fetch_assoc($kat)) {
                                    echo "<option value='" . $row['id_kategori'] . "'>" . $row['ket_kategori'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi Kejadian *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-map-marker-alt text-danger"></i></span>
                                <input type="text" class="form-control border-start-0" id="lokasi" placeholder="Misal: Kantin, Ruang Kelas 10, Toilet" name="lokasi" required>
                            </div>
                        </div>

                        <!-- TAMBAHAN INPUT FOTO -->
                        <div class="mb-4">
                            <label for="tambah_foto" class="form-label">Foto Bukti</label>
                            <div class="photo-upload" onclick="document.getElementById('tambah_foto').click()">
                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                <h6 class="mb-2">Klik untuk upload foto</h6>
                                <p class="text-muted small mb-0">Format: JPG, PNG, JPEG (Max: 5MB)</p>
                                <input type="file" id="tambah_foto" name="tambah_foto" class="d-none" accept="image/*" required>
                                <div id="preview-container" class="mt-3" style="display: none;">
                                    <img id="photo-preview" class="photo-preview" src="" alt="Preview">
                                    <div class="file-info">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <span id="file-name"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="ket" class="form-label">Detail Aspirasi / Keluhan *</label>
                            <textarea class="form-control" id="ket" name="ket" rows="5" placeholder="Jelaskan secara rinci kerusakan atau saran Anda agar dapat segera diproses..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-submit shadow-sm">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Laporan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <footer class="text-center mt-5 pt-4 border-top">
            <p class="text-muted small">&copy; 2026 Arya giovani. All rights reserved.</p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Preview foto saat diupload
        document.getElementById('tambah_foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImg = document.getElementById('photo-preview');
            const fileNameSpan = document.getElementById('file-name');

            if (file) {
                // Cek ukuran file (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB!');
                    e.target.value = '';
                    return;
                }

                // Tampilkan preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                }
                reader.readAsDataURL(file);

                fileNameSpan.textContent = file.name;
                previewContainer.style.display = 'block';
            }
        });
    </script>
</body>

</html>