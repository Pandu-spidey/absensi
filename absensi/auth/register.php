<?php
include '../config/db.php';

if ($_POST) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

  mysqli_query($conn,"INSERT INTO users VALUES(NULL,'$nama','$email','$pass','user')");
  header("Location: login.php");
}
?>
<link rel="stylesheet" href="../assets/style.css">
<div class="card">
<h2>Register</h2>
<form method="post">
<input name="nama" placeholder="Nama" required>
<input name="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button>Daftar</button>
</form>
</div>
