<?php
include "includes/config.php";
if (isset($_GET['hapusberita'])) {
  $berita_ID = $_GET["hapusberita"];
  mysqli_query($conn, "DELETE FROM berita
            WHERE berita_ID ='$berita_ID'");
  echo "<script>alert('DATA BERITA BERHASIL DIHAPUS');
            document.location='inputberita.php'</script>";
}
?>