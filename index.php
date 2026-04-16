<?php
session_start();
if (isset($_SESSION['status_login']) && $_SESSION['status_login'] == "login") {
    header("location:data_aspirasi.php");
    exit();
} else {
    header("location:dashboard.php");
    exit();
}
