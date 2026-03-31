<?php
session_start();
include "config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login_masuk.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kendaraan</title>
    <link rel="stylesheet" href="./style.css?v=1">
</head>
<body>

<div class="container form-box">

    <h2>Input Kendaraan Masuk</h2>

    <!-- Tombol Atas -->
    <div class="top-buttons">
        <a href="index.php" class="btn-kembali">Kembali</a>
    </div>

    <form action="proses_simpan.php" method="POST">

        <div class="form-group">
            <label>No Plat</label>
            <input type="text" name="nomor_kendaraan" required>
        </div>

        <div class="form-group">
            <label>Jenis Kendaraan</label>
            <select name="jenis_kendaraan" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="motor">Motor</option>
                <option value="mobil">Mobil</option>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn-simpan">
            Simpan
        </button>

    </form>

</div>

</body>
</html>