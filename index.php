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
    <title>Sistem Parkir</title>
    <link rel="stylesheet" href="./style.css?v=1">
</head>
<body>

<div class="container">

    <h2>SISTEM PARKIR</h2>
    

    <div class="top-buttons">
    <a href="logout.php" class="btn-logout">Logout</a>
    <a href="tambah_kendaraan.php" class="btn-tambah_kendaraan">+ Tambah Kendaraan</a>
    </div>
    <hr>

    <h3>Data Kendaraan Parkir</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Nomor Kendaraan</th>
            <th>Jenis Kendaraan</th>
            <th>Jam Masuk</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM kendaraan 
                             WHERE jam_keluar IS NULL");

        if (mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) {
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nomor_kendaraan']); ?></td>
            <td><?= htmlspecialchars($row['jenis_kendaraan']); ?></td>
            <td><?= htmlspecialchars($row['jam_masuk']); ?></td>
            <td>
                <a href="keluar.php?id=<?= $row['id']; ?>" class="btn-warning">
                   Proses Keluar
               </a>
            </td>
        </tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='5'>Belum ada kendaraan parkir</td></tr>";
        }
        ?>

    </table>

</div>

</body>
</html>