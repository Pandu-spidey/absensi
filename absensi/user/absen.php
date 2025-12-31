<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['id'];
$kegiatan_id = $_GET['id'];

$cek = mysqli_query($conn, "
    SELECT * FROM absensi 
    WHERE user_id='$user_id' AND kegiatan_id='$kegiatan_id'
");

if (mysqli_num_rows($cek) > 0) {
    echo "❌ Kamu sudah absen di kegiatan ini.<br>
          <a href='dashboard.php'>Kembali</a>";
    exit;
}

mysqli_query($conn, "
    INSERT INTO absensi (user_id, kegiatan_id) 
    VALUES ('$user_id', '$kegiatan_id')
");

echo "✅ Absen berhasil!<br>
      <a href='dashboard.php'>Kembali</a>";
