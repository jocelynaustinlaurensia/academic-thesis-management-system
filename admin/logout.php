<?php
session_start();
$_SESSION["admin_USER"];
unset($_SESSION["admin_USER"]);

session_unset(); /* session_unset hanya menghapus sesi untuk penggunaan.
Sesi ini masih ada di komputer pengguna.
dengan menggunakan session_unset, variabel masih ada */
session_destroy(); /*menghapus file session dari server */
header("location:login.php")
?>