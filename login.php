<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Admin</title>
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
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
        }

        /* Navigasi Header - Konsisten */
        .nav-pills-custom .nav-link {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            color: #666;
            transition: 0.3s;
        }

        .nav-pills-custom .nav-link.active {
            background-color: var(--primary-red);
            color: white !important;
        }

        .main-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: none;
        }

        /* Form Styling */
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-right: none;
            color: #888;
            border-radius: 12px 0 0 12px;
        }

        .form-control {
            border-radius: 0 12px 12px 0;
            border: 1px solid #ddd;
            padding: 12px 15px;
        }

        .form-control:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.25rem rgba(230, 33, 41, 0.1);
        }

        /* Login Button */
        .btn-login {
            background-color: var(--primary-red);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #c41a21;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 33, 41, 0.3);
            color: white;
        }

        .btn-reset {
            background-color: #f1f3f5;
            border: none;
            color: #666;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
        }

        .footer {
            padding: 25px 0;
            background-color: white;
            border-top: 1px solid #eee;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <main class="container py-4">
        <div class="row mb-5 align-items-center">
            <div class="col-md-4 text-center text-md-start">
                <h2 class="fw-bold m-0" style="color: var(--primary-red);"><i class="fas fa-lock me-2"></i>Akses Admin</h2>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-pills nav-pills-custom justify-content-center justify-content-md-end bg-white shadow-sm p-1 mt-3 mt-md-0" style="border-radius: 12px;">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php"><i class="fas fa-home me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah_aspirasi.php"><i class="fas fa-paper-plane me-1"></i> Aspirasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.php"><i class="fas fa-history me-1"></i> History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php"><i class="fas fa-user-lock me-1"></i> Login (Admin)</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="main-card text-center">
                    <div class="text-center mb-5">
                        <h3 class="display-6 fw-bold" style="color: var(--black); letter-spacing: -1px;">MASUK KE PANEL ADMIN</h3>
                    </div>

                    <div class="mb-4">
                        <img src="images/login.png" alt="Login Icon" style="width: 120px; height: auto; filter: drop-shadow(0 5px 10px rgba(0,0,0,0.1));">
                    </div>
<br>
                    <form action="login_cek.php" method="post" class="text-start">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>MASUK
                            </button>
                            <button type="reset" class="btn btn-reset">
                                RESET
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p class="m-0 text-muted small">&copy; 2026 Arya Giovani. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>