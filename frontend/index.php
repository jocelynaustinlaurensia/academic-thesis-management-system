<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<body>
  <?php include "includes/frontmenu.php"; ?>

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/gambaruntar.jpeg" class="d-block w-100" alt="No Picture">
        <div class="carousel-caption d-none d-md-block">
          <h5>Gedung Utama Untar</h5>
          <p>Kampus yang strategis di Kota Jakarta Barat</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/lobbyuntar.jpg" class="d-block w-100" alt="No Picture">
        <div class="carousel-caption d-none d-md-block">
          <h5>Lobby Untar</h5>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/gedung2untar.png" class="d-block w-100" alt="No Picture">
        <div class="carousel-caption d-none d-md-block">
          <h5>Gedung M Untar</h5>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container">
    <div class="row atas mt-5">
      <div class="col-sm-8">
        <?php
        $query = mysqli_query($conn, "SELECT ps.*, m.mhs_Nama FROM pesertaskripsi ps JOIN mahasiswa m ON ps.mhs_NPM = m.mhs_NPM ORDER BY ps.peserta_TGLDAFTAR DESC LIMIT 5");
        while ($row = mysqli_fetch_array($query)) {
          ?>
          <div class="d-flex mb-4">
            <?php
            $foto = !empty($row['peserta_DOKUMEN'])
              ? '../admin/images/' . $row['peserta_DOKUMEN']
              : 'images/gambaruntar.jpeg';
            ?>
            <div class="flex-shrink-0">
              <img src="<?php echo $foto; ?>" width="110" height="85" alt="Foto Peserta"
                style="object-fit: cover; border-radius: 5px;">
            </div>
            <div class="flex-grow-1 ms-3" style="margin-left: 10px; text-align: justify;">
              <h2><?php echo $row['peserta_JUDUL']; ?></h2>
              <p class="mb-1"><strong>Nama:</strong> <?php echo $row['mhs_Nama']; ?></p>
              <p class="mb-1"><strong>Tahun Akademik:</strong> <?php echo $row['peserta_THAKD']; ?> |
                <strong>Semester:</strong> <?php echo $row['peserta_SEMT']; ?>
              </p>
              <p class="mb-0"><small class="text-muted">Tanggal Daftar:
                  <?php echo date('d F Y', strtotime($row['peserta_TGLDAFTAR'])); ?></small></p>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="col-sm-4">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Jadwal Ujian Skripsi</h5>
            </div>
          </a>
          <?php
          $examQuery = mysqli_query($conn, "SELECT uk.ujian_TGL, uk.ujian_WAKTU, m.mhs_NPM, m.mhs_Nama, d.dosen_Nama
                                          FROM ujianskripsi uk
                                          JOIN bimbinganskripsi bs ON uk.bimbingan_ID = bs.id
                                          JOIN mahasiswa m ON bs.mhs_NPM = m.mhs_NPM
                                          JOIN dosen d ON bs.dosen_NIDN = d.dosen_NIDN
                                          ORDER BY uk.ujian_TGL DESC LIMIT 5");
          while ($exam = mysqli_fetch_array($examQuery)) {
            ?>
            <a href="#" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1"><?php echo $exam['mhs_Nama']; ?> (<?php echo $exam['mhs_NPM']; ?>)</h6>
                <small class="text-muted" style="text-align: right;">
                  <?php echo date('d M Y', strtotime($exam['ujian_TGL'])); ?><br>
                  <?php echo date('H:i', strtotime($exam['ujian_WAKTU'])); ?> WIB
                </small>
              </div>
              <p class="mb-1"><small>Pembimbing: <?php echo $exam['dosen_Nama']; ?></small></p>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>

    <h1 class="mt-15, mb-15" style="text-align: center">Galery Photo</h1>
    <div class="galerifoto row g-4">
      <?php
      $galleryQuery = mysqli_query($conn, "SELECT uk.ujian_FOTO, ps.peserta_JUDUL
                                         FROM ujianskripsi uk
                                         JOIN bimbinganskripsi bs ON uk.bimbingan_ID = bs.id
                                         JOIN pesertaskripsi ps ON bs.mhs_NPM = ps.mhs_NPM
                                         WHERE uk.ujian_FOTO != ''
                                         ORDER BY uk.ujian_TGL DESC LIMIT 6");
      while ($photo = mysqli_fetch_array($galleryQuery)) {
        ?>
        <figure class="col-lg-4 col-sm-6 col-xs-12">
          <img style="width:100%; height: 200px; object-fit: cover;"
            src="../admin/uploads/<?php echo $photo['ujian_FOTO']; ?>" class="figure-img img-fluid rounded"
            alt="Foto Ujian">
          <figcaption class="figure-caption"><?php echo $photo['peserta_JUDUL']; ?></figcaption>
        </figure>
      <?php } ?>
    </div>

    <h1 class="mt-5 mb-4" style="text-align: center">Berita Terbaru</h1>
    <div class="row tengah mt-3 g-4">
      <?php
      $beritaQuery = mysqli_query($conn, "SELECT b.*, k.kategori_NAMA, p.penulis_NAMA
                                           FROM berita b
                                           JOIN kategori k ON b.kategori_ID = k.kategori_ID
                                           JOIN penulis p ON b.penulis_ID = p.penulis_ID
                                           ORDER BY b.berita_TANGGAL DESC LIMIT 6");
      while ($berita = mysqli_fetch_array($beritaQuery)) {
        $gambarBerita = !empty($berita['berita_GAMBAR'])
          ? '../admin/images/' . $berita['berita_GAMBAR']
          : 'images/gambaruntar.jpeg';
        ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?php echo $gambarBerita; ?>" class="card-img-top"
                 style="height: 200px; object-fit: cover;" alt="<?php echo $berita['berita_JUDUL']; ?>">
            <div class="card-body">
              <span class="badge bg-primary mb-2"><?php echo $berita['kategori_NAMA']; ?></span>
              <h5 class="card-title"><?php echo $berita['berita_JUDUL']; ?></h5>
              <p class="card-text" style="text-align: justify;">
                <?php echo substr(strip_tags($berita['berita_ISI']), 0, 150) . '...'; ?>
              </p>
              <p class="card-text">
                <small class="text-muted">
                  Oleh: <?php echo $berita['penulis_NAMA']; ?> |
                  <?php echo date('d F Y', strtotime($berita['berita_TANGGAL'])); ?>
                </small>
              </p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    <div class="row atas mt-5">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Kategori Berita</h5>
          </div>
          <div class="list-group list-group-flush">
            <?php
            $kategoriQuery = mysqli_query($conn, "SELECT k.*, COUNT(b.berita_ID) as jumlah_berita
                                                   FROM kategori k
                                                   LEFT JOIN berita b ON k.kategori_ID = b.kategori_ID
                                                   GROUP BY k.kategori_ID
                                                   ORDER BY jumlah_berita DESC");
            while ($kategori = mysqli_fetch_array($kategoriQuery)) {
              ?>
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="mb-0"><?php echo $kategori['kategori_NAMA']; ?></h6>
                  <small class="text-muted"><?php echo $kategori['kategori_KET']; ?></small>
                </div>
                <span class="badge bg-primary rounded-pill"><?php echo $kategori['jumlah_berita']; ?></span>
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <h3 class="mb-3">Berita Pilihan</h3>
        <div class="row">
          <div class="col-sm-8">
            <?php
            $beritaPilihanQuery = mysqli_query($conn, "SELECT b.*, p.penulis_NAMA, k.kategori_NAMA
                                                        FROM berita b
                                                        JOIN penulis p ON b.penulis_ID = p.penulis_ID
                                                        JOIN kategori k ON b.kategori_ID = k.kategori_ID
                                                        ORDER BY b.berita_TANGGAL DESC LIMIT 3");
            while ($pilihan = mysqli_fetch_array($beritaPilihanQuery)) {
              $gambarPilihan = !empty($pilihan['berita_GAMBAR'])
                ? '../admin/images/' . $pilihan['berita_GAMBAR']
                : 'images/gambaruntar.jpeg';
              ?>
              <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                  <img src="<?php echo $gambarPilihan; ?>" width="120" height="90"
                       alt="<?php echo $pilihan['berita_JUDUL']; ?>"
                       style="object-fit: cover; border-radius: 5px;">
                </div>
                <div class="flex-grow-1 ms-3">
                  <span class="badge bg-secondary mb-1"><?php echo $pilihan['kategori_NAMA']; ?></span>
                  <h6><?php echo $pilihan['berita_JUDUL']; ?></h6>
                  <p class="mb-1" style="text-align: justify; font-size: 0.9em;">
                    <?php echo substr(strip_tags($pilihan['berita_ISI']), 0, 100) . '...'; ?>
                  </p>
                  <small class="text-muted">
                    <?php echo $pilihan['penulis_NAMA']; ?> |
                    <?php echo date('d M Y', strtotime($pilihan['berita_TANGGAL'])); ?>
                  </small>
                </div>
              </div>
            <?php } ?>
          </div>
          <div class="col-sm-4">
            <?php
            $adminQuery = mysqli_query($conn, "SELECT * FROM admin LIMIT 1");
            $admin = mysqli_fetch_array($adminQuery);
            if ($admin) {
              $fotoAdmin = !empty($admin['admin_FOTO'])
                ? '../admin/images/' . $admin['admin_FOTO']
                : 'images/gambaruntar.jpeg';
              ?>
              <div class="card">
                <img src="<?php echo $fotoAdmin; ?>" class="card-img-top"
                     style="height: 150px; object-fit: cover;" alt="Foto Mahasiswa">
                <div class="card-body text-center">
                  <h5 class="card-title"><?php echo $admin['admin_NAMA']; ?></h5>
                  <p class="card-text mb-1">
                    <strong>NPM:</strong> <?php echo $admin['admin_NPM']; ?>
                  </p>
                  <p class="card-text mb-0">
                    <strong>Kelas:</strong> <?php echo $admin['admin_KELAS']; ?>
                  </p>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>

</html>