<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Ujian Skripsi</title>

  <?php
  ob_start();
  session_start();
  if (!isset($_SESSION["useremail"]))
    header("location:login.php");
  ?>

  <?php
  include "bagiankode/head.php";
  ?>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
</head>

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
          <h1 class="mt-4">Edit Data Ujian Skripsi</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Ujian Skripsi</li>
          </ol>

          <?php
          include("includes/config.php");

          $id = $_GET["id"];
          $edit = mysqli_query($conn, "SELECT uk.*, bs.mhs_NPM FROM ujianskripsi uk JOIN bimbinganskripsi bs ON uk.bimbingan_ID = bs.id WHERE uk.id = '$id'");
          $row_edit = mysqli_fetch_array($edit);

          if (isset($_POST['Ubah'])) {
            $npmMHS = $_POST['npmMHS'];
            $ujianTGL = $_POST['ujianTGL'];
            $ujianWAKTU = $_POST['ujianWAKTU'];
            $fullDatetime = $ujianTGL . ' ' . $ujianWAKTU;

            $foto_ujian = $_FILES['ujianFOTO']['name'];
            $foto_tmp = $_FILES['ujianFOTO']['tmp_name'];

            if (!empty($foto_ujian)) {
              $foto_ext = strtolower(pathinfo($foto_ujian, PATHINFO_EXTENSION));
              if ($foto_ext != 'jpg' && $foto_ext != 'jpeg') {
                echo "<script>alert('Format foto harus JPG!');</script>";
              } else {
                move_uploaded_file($foto_tmp, 'uploads/' . $foto_ujian);

                $bimbQuery = mysqli_query($conn, "SELECT id FROM bimbinganskripsi WHERE mhs_NPM = '$npmMHS' ORDER BY id DESC LIMIT 1");
                $bimbRow = mysqli_fetch_array($bimbQuery);

                if ($bimbRow) {
                  $bimbingan_ID = $bimbRow['id'];

                  mysqli_query($conn, "UPDATE ujianskripsi SET
                        bimbingan_ID='$bimbingan_ID',
                        ujian_TGL='$ujianTGL',
                        ujian_WAKTU='$fullDatetime',
                        ujian_FOTO='$foto_ujian'
                        WHERE id='$id'");

                  header("location:inputujianskripsi.php");
                  exit();
                } else {
                  echo "<script>alert('Data bimbingan tidak ditemukan untuk mahasiswa ini!');</script>";
                }
              }
            } else {
              $bimbQuery = mysqli_query($conn, "SELECT id FROM bimbinganskripsi WHERE mhs_NPM = '$npmMHS' ORDER BY id DESC LIMIT 1");
              $bimbRow = mysqli_fetch_array($bimbQuery);

              if ($bimbRow) {
                $bimbingan_ID = $bimbRow['id'];

                mysqli_query($conn, "UPDATE ujianskripsi SET
                    bimbingan_ID='$bimbingan_ID',
                    ujian_TGL='$ujianTGL',
                    ujian_WAKTU='$fullDatetime'
                    WHERE id='$id'");

                header("location:inputujianskripsi.php");
                exit();
              } else {
                echo "<script>alert('Data bimbingan tidak ditemukan untuk mahasiswa ini!');</script>";
              }
            }
          }

          if (isset($_POST["kirim"])) {
            $search = $_POST["search"];
            $query = mysqli_query($conn, "select uk.*, m.mhs_NPM, m.mhs_Nama, d.dosen_NIDN, d.dosen_Nama
            from ujianskripsi uk
            join bimbinganskripsi bs on uk.bimbingan_ID = bs.id
            join mahasiswa m on bs.mhs_NPM = m.mhs_NPM
            join dosen d on bs.dosen_NIDN = d.dosen_NIDN
            where m.mhs_NPM LIKE '%" . $search . "%'");
          } else {
            $query = mysqli_query($conn, "select uk.*, m.mhs_NPM, m.mhs_Nama, d.dosen_NIDN, d.dosen_Nama
            from ujianskripsi uk
            join bimbinganskripsi bs on uk.bimbingan_ID = bs.id
            join mahasiswa m on bs.mhs_NPM = m.mhs_NPM
            join dosen d on bs.dosen_NIDN = d.dosen_NIDN");
          }

          $datamhs = mysqli_query($conn, "select DISTINCT m.mhs_NPM, m.mhs_Nama
          from bimbinganskripsi bs
          join mahasiswa m on bs.mhs_NPM = m.mhs_NPM");
          ?>

          <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
              <form method="POST" enctype="multipart/form-data">

                <div class="row mb-3 mt-5">
                  <label for="npmMHS" class="col-sm-2 col-form-label">NPM Mahasiswa</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="npmMHS" name="npmMHS">
                      <option>Cari NPM Mahasiswa</option>
                      <?php while ($row = mysqli_fetch_array($datamhs)) { ?>
                        <option value="<?php echo $row["mhs_NPM"] ?>" <?= $row_edit['mhs_NPM'] == $row["mhs_NPM"] ? 'selected' : '' ?>>
                          <?php echo $row["mhs_NPM"] . " - " . $row["mhs_Nama"] ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="ujianTGL" class="col-sm-2 col-form-label">Tanggal Ujian</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="ujianTGL" name="ujianTGL"
                      value="<?= $row_edit['ujian_TGL'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="ujianWAKTU" class="col-sm-2 col-form-label">Waktu Ujian</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" id="ujianWAKTU" name="ujianWAKTU"
                      value="<?= date('H:i', strtotime($row_edit['ujian_WAKTU'])) ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="ujianFOTO" class="col-sm-2 col-form-label">Foto Ujian</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="ujianFOTO" name="ujianFOTO" accept=".jpg, .jpeg">
                    <p class="help-block">Unggah foto saat ujian (Format: JPG). Biarkan kosong jika tidak ingin mengubah
                      foto.</p>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-2"></div>
                  <div class="col-10">
                    <input type="submit" class="btn btn-success" value="Ubah" name="Ubah">
                    <input type="reset" class="btn btn-danger" value="Batal" name="Batal">
                  </div>
                </div>
              </form>

              <div class="1"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
              <div class="jumbotron mt-5 mb-3">
                <h1 class="display-5">Daftar Ujian Skripsi</h1>
              </div>

              <form method="POST">
                <div class="form-group row mt-5 mb-3">
                  <label for="search" class="col-sm-2">Cari NPM Mahasiswa</label>
                  <div class="col-sm-6">
                    <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST["search"])) {
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
                  <th>NIDN Dosen</th>
                  <th>Nama Dosen</th>
                  <th>Tanggal Ujian</th>
                  <th>Waktu Ujian</th>
                  <th>Foto</th>
                  <th colspan="2" style="text-align: center;">Aksi</th>
                </tr>

                <?php { ?>
                  <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <tr class="danger">
                      <td><?php echo $row['mhs_NPM']; ?></td>
                      <td><?php echo $row['mhs_Nama']; ?></td>
                      <td><?php echo $row['dosen_NIDN']; ?></td>
                      <td><?php echo $row['dosen_Nama']; ?></td>
                      <td><?php echo $row['ujian_TGL']; ?></td>
                      <td><?php echo date('H:i', strtotime($row['ujian_WAKTU'])); ?></td>
                      <td>
                        <?php
                        if (!empty($row['ujian_FOTO'])) {
                          $filePath = 'uploads/' . $row['ujian_FOTO'];
                          ?>
                          <img src="<?php echo $filePath; ?>" width="100px" height="auto" alt="Foto Ujian">
                          <?php
                        } else {
                          echo "<p>Tidak ada foto.</p>";
                        }
                        ?>
                      </td>
                      <td>
                        <a href="editujianskripsi.php?id=<?php echo $row["id"] ?>" class="btn btn-success" title="EDIT">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                          </svg>
                        </a>
                      </td>
                      <td>
                        <a href="hapusujianskripsi.php?id=<?php echo $row["id"] ?>" class="btn btn-danger" title="HAPUS">
                          <i class="bi bi-trash"></i>
                        </a>
                      </td>

                    </tr>
                  <?php } ?>
                <?php } ?>
              </table>
            </div>
          </div>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>


</body>

</html>