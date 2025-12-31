<?php session_start(); if($_SESSION['role']!='admin') exit; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/style.css">
<div class="card">
<h2>Admin Dashboard</h2>
<a href="kegiatan.php">Kelola Kegiatan</a><br>
<a href="absensi.php">Data Absensi</a><br>
<a href="grafik.php">📊 Grafik Absensi</a><br>
<a href="../auth/logout.php">Logout</a>
</div>
