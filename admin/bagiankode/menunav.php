<?php

include "includes/config.php";

if (isset($_SESSION['useremail'])) {
    $email_log = $_SESSION['useremail'];
    $admin_query = mysqli_query($conn, "SELECT admin_FOTO, admin_NAMA FROM admin WHERE admin_USER = '$email_log'");
    $admin_data = mysqli_fetch_array($admin_query);
    
    $nama_admin = $admin_data['admin_NAMA'];
    $foto_db = $admin_data['admin_FOTO'];
} else {
    $nama_admin = "Admin";
    $foto_db = "";
}

if (!empty($foto_db)) {
        $foto_tampil = 'images/' . $foto_db;
    }
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand ps-3" href="dashboard.php">Start Bootstrap</a>
  
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  
  <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div>
  </form>
  
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
        
        <img src="<?php echo $foto_tampil; ?>" 
             alt="Profile" 
             class="rounded-circle"
             style="width: 30px; height: 30px; object-fit: cover; margin-right: 8px; border: 1px solid #fff;">

      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="editprofil.php">Settings</a></li>
        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>