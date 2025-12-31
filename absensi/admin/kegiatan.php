<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'admin') exit;

if (isset($_POST['tambah'])) {
    mysqli_query($conn, "INSERT INTO kegiatan VALUES (
        NULL,
        '$_POST[nama]',
        '$_POST[tgl]'
    )");
}

if (isset($_POST['edit'])) {
    mysqli_query($conn, "UPDATE kegiatan SET 
        nama_kegiatan='$_POST[nama]',
        tanggal='$_POST[tgl]'
        WHERE id='$_POST[id]'
    ");
}

if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id='$_GET[hapus]'");
    header("Location: kegiatan.php");
}

$data = mysqli_query($conn, "SELECT * FROM kegiatan");
$edit = null;

if (isset($_GET['edit'])) {
    $q = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id='$_GET[edit]'");
    $edit = mysqli_fetch_assoc($q);
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/style.css">

<div class="card">
<h3><?= $edit ? 'Edit' : 'Tambah' ?> Kegiatan</h3>

<form method="post">
<input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
<input name="nama" placeholder="Nama kegiatan"
       value="<?= $edit['nama_kegiatan'] ?? '' ?>" required>

<input name="tgl" type="date"
       value="<?= $edit['tanggal'] ?? '' ?>" required>

<button name="<?= $edit ? 'edit' : 'tambah' ?>">
<?= $edit ? 'Update' : 'Tambah' ?>
</button>
</form>
</div>

<div class="card">
<h3>Daftar Kegiatan</h3>
<table width="100%">
<?php while($k=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $k['nama_kegiatan'] ?></td>
<td><?= $k['tanggal'] ?></td>
<td>
<a href="?edit=<?= $k['id'] ?>">Edit</a> |
<a href="?hapus=<?= $k['id'] ?>"
onclick="return confirm('Hapus kegiatan?')">Hapus</a>
</td>
</tr>
<?php endwhile ?>
</table>

<a href="dashboard.php">⬅ Kembali</a>
</div>
