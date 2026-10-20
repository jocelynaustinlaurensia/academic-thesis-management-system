<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Berita</title>

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
          <h1 class="mt-4">Edit Data Berita</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Berita</li>
          </ol>

          <?php
          include("includes/config.php");

          $berita_ID_to_edit = $_GET["ubahberita"];
          $edit = mysqli_query($conn, "SELECT * FROM berita WHERE berita_ID = '$berita_ID_to_edit'");
          $row_edit = mysqli_fetch_array($edit);

          if (isset($_POST['Ubah'])) {
            $kategori_ID = $_POST['kategoriID'];
            $penulis_ID = $_POST['penulisID'];
            $berita_JUDUL = $_POST['judulBERITA'];
            $berita_ISI = $_POST['isiBERITA'];
            $berita_TANGGAL = $_POST['tglBERITA'];

            $berita_GAMBAR = $row_edit['berita_GAMBAR'];

            if ($_FILES['beritaGAMBAR']['name'] != "") {
              $berita_GAMBAR = $_FILES['beritaGAMBAR']['name'];
              $gambar_tmp = $_FILES['beritaGAMBAR']['tmp_name'];
              move_uploaded_file($gambar_tmp, 'images/' . $berita_GAMBAR);
            }

            mysqli_query($conn, "UPDATE berita SET
        kategori_ID='$kategori_ID',
        penulis_ID='$penulis_ID',
        berita_JUDUL='$berita_JUDUL',
        berita_ISI='$berita_ISI',
        berita_TANGGAL='$berita_TANGGAL',
        berita_GAMBAR='$berita_GAMBAR'
        WHERE berita_ID='$berita_ID_to_edit'");

            header("location:inputberita.php");
            exit();
          }

          if (isset($_POST["kirim"])) {
            $search = $_POST["search"];
            $query = mysqli_query($conn, "select berita.*, kategori.kategori_NAMA, penulis.penulis_NAMA from berita
                            left join kategori on berita.kategori_ID = kategori.kategori_ID
                            left join penulis on berita.penulis_ID = penulis.penulis_ID
                            where berita.berita_JUDUL LIKE '%" . $search . "%'
                            order by berita.berita_TANGGAL desc");
          } else {
            $query = mysqli_query($conn, "select berita.*, kategori.kategori_NAMA, penulis.penulis_NAMA from berita
                            left join kategori on berita.kategori_ID = kategori.kategori_ID
                            left join penulis on berita.penulis_ID = penulis.penulis_ID
                            order by berita.berita_TANGGAL desc");
          }

          $datakategori = mysqli_query($conn, "select * from kategori");
          $datapenulis = mysqli_query($conn, "select * from penulis");
          ?>

          <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3 mt-5">
                  <label for="kategoriID" class="col-sm-2 col-form-label">Kategori Berita</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="kategoriID" name="kategoriID">
                      <?php
                      mysqli_data_seek($datakategori, 0);
                      while ($row = mysqli_fetch_array($datakategori)) {
                        $selected = ($row["kategori_ID"] == $row_edit['kategori_ID']) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $row["kategori_ID"] ?>" <?php echo $selected ?>>
                          <?php echo $row["kategori_NAMA"] ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="penulisID" class="col-sm-2 col-form-label">Penulis Berita</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="penulisID" name="penulisID">
                      <?php
                      mysqli_data_seek($datapenulis, 0);
                      while ($row = mysqli_fetch_array($datapenulis)) {
                        $selected = ($row["penulis_ID"] == $row_edit['penulis_ID']) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $row["penulis_ID"] ?>" <?php echo $selected ?>>
                          <?php echo $row["penulis_NAMA"] ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="judulBERITA" class="col-sm-2 col-form-label">Judul Berita</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="judulBERITA" name="judulBERITA"
                      value="<?php echo $row_edit['berita_JUDUL'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="isiBERITA" class="col-sm-2 col-form-label">Isi Berita</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="isiBERITA" name="isiBERITA"
                      rows="5"><?php echo $row_edit['berita_ISI'] ?></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="tglBERITA" class="col-sm-2 col-form-label">Tanggal Berita</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tglBERITA" name="tglBERITA"
                      value="<?php echo $row_edit['berita_TANGGAL'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="beritaGAMBAR" class="col-sm-2 col-form-label">Unggah Gambar</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="beritaGAMBAR" name="beritaGAMBAR">
                    <p class="help-block">Gambar saat ini:
                      <?php echo ($row_edit['berita_GAMBAR'] == '') ? 'Tidak ada file' : '<b>' . $row_edit['berita_GAMBAR'] . '</b>'; ?>.
                      Unggah file baru jika ingin mengubah.
                    </p>
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
                <h1 class="display-5">Daftar Berita</h1>
              </div>

              <form method="POST">
                <div class="form-group row mt-5 mb-3">
                  <label for="search" class="col-sm-2">Cari Judul Berita</label>
                  <div class="col-sm-6">
                    <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST["search"])) {
                      echo $_POST["search"];
                    } ?>" placeholder="Cari Judul">
                  </div>
                  <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
                </div>
              </form>
              <table class="table table-striped table-success">
                <tr class="info">
                  <th>No</th>
                  <th>Kategori</th>
                  <th>Penulis</th>
                  <th>Judul</th>
                  <th>Isi</th>
                  <th>Tanggal</th>
                  <th>Gambar</th>
                  <th colspan="2" style="text-align: center;">Aksi</th>
                </tr>

                <?php
                $nomor = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                  <tr class="danger">
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['kategori_NAMA']; ?></td>
                    <td><?php echo $row['penulis_NAMA']; ?></td>
                    <td><?php echo $row['berita_JUDUL']; ?></td>
                    <td><?php echo substr($row['berita_ISI'], 0, 100); ?>...</td>
                    <td><?php echo $row['berita_TANGGAL']; ?></td>
                    <td>
                      <?php if ($row['berita_GAMBAR'] == "") {
                        echo "<img src='images/beach.jpg' width='88'/>";
                      } else { ?>
                        <img src="images/<?php echo $row['berita_GAMBAR'] ?>" width="88" class="img-responsive" />
                      <?php } ?>
                    </td>
                    <td>
                      <a href="editberita.php?ubahberita=<?php echo $row["berita_ID"] ?>" class="btn btn-success"
                        title="EDIT">
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
                      <a href="hapusberita.php?hapusberita=<?php echo $row["berita_ID"] ?>" class="btn btn-danger"
                        title="HAPUS">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>

                  </tr>
                  <?php
                  $nomor++;
                } ?>
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