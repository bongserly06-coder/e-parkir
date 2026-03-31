<?php
session_start();
include "config/koneksi.php";

if (isset($_POST['id'])) {

    $id         = $_POST['id'];
    $jam_keluar = $_POST['jam_keluar'];
    $durasi     = $_POST['durasi'];
    $total      = $_POST['total'];

    mysqli_query($conn, "UPDATE kendaraan SET
        jam_keluar='$jam_keluar',
        durasi='$durasi',
        biaya='$total',
        status='keluar'
        WHERE id='$id'
    ");

    header("Location: struk.php?id=$id");
    exit;
}
?>