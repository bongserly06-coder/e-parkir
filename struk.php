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

/* ===== HITUNG DURASI PER MENIT ===== */
$masuk  = strtotime($data['jam_masuk']);
$keluar = strtotime($data['jam_keluar']);

$selisih = $keluar - $masuk;
$durasi_menit = ceil($selisih / 60);

if ($durasi_menit < 1) {
    $durasi_menit = 1;
}

$total = $data['biaya'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Struk Parkir</title>
<link rel="stylesheet" href="style.css">
</head>

<body onload="window.print()">

<div class="struk-body">

<div class="struk-center">
    <b>SISTEM PARKIR</b><br>
    Jl. Parkir No.1<br>
</div>

<hr>

Jenis      : <?= $data['jenis_kendaraan']; ?><br>
No Plat    : <?= $data['nomor_kendaraan']; ?><br>
Masuk      : <?= date("d-m-Y H:i:s", strtotime($data['jam_masuk'])); ?><br>
Keluar     : <?= date("d-m-Y H:i:s", strtotime($data['jam_keluar'])); ?><br>
Durasi     : <?= $durasi_menit; ?> menit<br>

<hr>

<div class="struk-center">
    <b>TOTAL BAYAR</b><br><br>
    <b>Rp <?= number_format($total,0,',','.'); ?></b>
</div>

<hr>

<div class="struk-center">
    Terima Kasih 🙏<br>
    Simpan Struk Ini
</div>

<br>

<div class="no-print struk-center">
    <button onclick="window.print()" class="btn-primary">🖨 Cetak Lagi</button>
    <br><br>
    <a href="index.php" class="btn-kembali">Kembali</a>
</div>

</div>

</body>
</html>