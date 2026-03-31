<?php
session_start();
include "config/koneksi.php";
date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['bayar'])) {

    $id           = mysqli_real_escape_string($conn, $_POST['id']);
    $jam_keluar   = mysqli_real_escape_string($conn, $_POST['jam_keluar']);
    $durasi_menit = (int) $_POST['durasi_menit'];
    $total        = (int) $_POST['total'];

    /* ===== FORMAT DURASI ===== */
    $jam = floor($durasi_menit / 60);
    $menit = $durasi_menit % 60;

    $durasi_format = "";
    if ($jam > 0) {
        $durasi_format .= $jam . " Jam ";
    }
    $durasi_format .= $menit . " Menit";

    /* ===== UPDATE DATABASE ===== */
    mysqli_query($conn, "UPDATE kendaraan SET
        jam_keluar='$jam_keluar',
        durasi='$durasi_format',
        biaya='$total',
        status='keluar'
        WHERE id='$id'
    ");

    header("Location: struk.php?id=$id");
    exit;
}
?>