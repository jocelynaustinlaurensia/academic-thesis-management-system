<!DOCTYPE html>
<html lang="en">
<?php
include "bagiankode/head.php";
?>
<?php
ob_start();
session_start();
if (!isset($_SESSION["useremail"]))
  header("location:login.php");
?>

<body class="sb-nav-fixed">

  <?php
  include "bagiankode/menunav.php";
  ?>

  <div id="layoutSidenav">

    <?php
    include "bagiankode/menu.php";
    ?>

    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Dashboard</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>

          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title></title>

            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">

            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
          </head>

          <body>

            <?php
            include("includes/config.php");

            if (isset($_POST['Simpan'])) {
              $nidnDOSEN = $_POST['nidnDOSEN'];
              $npmMHS = $_POST['npmMHS'];
              $tglBIMBINGAN = $_POST['tglBIMBINGAN'];
              $isiBIMBINGAN = $_POST['isiBIMBINGAN'];

              $peserta_DOKUMEN = $_FILES['bimbinganDOKUMEN']['name'];
              $dokumen_tmp = $_FILES['bimbinganDOKUMEN']['tmp_name'];
              move_uploaded_file($dokumen_tmp, 'uploads/' . $peserta_DOKUMEN);

              mysqli_query($conn, "INSERT INTO bimbinganskripsi
(dosen_NIDN, mhs_NPM, bimbingan_TGL, bimbingan_ISI, bimbingan_DOKUMEN)
VALUES ('$nidnDOSEN', '$npmMHS', '$tglBIMBINGAN', '$isiBIMBINGAN', '$peserta_DOKUMEN')");
              header("location:inputbimbinganskripsi.php");
            }

            if (isset($_POST["kirim"])) {
              $search = $_POST["search"];
              $query = mysqli_query($conn, "select * from bimbinganskripsi bs
              join mahasiswa m on bs.mhs_NPM = m.mhs_NPM
              join pesertaskripsi ps on ps.mhs_NPM = m.mhs_NPM
              join dosen d on bs.dosen_NIDN = d.dosen_NIDN
              where bs.mhs_NPM LIKE '%" . $search . "%'");
            } else {
              $query = mysqli_query($conn, "select * from bimbinganskripsi bs
              join mahasiswa m on bs.mhs_NPM = m.mhs_NPM
              join pesertaskripsi ps on ps.mhs_NPM = m.mhs_NPM
              join dosen d on bs.dosen_NIDN = d.dosen_NIDN");
            }

            $datamhs = mysqli_query($conn, "select m.mhs_NPM, m.mhs_Nama from pesertaskripsi ps join mahasiswa m on ps.mhs_NPM = m.mhs_NPM group by m.mhs_NPM, m.mhs_Nama");

            $datadosen = mysqli_query($conn, "select * from dosen");


            ?>

            <div class="row">
              <div class="col-1"></div>
              <div class="col-10">
                <form method="POST" enctype="multipart/form-data">
                  <div class="row mb-3 mt-5">
                    <label for="nidnDOSEN" class="col-sm-2 col-form-label">NIDN Dosen</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="nidnDOSEN" name="nidnDOSEN">
                        <option>Cari NIDN Dosen</option>
                        <?php while ($row = mysqli_fetch_array($datadosen)) { ?>
                          <option value="<?php echo $row["dosen_NIDN"] ?>">
                            <?php echo $row["dosen_NIDN"] ?>
                            <?php echo $row["dosen_Nama"] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="npmMHS" class="col-sm-2 col-form-label">NPM Mahasiswa</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="npmMHS" name="npmMHS">
                        <option>Cari NPM Mahasiswa</option>
                        <?php while ($row = mysqli_fetch_array($datamhs)) { ?>
                          <option value="<?php echo $row["mhs_NPM"] ?>">
                            <?php echo $row["mhs_NPM"] ?>
                            <?php echo $row["mhs_Nama"] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="tglBIMBINGAN" class="col-sm-2 col-form-label">Tanggal Bimbingan</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="tglBIMBINGAN" name="tglBIMBINGAN">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="isiBIMBINGAN" class="col-sm-2 col-form-label">Isi Bimbingan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="isiBIMBINGAN" name="isiBIMBINGAN" placeholder="Masukkan isi bimbingan">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="bimbinganDOKUMEN" class="col-sm-2 col-form-label">Unggah Dokumen</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="bimbinganDOKUMEN" name="bimbinganDOKUMEN" accept="application/pdf">
                      <p class="help-block">Unggah file dokumen</p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-2"></div>
                    <div class="col-10">
                      <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
                      <input type="reset" class="btn btn-danger" value="Batal" name="Batal">
                    </div>
                  </div>
                </form>

                <div class="1"></div>
              </div>

              <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <div class="jumbotron mt-5 mb-3">
                    <h1 class="display-5">Daftar Bimbingan Skripsi</h1>
                  </div>

                  <form method="POST">
                    <div class="form-group row mt-5 mb-3">
                      <label for="search" class="col-sm-2">Cari NPM Mahasiswa</label>
                      <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search"
                          value="<?php if (isset($_POST["search"])) {
                                    echo $_POST["search"];
                                  } ?>" placeholder="Cari NPM">
                      </div>
                      <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
                    </div>
                  </form>

                  <table class="table table-striped table-success">
                    <tr class="info">
                      <th>NPM</th>
                      <th>Nama Mahasiswa</th>
                      <th>Judul</th>
                      <th>NIDN</th>
                      <th>Dosen Pembimbing</th>
                      <th>Tanggal Bimbingan</th>
                      <th>Isi Bimbingan</th>
                      <th>Dokumen</th>
                      <th colspan="2" style="text-align: center;">Aksi</th>
                    </tr>

                    <?php { ?>
                      <?php while ($row = mysqli_fetch_array($query)) { ?>
                        <tr class="danger">
                          <td><?php echo $row['mhs_NPM']; ?></td>
                          <td><?php echo $row['mhs_Nama']; ?></td>
                          <td><?php echo $row['peserta_JUDUL']; ?></td>
                          <td><?php echo $row['dosen_NIDN']; ?></td>
                          <td><?php echo $row['dosen_Nama']; ?></td>
                          <td><?php echo $row['bimbingan_TGL']; ?></td>
                          <td><?php echo $row['bimbingan_ISI']; ?></td>
                          <td>
                            <?php
                            if (!empty($row['bimbingan_DOKUMEN'])) {
                              $filePath = 'uploads/' . $row['bimbingan_DOKUMEN'];
                            ?>
                              <embed
                                src="<?php echo $filePath; ?>"
                                type="application/pdf"
                                width="100%"
                                height="500px" />
                            <?php
                            } else {
                              echo "<p>Tidak ada dokumen.</p>";
                            }
                            ?>
                          </td>
                          <td>
                            <a href="editbimbinganskripsi.php?id=<?php echo $row["iD"] ?>" class="btn btn-success" title="EDIT">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                              </svg>
                            </a>
                          </td>
                          <td>
                            <a href="hapusbimbinganskripsi.php?id=<?php echo $row["iD"] ?>" class="btn btn-danger" title="HAPUS">
                              <i class="bi bi-trash"></i>
                            </a>
                          </td>

                        </tr>
                      <?php } ?>
                    <?php } ?>
                  </table>
                </div> <!--penutup class col 10 untuk tabel -->
              </div> <!--penutup class row untuk tabel -->

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
              <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

          </body>
        </div>
      </main>

      <?php
      include "bagiankode/footer.php";
      ?>

    </div>
  </div>

  <?php
  include "bagiankode/jsscript.php";
  ?>

</body>

</html>