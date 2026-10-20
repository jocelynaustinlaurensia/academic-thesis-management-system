<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Kategori</title>

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
          <h1 class="mt-4">Edit Data Kategori</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Kategori</li>
          </ol>

          <?php
          include("includes/config.php");

          $kategori_ID_to_edit = $_GET["ubahkategori"];
          $edit = mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_ID = '$kategori_ID_to_edit'");
          $row_edit = mysqli_fetch_array($edit);

          if (isset($_POST['Ubah'])) {
            $kategori_ID = $_POST['kategoriID'];
            $kategori_NAMA = $_POST['namaKATEGORI'];
            $kategori_KET = $_POST['ketKATEGORI'];

            mysqli_query($conn, "UPDATE kategori SET
        kategori_ID='$kategori_ID',
        kategori_NAMA='$kategori_NAMA',
        kategori_KET='$kategori_KET'
        WHERE kategori_ID='$kategori_ID_to_edit'");

            header("location:inputkategori.php");
            exit();
          }

          if (isset($_POST["kirim"])) {
            $search = $_POST["search"];
            $query = mysqli_query($conn, "select * from kategori
                            where kategori_NAMA LIKE '%" . $search . "%'
                            OR kategori_ID LIKE '%" . $search . "%'
                            order by kategori_ID");
          } else {
            $query = mysqli_query($conn, "select * from kategori
                            order by kategori_ID");
          }
          ?>

          <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
              <form method="POST">
                <div class="row mb-3 mt-5">
                  <label for="kategoriID" class="col-sm-2 col-form-label">Kode Kategori</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="kategoriID" name="kategoriID" maxlength="4"
                      value="<?php echo $row_edit['kategori_ID'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="namaKATEGORI" class="col-sm-2 col-form-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaKATEGORI" name="namaKATEGORI" maxlength="30"
                      value="<?php echo $row_edit['kategori_NAMA'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="ketKATEGORI" class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="ketKATEGORI" name="ketKATEGORI" rows="3"
                      maxlength="120"><?php echo $row_edit['kategori_KET'] ?></textarea>
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
                <h1 class="display-5">Daftar Kategori</h1>
              </div>

              <form method="POST">
                <div class="form-group row mt-5 mb-3">
                  <label for="search" class="col-sm-2">Cari Kategori</label>
                  <div class="col-sm-6">
                    <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST["search"])) {
                      echo $_POST["search"];
                    } ?>" placeholder="Cari Kode atau Nama">
                  </div>
                  <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
                </div>
              </form>
              <table class="table table-striped table-success">
                <tr class="info">
                  <th>No</th>
                  <th>Kode Kategori</th>
                  <th>Nama Kategori</th>
                  <th>Keterangan</th>
                  <th colspan="2" style="text-align: center;">Aksi</th>
                </tr>

                <?php
                $nomor = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                  <tr class="danger">
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['kategori_ID']; ?></td>
                    <td><?php echo $row['kategori_NAMA']; ?></td>
                    <td><?php echo $row['kategori_KET']; ?></td>
                    <td>
                      <a href="editkategori.php?ubahkategori=<?php echo $row["kategori_ID"] ?>" class="btn btn-success"
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
                      <a href="hapuskategori.php?hapuskategori=<?php echo $row["kategori_ID"] ?>" class="btn btn-danger"
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