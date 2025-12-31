<?php
session_start();
include '../config/db.php';

$cek = mysqli_query($conn, "SELECT * FROM users WHERE role='admin'");
if (mysqli_num_rows($cek) == 0) {
    $pass = password_hash("1234", PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users VALUES (
        NULL,
        'Pandu',
        'pandubaturaja15@gmail.com',
        '$pass',
        'admin'
    )");
}

include '../config/db.php';

if ($_POST) {
  $email = $_POST['email'];
  $pass  = $_POST['password'];

  $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  $u = mysqli_fetch_assoc($q);

  if ($u && password_verify($pass, $u['password'])) {
    $_SESSION['id'] = $u['id'];
    $_SESSION['role'] = $u['role'];

    header("Location: ../".$u['role']."/dashboard.php");
  } else {
    $err = "Login gagal";
  }
}
?>

<link rel="stylesheet" href="../assets/style.css">
<div class="card">
<h2>Login</h2>
<form method="post">
<input name="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button>Login</button>
<?= isset($err)?$err:'' ?>
</form>
<a href="register.php">Register</a>
</div>
