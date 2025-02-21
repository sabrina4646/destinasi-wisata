<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata Kuningan</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/icons/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

<body>
    <header>
        <section class="header container-fluid">
            <div class="header-content row">
                    <h1 class="my-auto ps-5">Destinasi Wisata Kuningan</h1>
            </div>
        </section>
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "index.php")) ? "active" : "" ?>" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "obyekWisata.php")) ? "active" : "" ?>" href="obyekWisata.php">Obyek Wisata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "fasilitasWisata.php")) ? "active" : "" ?>" href="fasilitasWisata.php">Fasilitas Wisata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "paketWisata.php")) ? "active" : "" ?>" href="paketWisata.php">Paket Wisata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "pemesanan.php")) ? "active" : "" ?>" href="pemesanan.php">Pemesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "galeri.php")) ? "active" : "" ?>" href="galeri.php">Galeri</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if (!isset($_SESSION['username'])) { ?>
                            <li class="nav-item">
                                <a href="login.php" class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "login.php")) ? "active" : "" ?>">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="registrasi.php" class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "registrasi.php")) ? "active" : "" ?>">Registrasi</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="logout.php" onclick="return confirm('apakah anda ingin logout?')" class="nav-link">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a href="profile.php" class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "profile.php")) ? "active" : "" ?>"> Hai <?= $_SESSION['nama']; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>