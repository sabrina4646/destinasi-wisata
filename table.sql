CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255),
    `password` VARCHAR(255) NOT NULL,
    `no_hp` VARCHAR(15),
    `is_admin` TINYINT(1) DEFAULT 0,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS `galeri` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `img` VARCHAR(255) NOT NULL,
    `deskripsi` TEXT,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS `video` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `url` VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS `obyek_wisata` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    `alamat` TEXT NOT NULL,
    `deskripsi` TEXT NOT NULL,
    `img` VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `fasilitas_wisata` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    `obyek_wisata_id` INT NOT NULL,
    `img` VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `paket_wisata` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `obyek_wisata_id` INT NOT NULL,
    `nama_paket` VARCHAR(255) NOT NULL,
    `img` VARCHAR(255) NOT NULL,
    `deskripsi` TEXT NOT NULL,
    `harga_paket` BIGINT NOT NULL,
    `fas_trans` BIGINT NOT NULL,
    `fas_inap` BIGINT NOT NULL,
    `fas_makan` BIGINT NOT NULL,
    `diskon` INT DEFAULT 0
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS `pemesanan` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `user_id` int NOT NULL,
    `nama` VARCHAR(255) NOT NULL,
    `no_hp` VARCHAR(15) NOT NULL,
    `paket_wisata_id` INT NOT NULL,
    `durasi` INT NOT NULL,
    `jml_peserta` INT NOT NULL,
    `diskon` BIGINT,
    `fas_inap` TINYINT(1) NOT NULL DEFAULT 0,
    `fas_trans` TINYINT(1) NOT NULL DEFAULT 0,
    `fas_makan` TINYINT(1) NOT NULL DEFAULT 0,
    `harga_paket` BIGINT,
    `jml_tagihan` BIGINT,
    `tanggal` date NOT NULL,
    `status` ENUM('Proses','Selesai','Belum Diproses') NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO `fasilitas_wisata` (`id`, `nama`, `obyek_wisata_id`, `img`) VALUES (1,'Air Terjun',1,'9608240709112422.jpg');
INSERT INTO `galeri` (`id`, `img`, `deskripsi`) VALUES (1,'9791240709135559.jpg','kebun raya '),(2,'3393240709135608.jpg','curug cidomba'),(4,'568240716192230.jpg','palutungan'),(5,'1701240716192248.jpeg','telaga biru\r\n'),(6,'5238240716192308.jpg','woodland'),(7,'9922240716192735.jpg','waduk darma'),(8,'8911240716192752.jpg','telaga remis');
INSERT INTO `obyek_wisata` (`id`, `nama`, `alamat`, `deskripsi`, `img`) VALUES (1,'Curug Sidomba','Peusing, Jalaksana, Peusing, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45554','Sesuai namanya, ikon tempat wisata ini adalah Curug Sidomba. Bagi yang belum pernah kesini, lokasi curug bisa diakses dari sebelah panggung hiburan. Jalannya tidak terlalu jauh, tinggal menuruni anak tangga dan berjalan sedikit. Namun curugnya pendek, tidak setinggi kebanyakan curug di Kuningan. ','4067240709110702.jpg'),(2,'Kebun Raya Kuningan','Padabeunghar, Kebun Raya, Kec. Pasawahan, Kabupaten Kuningan, Jawa Barat','Kebun Raya Kuningan adalah kebun raya yang dibangun dengan memanfaatkan lahan bekas perkebunan swasta di Desa Padabeunghar, Pasawahan, Kuningan.','4984240709110848.jpg'),(5,'Waduk Darma',' Desa Jagara, Kecamatan Darma, Kabupaten Kuningan, Jawa Barat.','Waduk Darma Kuningan terletak di Desa Jagara, Kecamatan Darma, Kabupaten Kuningan, Jawa Barat. Waduk Darma Kuningan yang juga berfungsi sebagai pengairan ini menjadi salah satu wisata andalan di Kabupaten Kuningan. Tempat wisata ini sering dikunjungi dalam perjalanan mudik terutama saat melintasi Jalan Raya Cirebon-Kuningan-Ciamis.','6345240716171709.jpg'),(6,'Telaga Biru','Desa Kaduela, Kecamatan Pesawahan, Kabupaten Kuningan, Jawa Barat.','Telaga Biru Cicerem menyajikan panorama telaga yang indah. Telaga Biru Cicerem terletak di Desa Kaduela, Kecamatan Pesawahan, Kabupaten Kuningan, Jawa Barat. Tempat wisata ini dapat menjadi rekomendasi liburan akhir pekan bersama keluarga. Daya Tarik Telaga Biru Cicerem Telaga Biru Cicerem memiliki keindahan dengan airnya yang bening dan dikelilingi pepohonan hijau. Daya tarik Telaga Biru Cicerem terletak pada warna air telaga yang memiliki gradasi warna antara biru dan hijau tosca. Adanya ayunan di atas telaga yang bergelantung di bawah pohon menjadi daya tarik lain dari tempat wisata ini.','4865240716171905.jpeg'),(7,'Telaga Remis','Desa Kaduela, Kecamatan Pesawahan, Kabupaten Kuningan, Jawa Barat.',' Telaga Remis terletak di Desa Kaduela, Kecamatan Pesawahan, Kabupaten Kuningan, Jawa Barat. Kawasan ini menawarkan suasana tenang dengan keindahan alaminya. Tempat wisata ini sesuai untuk Anda yang ingin mencari tempat untuk healing. Daya Tarik Telaga Remis Telaga Remis merupakan danau alami yang terletak di bawah kaki Gunung Ciremai. Danau ini memiliki luas area sekitar 13 hektar secara keseluruhan dengan luas telaga mencapai 3,35 hektar. Telaga Remis terdiri dari dua kata, yaitu telaga dan remis. Telaga berasal dari bahasa Sunda yang berarti danau, sedangkan remis sejenis kerang yang berwarna kuning yang hidup di sekitar telaga.','3566240716172128.jpg'),(8,'Woodland','Desa Setianegara, Kecamatan Cilimus, Kabupaten Kuningan.','Mampir ke salah satu destinasi wisata di Kabupaten Kuningan, Jawa Barat bisa menjadi pilihan untuk mengisi waktu liburan, termasuk periode liburan sekolah yang saat ini sedang berlangsung. Salah satu destinasi wisata Kuningan yang sedang hits adalah Woodland, yang baru saja membuka wahana baru \"Serodotan Pelangi\" atau seluncuran pelangi, dalam Bahasa Indonesia.','8957240716172339.jpg');
INSERT INTO `paket_wisata` (`id`, `obyek_wisata_id`, `nama_paket`, `img`, `deskripsi`, `harga_paket`, `fas_trans`, `fas_inap`, `fas_makan`, `diskon`) VALUES (1,1,'Paket Libur Sekolah Curug Sidomba','8170240709132836.jpg','yuk liburak ke curug sidomba',20000,650000,750000,500000,0),(3,2,'Paket Camping Kebun Raya','5384240716193139.jpg','Bisa menikmati suasana kebun raya kuningan, dekat dengan gunung ciremai',50000,1200000,1000000,1300000,3),(4,8,'Paket Liburan Keluarga Woodland','3814240716193321.jpg','Liburan seru sekeluarga di woodland',20000,300000,1500000,7500000,0),(5,6,'Paket Kemah Hemat Telaga Biru','725240716220905.jpeg','Berkemah sambil menikmati indahnya telaga biru super cantik',25000,900000,500000,700000,0);
INSERT INTO `pemesanan` (`id`, `user_id`, `nama`, `no_hp`, `paket_wisata_id`, `durasi`, `jml_peserta`, `diskon`, `fas_inap`, `fas_trans`, `fas_makan`, `harga_paket`, `jml_tagihan`, `tanggal`, `status`) VALUES (1,2,'yudi','082522',3,1,1,0,1,1,1,3550000,3550000,'2024-07-27','Selesai'),(3,2,'yudi','082522',3,1,1,0,1,1,1,3550000,3550000,'2024-07-27','Proses'),(5,2,'yudi','082522',3,1,2,213000,1,1,1,3550000,6887000,'2024-07-27','Belum Diproses');
INSERT INTO `users` (`id`, `nama`, `username`, `password`, `no_hp`, `is_admin`) VALUES (1,'admin','admin','21232f297a57a5a743894a0e4a801fc3',NULL,1),(2,'yudi','yudi123','25f9e794323b453885f5181f1b624d0b','082522',0);
INSERT INTO `video` (`id`, `url`) VALUES (2,'https://www.youtube.com/embed/1LMri_--m1E?si=502-llWWIi5niLFJ'),(3,'https://www.youtube.com/embed/CCMhRhi6ZyE?si=23tCP6efqh-xYpEt');
