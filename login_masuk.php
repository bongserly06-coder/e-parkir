<?php
session_start();
include "config/koneksi.php";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users 
                                  WHERE username='$username' 
                                  AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Parkir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container login-box">

    <h2>LOGIN SISTEM PARKIR</h2>

    <?php if (isset($error)) { ?>
        <p style="color:red; text-align:center;">
            <?= $error; ?>
        </p>
    <?php } ?>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login" class="btn-simpan">
            Login
        </button>

    </form>

</div>

</body>
</html>