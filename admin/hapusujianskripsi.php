<?php
include "includes/config.php";
if (isset($_GET['id'])) {
  $id = $_GET["id"];
  mysqli_query($conn, "DELETE FROM ujiankripsi
            WHERE id ='$id'");
  echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='inputujianskripsi.php'</script>";
}
?>