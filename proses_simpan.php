<?php
session_start();
include "config/koneksi.php";

date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['simpan'])) {

    $plat  = mysqli_real_escape_string($conn, $_POST['nomor_kendaraan']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis_kendaraan']);
    $jam_masuk = date("Y-m-d H:i:s");

    mysqli_query($conn, "INSERT INTO kendaraan 
        (nomor_kendaraan, jenis_kendaraan, jam_masuk) 
        VALUES ('$plat', '$jenis', '$jam_masuk')");

    header("Location: index.php");
    exit;
}
?>