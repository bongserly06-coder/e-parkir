<?php
session_start();
include "config/koneksi.php";
date_default_timezone_set("Asia/Jakarta");

if (!isset($_SESSION['login'])) {
    header("Location: login_masuk.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM kendaraan WHERE id='$id'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

$jam_keluar = date("Y-m-d H:i:s");

/* ===== HITUNG DURASI ===== */
$masuk  = strtotime($data['jam_masuk']);
$keluar = strtotime($jam_keluar);

$selisih_detik = $keluar - $masuk;
$durasi_menit = ceil($selisih_detik / 60);
if ($durasi_menit < 1) $durasi_menit = 1;

/* ===== TARIF ===== */
$jenis = strtolower($data['jenis_kendaraan']);

if ($jenis == "motor") {
    $tarif = 300;
} else {
    $tarif = 500;
}

$total = $durasi_menit * $tarif;

/* ===== FORMAT DURASI ===== */
$jam = floor($durasi_menit / 60);
$menit = $durasi_menit % 60;

$durasi_format = "";
if ($jam > 0) {
    $durasi_format .= $jam . " Jam ";
}
$durasi_format .= $menit . " Menit";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Parkir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container form-box">

<h2>Pembayaran Parkir</h2>

<div style="text-align:center;">
<a href="index.php" class="btn-kembali">Kembali</a>
</div>

<form action="proses_keluar.php" method="POST">

    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <input type="hidden" name="jam_keluar" value="<?= $jam_keluar; ?>">
    <input type="hidden" name="durasi_menit" value="<?= $durasi_menit; ?>">
    <input type="hidden" name="total" value="<?= $total; ?>">

    <label>Nomor Kendaraan</label>
    <input type="text" value="<?= $data['nomor_kendaraan']; ?>" readonly>

    <label>Jenis Kendaraan</label>
    <input type="text" value="<?= $data['jenis_kendaraan']; ?>" readonly>

    <label>Jam Masuk</label>
    <input type="text" value="<?= date("d-m-Y H:i:s", strtotime($data['jam_masuk'])); ?>" readonly>

    <label>Jam Keluar</label>
    <input type="text" value="<?= date("d-m-Y H:i:s", strtotime($jam_keluar)); ?>" readonly>

    <label>Durasi Parkir</label>
    <input type="text" value="<?= $durasi_format; ?>" readonly>

    <label>Total Bayar</label>
    <input type="text" value="Rp <?= number_format($total,0,',','.'); ?>" readonly>

    <button type="submit" name="bayar" class="btn-simpan">
        Bayar Sekarang
    </button>

</form>

</div>

</body>
</html>