<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'user') exit;

$q = mysqli_query($conn, "
    SELECT k.nama_kegiatan, k.tanggal, a.waktu
    FROM absensi a
    JOIN kegiatan k ON a.kegiatan_id = k.id
    WHERE a.user_id = '{$_SESSION['id']}'
    ORDER BY a.waktu DESC
");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/style.css">

<div class="card">
<h3>Riwayat Absensi</h3>

<?php if (mysqli_num_rows($q) == 0): ?>
    <p>Belum ada riwayat absensi.</p>
<?php else: ?>
    <ul>
    <?php while($r = mysqli_fetch_assoc($q)): ?>
        <li style="margin-bottom:8px;">
            <b><?= $r['nama_kegiatan'] ?></b><br>
            Tanggal kegiatan: <?= $r['tanggal'] ?><br>
            Waktu absen: <?= $r['waktu'] ?>
        </li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>

<a href="dashboard.php">⬅ Kembali</a>
</div>
