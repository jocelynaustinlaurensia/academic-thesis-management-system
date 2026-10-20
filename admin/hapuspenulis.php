<?php
include "includes/config.php";
if (isset($_GET['hapuspenulis'])) {
  $penulis_ID = $_GET["hapuspenulis"];
  mysqli_query($conn, "DELETE FROM penulis
            WHERE penulis_ID ='$penulis_ID'");
  echo "<script>alert('DATA PENULIS BERHASIL DIHAPUS');
            document.location='inputpenulis.php'</script>";
}
?>