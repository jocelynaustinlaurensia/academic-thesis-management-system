<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil Admin</title>

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
          <h1 class="mt-4">Edit Profil Admin</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Profil</li>
          </ol>

          <?php
          include("includes/config.php");

$user_email = $_SESSION["useremail"];

$edit = mysqli_query($conn, "SELECT * FROM admin WHERE admin_USER = '$user_email'");
$row_edit = mysqli_fetch_array($edit);

$admin_ID = $row_edit['admin_ID'];

          if (isset($_POST['Ubah'])) {
            $admin_NAMA = $_POST['namaADMIN'];
            $admin_NPM = $_POST['npmADMIN'];
            $admin_KELAS = $_POST['kelasADMIN'];
            $admin_USER = $_POST['userADMIN'];

            $admin_PASS = $row_edit['admin_PASS'];
            if (!empty($_POST['passADMIN'])) {
              $admin_PASS = $_POST['passADMIN'];
            }

            $admin_FOTO = $row_edit['admin_FOTO'];

            if ($_FILES['fotoADMIN']['name'] != "") {
              $admin_FOTO = $_FILES['fotoADMIN']['name'];
              $foto_tmp = $_FILES['fotoADMIN']['tmp_name'];
              move_uploaded_file($foto_tmp, 'images/' . $admin_FOTO);
            }

            mysqli_query($conn, "UPDATE admin SET
        admin_NAMA='$admin_NAMA',
        admin_NPM='$admin_NPM',
        admin_KELAS='$admin_KELAS',
        admin_USER='$admin_USER',
        admin_PASS='$admin_PASS',
        admin_FOTO='$admin_FOTO'
        WHERE admin_ID='$admin_ID'");

            echo "<script>alert('PROFIL BERHASIL DIUPDATE');
            document.location='editprofil.php'</script>";
            exit();
          }
          ?>

          <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
              <form method="POST" enctype="multipart/form-data">
                <div class="row mt-5">
                  <div class="col-md-4 text-center">
                    <div class="card mb-4">
                      <div class="card-body">
                        <h5 class="card-title mb-3">Foto Profil</h5>
                        <?php if ($row_edit['admin_FOTO'] == "" || !file_exists('images/' . $row_edit['admin_FOTO'])) { ?>
                          <img src="images/default-avatar.png" class="img-fluid rounded-circle mb-3"
                            style="width: 200px; height: 200px; object-fit: cover;" alt="Profile Photo"
                            onerror="this.src='https://via.placeholder.com/200x200?text=No+Photo'">
                        <?php } else { ?>
                          <img src="images/<?php echo $row_edit['admin_FOTO'] ?>" class="img-fluid rounded-circle mb-3"
                            style="width: 200px; height: 200px; object-fit: cover;" alt="Profile Photo">
                        <?php } ?>
                        <div class="mb-3">
                          <label for="fotoADMIN" class="form-label">Ganti Foto Profil</label>
                          <input type="file" class="form-control" id="fotoADMIN" name="fotoADMIN" accept="image/*">
                          <p class="text-muted small mt-2">
                            Foto saat ini:
                            <?php echo ($row_edit['admin_FOTO'] == '') ? 'Tidak ada foto' : '<b>' . $row_edit['admin_FOTO'] . '</b>'; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title mb-4">Informasi Profil</h5>

                        <div class="row mb-3">
                          <label for="namaADMIN" class="col-sm-3 col-form-label">Nama Lengkap</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaADMIN" name="namaADMIN" required
                              value="<?php echo $row_edit['admin_NAMA'] ?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="npmADMIN" class="col-sm-3 col-form-label">NPM</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="npmADMIN" name="npmADMIN" maxlength="20"
                              required value="<?php echo $row_edit['admin_NPM'] ?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="kelasADMIN" class="col-sm-3 col-form-label">Kelas</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="kelasADMIN" name="kelasADMIN" maxlength="50"
                              required value="<?php echo $row_edit['admin_KELAS'] ?>">
                          </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="card-title mb-4">Informasi Login</h5>

                        <div class="row mb-3">
                          <label for="userADMIN" class="col-sm-3 col-form-label">Email/Username</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="userADMIN" name="userADMIN" maxlength="30"
                              required value="<?php echo $row_edit['admin_USER'] ?>">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="passADMIN" class="col-sm-3 col-form-label">Password Baru</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="passADMIN" name="passADMIN">
                            <p class="text-muted small mt-1">Kosongkan jika tidak ingin mengubah password</p>
                          </div>
                        </div>

                        <div class="form-group row mt-4">
                          <div class="col-sm-3"></div>
                          <div class="col-sm-9">
                            <input type="submit" class="btn btn-success" value="Simpan Perubahan" name="Ubah">
                            <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
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