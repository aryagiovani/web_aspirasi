<?php
include('koneksi.php');
$id_aspirasi = $_GET['id_aspirasi'];
$select = mysqli_query($koneksi, "SELECT * FROM tb_aspirasi WHERE id_aspirasi='$id_aspirasi'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_assoc($select);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tanggapi Aspirasi</title>
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
            padding: 50px 0 30px;
            text-align: center;
        }

        .header-section h1 {
            font-weight: 800;
            text-transform: uppercase;
            color: var(--primary-red);
            margin-bottom: 10px;
        }

        .main-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
            margin-bottom: 50px;
        }

        /* Navigasi Pills */
        .nav-pills-custom {
            border-bottom: 2px solid #eee;
            margin-bottom: 40px;
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
            background: none;
            border-bottom-color: var(--primary-red);
        }

        /* Form Styling */
        .form-label {
            font-weight: 700;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.25rem rgba(230, 33, 41, 0.1);
        }

        .btn-submit {
            background-color: var(--primary-red);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #c41a21;
            transform: translateY(-2px);
        }

        .btn-reset {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            color: #666;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .footer {
            padding: 25px 0;
            background-color: white;
            border-top: 1px solid #eee;
            color: #777;
            margin-top: auto;
        }

        .badge-info-custom {
            background-color: #fff5f5;
            border-left: 4px solid var(--primary-red);
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <header class="header-section container">
        <h1><i class="fas fa-tools me-2"></i>Tanggapi Aspirasi</h1>
        <p>Berikan tanggapan dan perbarui status laporan siswa.</p>
    </header>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="main-card">

                    <ul class="nav nav-pills nav-fill nav-pills-custom">
                        <li class="nav-item">
                            <a class="nav-link active"><i class="fas fa-table me-2"></i>Data Tanggapi Aspirasi</a>
                        </li>
                    </ul>

                    <div class="badge-info-custom">
                        <small class="text-uppercase fw-bold text-muted d-block mb-1">Sedang Menanggapi ID:</small>
                        <h5 class="mb-0 text-dark">#<?php echo $data['id_aspirasi'] ?> - <span class="text-muted small">ID Pelapor: <?php echo $data['id_pelaporan'] ?></span></h5>
                    </div>

                    <form action="update_aspirasi.php" method="POST">
                        <input type="hidden" name="id_aspirasi" value="<?php echo $data['id_aspirasi'] ?>">
                        <input type="hidden" name="id_pelaporan" value="<?php echo $data['id_pelaporan'] ?>">
                        <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori'] ?>">

                        <div class="mb-4">
                            <label for="status" class="form-label">Perbarui Status Laporan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-tasks text-danger"></i></span>
                                <select name="status" class="form-select" id="status">
                                    <?php
                                    $pilihan_status = ['Menunggu', 'Proses', 'Selesai'];
                                    $status_saat_ini = $data['status'];
                                    foreach ($pilihan_status as $status) {
                                        $selected = ($status == $status_saat_ini) ? "selected" : "";
                                        echo "<option value='$status' $selected>$status</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="feedback" class="form-label">Berikan Tanggapan (Feedback)</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="5" placeholder="Tuliskan tindakan yang diambil atau pesan untuk pelapor..." required><?php echo $data['feedback'] ?></textarea>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <button type="submit" class="btn btn-submit shadow-sm px-5">
                                <i class="fas fa-check-circle me-2"></i>Simpan Perubahan
                            </button>
                            <button type="reset" class="btn btn-reset px-4">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p class="m-0">&copy; 2026 Arya Giovani. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>