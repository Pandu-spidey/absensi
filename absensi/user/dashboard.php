<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'user') exit;

$kegiatan = mysqli_query($conn, "SELECT * FROM kegiatan");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/style.css">

<div class="card">
<h3>Daftar Kegiatan</h3>

<ul>
<?php while ($k = mysqli_fetch_assoc($kegiatan)): ?>

    <?php
    $cek = mysqli_query($conn, "
        SELECT * FROM absensi 
        WHERE user_id='{$_SESSION['id']}' 
        AND kegiatan_id='{$k['id']}'
    ");
    $sudah = mysqli_num_rows($cek) > 0;
    ?>

    <li style="margin-bottom:8px;">
        <b><?= $k['nama_kegiatan'] ?></b>
        (<?= $k['tanggal'] ?>)
        <br>

        <?php if (!$sudah): ?>
<span class="badge badge-info">
  <a href="absen.php?id=<?= $k['id'] ?>">Absen</a>
</span>
        <?php else: ?>
<span class="badge badge-success">✔ Sudah Absen</span>
        <?php endif; ?>

    </li>

<?php endwhile; ?>
</ul>

<hr>
<a href="riwayat.php">📄 Lihat Riwayat Absensi</a><br>
<a href="../auth/logout.php">Logout</a>
</div>
