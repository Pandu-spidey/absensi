<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'admin') exit;

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=absensi.xls");

$q = mysqli_query($conn, "
    SELECT u.nama, k.nama_kegiatan, 
           DATE_FORMAT(k.tanggal, '%d-%m-%Y') AS tanggal,
           DATE_FORMAT(a.waktu, '%d-%m-%Y %H:%i:%s') AS waktu
    FROM absensi a
    JOIN users u ON a.user_id = u.id
    JOIN kegiatan k ON a.kegiatan_id = k.id
    ORDER BY a.waktu DESC
");

echo "Nama User\tKegiatan\tTanggal Kegiatan\tWaktu Absen\n";

while ($r = mysqli_fetch_assoc($q)) {
    echo "{$r['nama']}\t{$r['nama_kegiatan']}\t'{$r['tanggal']}\t'{$r['waktu']}\n";
}
