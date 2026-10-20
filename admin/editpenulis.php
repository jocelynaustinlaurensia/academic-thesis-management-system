<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Penulis</title>

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
          <h1 class="mt-4">Edit Data Penulis</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Penulis</li>
          </ol>

          <?php
          include("includes/config.php");

          $penulis_ID_to_edit = $_GET["ubahpenulis"];
          $edit = mysqli_query($conn, "SELECT * FROM penulis WHERE penulis_ID = '$penulis_ID_to_edit'");
          $row_edit = mysqli_fetch_array($edit);

          if (isset($_POST['Ubah'])) {
            $penulis_ID = $_POST['idPENULIS'];
            $penulis_NAMA = $_POST['namaPENULIS'];
            $penulis_EMAIL = $_POST['emailPENULIS'];
            $penulis_BIO = $_POST['bioPENULIS'];

            $penulis_FOTO = $row_edit['penulis_FOTO'];

            if ($_FILES['fotoPENULIS']['name'] != "") {
              $penulis_FOTO = $_FILES['fotoPENULIS']['name'];
              $foto_tmp = $_FILES['fotoPENULIS']['tmp_name'];
              move_uploaded_file($foto_tmp, 'images/' . $penulis_FOTO);
            }

            mysqli_query($conn, "UPDATE penulis SET
        penulis_ID='$penulis_ID',
        penulis_NAMA='$penulis_NAMA',
        penulis_EMAIL='$penulis_EMAIL',
        penulis_BIO='$penulis_BIO',
        penulis_FOTO='$penulis_FOTO'
        WHERE penulis_ID='$penulis_ID_to_edit'");

            header("location:inputpenulis.php");
            exit();
          }

          if (isset($_POST["kirim"])) {
            $search = $_POST["search"];
            $query = mysqli_query($conn, "select * from penulis
                            where penulis_NAMA LIKE '%" . $search . "%'
                            OR penulis_ID LIKE '%" . $search . "%'
                            order by penulis_ID");
          } else {
            $query = mysqli_query($conn, "select * from penulis
                            order by penulis_ID");
          }
          ?>

          <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3 mt-5">
                  <label for="idPENULIS" class="col-sm-2 col-form-label">Kode Penulis</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="idPENULIS" name="idPENULIS" maxlength="4"
                      value="<?php echo $row_edit['penulis_ID'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="namaPENULIS" class="col-sm-2 col-form-label">Nama Penulis</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaPENULIS" name="namaPENULIS" maxlength="100"
                      value="<?php echo $row_edit['penulis_NAMA'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="emailPENULIS" class="col-sm-2 col-form-label">Email Penulis</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="emailPENULIS" name="emailPENULIS" maxlength="100"
                      value="<?php echo $row_edit['penulis_EMAIL'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="bioPENULIS" class="col-sm-2 col-form-label">Bio Penulis</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="bioPENULIS" name="bioPENULIS"
                      rows="4"><?php echo $row_edit['penulis_BIO'] ?></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fotoPENULIS" class="col-sm-2 col-form-label">Foto Penulis</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="fotoPENULIS" name="fotoPENULIS">
                    <p class="help-block">Foto saat ini:
                      <?php echo ($row_edit['penulis_FOTO'] == '') ? 'Tidak ada foto' : '<b>' . $row_edit['penulis_FOTO'] . '</b>'; ?>.
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
                <h1 class="display-5">Daftar Penulis</h1>
              </div>

              <form method="POST">
                <div class="form-group row mt-5 mb-3">
                  <label for="search" class="col-sm-2">Cari Penulis</label>
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
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Bio</th>
                  <th>Foto</th>
                  <th colspan="2" style="text-align: center;">Aksi</th>
                </tr>

                <?php
                $nomor = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                  <tr class="danger">
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['penulis_ID']; ?></td>
                    <td><?php echo $row['penulis_NAMA']; ?></td>
                    <td><?php echo $row['penulis_EMAIL']; ?></td>
                    <td><?php echo substr($row['penulis_BIO'], 0, 50); ?>...</td>
                    <td>
                      <?php if ($row['penulis_FOTO'] == "") {
                        echo "<img src='images/default-avatar.png' width='88' onerror=\"this.src='https://via.placeholder.com/88x88?text=No+Photo'\"/>";
                      } else { ?>
                        <img src="images/<?php echo $row['penulis_FOTO'] ?>" width="88" class="img-responsive" />
                      <?php } ?>
                    </td>
                    <td>
                      <a href="editpenulis.php?ubahpenulis=<?php echo $row["penulis_ID"] ?>" class="btn btn-success"
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
                      <a href="hapuspenulis.php?hapuspenulis=<?php echo $row["penulis_ID"] ?>" class="btn btn-danger"
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