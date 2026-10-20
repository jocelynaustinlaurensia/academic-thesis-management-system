<?php
include "includes/config.php";
if (isset($_GET['hapuskategori'])) {
  $kategori_ID = $_GET["hapuskategori"];
  mysqli_query($conn, "DELETE FROM kategori
            WHERE kategori_ID ='$kategori_ID'");
  echo "<script>alert('DATA KATEGORI BERHASIL DIHAPUS');
            document.location='inputkategori.php'</script>";
}
?>