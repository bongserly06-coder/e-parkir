<?php
include "config/koneksi.php";
date_default_timezone_set("Asia/Jakarta");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$data = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM kendaraan WHERE id='$id'")
);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

$masuk  = strtotime($data['jam_masuk']);
$keluar = strtotime($data['jam_keluar']);

$durasi = ceil(($keluar - $masuk)/3600);
if ($durasi < 1) $durasi = 1;

$jenis = strtolower($data['jenis_kendaraan']);

if($jenis == "motor"){
    $biaya_jam = 5000;
}else{
    $biaya_jam = 10000;
}

$total = $durasi * $biaya_jam;
?>

<!DOCTYPE html>
<html>
<head>
<title>Struk Parkir</title>
<style>
body{
    font-family: monospace;
    width: 280px;
    margin: auto;
}

.struk{
    border:1px dashed black;
    padding:10px;
    text-align:center;
}

hr{
    border:0;
    border-top:1px dashed black;
}

@media print{
    button{
        display:none;
    }
}
</style>
</head>

<body>

<div class="struk">

<h3>PARKIR KENDARAAN</h3>
<hr>

Jenis          : <?= $data['jenis_kendaraan']; ?><br>
No Kendaraan   : <?= $data['nomor_kendaraan']; ?><br>
Masuk          : <?= $data['jam_masuk']; ?><br>
Keluar         : <?= $data['jam_keluar']; ?><br>
Durasi         : <?= $durasi; ?> Jam<br>

<hr>

<b>TOTAL BAYAR</b><br>
<h2>Rp <?= number_format($total); ?></h2>

<hr>
Terima Kasih 🙏

<br><br>

<button onclick="window.print()">🖨 Cetak Struk</button>

</div>

</body>
</html>