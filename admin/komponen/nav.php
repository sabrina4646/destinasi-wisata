<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "index.php") || str_contains($_SERVER['REQUEST_URI'], "editPemesanan.php")) ? "active" : "" ?> " aria-current="page" href="index.php">
                    <i class="bi bi-house-fill"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "obyekWisata.php")) ? "active" : "" ?> " href="obyekWisata.php">
                    <i class="bi bi-backpack-fill"></i>
                    Obyek Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "fasilitasWisata.php")) ? "active" : "" ?> " href="fasilitasWisata.php">
                    <i class="bi bi-building-fill"></i>
                    Fasilitas Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "paketWisata.php")) ? "active" : "" ?> " href="paketWisata.php">
                    <i class="bi bi-box-fill"></i>
                    Paket Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "galeri.php")) ? "active" : "" ?> " href="galeri.php">
                    <i class="bi bi-images"></i>
                    Galeri
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (str_contains($_SERVER['REQUEST_URI'], "video.php")) ? "active" : "" ?> " href="video.php">
                    <i class="bi bi-camera-video-fill"></i>
                    Video
                </a>
            </li>
        </ul>


    </div>
</nav>