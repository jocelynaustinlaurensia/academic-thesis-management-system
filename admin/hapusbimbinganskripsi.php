<?php
    include "includes/config.php";
    if(isset($_GET['id']))
    {
        $id = $_GET["id"];
        mysqli_query($conn, "DELETE FROM bimbinganskripsi
            WHERE id ='$id'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='inputbimbinganskripsi.php'</script>";
    }
?>