<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'admin') exit;

$keyword = $_GET['q'] ?? '';
$tgl1 = $_GET['tgl1'] ?? '';
$tgl2 = $_GET['tgl2'] ?? '';

$where = "WHERE 1=1";

if ($keyword != '') {
  $where .= " AND (u.nama LIKE '%$keyword%' OR k.nama_kegiatan LIKE '%$keyword%')";
}

if ($tgl1 != '' && $tgl2 != '') {
  $where .= " AND DATE(a.waktu) BETWEEN '$tgl1' AND '$tgl2'";
}

$q = mysqli_query($conn, "
  SELECT u.nama, k.nama_kegiatan, a.waktu
  FROM absensi a
  JOIN users u ON a.user_id = u.id
  JOIN kegiatan k ON a.kegiatan_id = k.id
  $where
  ORDER BY a.waktu DESC
");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/style.css">

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">

      <h4 class="mb-3">📋 Data Absensi</h4>

      <form method="get" class="row g-2 mb-3">
        <div class="col-md-4">
          <input type="text" name="q" class="form-control" placeholder="Cari nama / kegiatan">
        </div>
        <div class="col-md-3">
          <input type="date" name="tgl1" class="form-control">
        </div>
        <div class="col-md-3">
          <input type="date" name="tgl2" class="form-control">
        </div>
        <div class="col-md-2 d-grid">
          <button class="btn btn-primary">Filter</button>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>Nama</th>
              <th>Kegiatan</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
          <?php while($r=mysqli_fetch_assoc($q)): ?>
            <tr>
              <td><?= $r['nama'] ?></td>
              <td>
                <span class="badge bg-success">
                  <?= $r['nama_kegiatan'] ?>
                </span>
              </td>
              <td><?= date('d-m-Y H:i', strtotime($r['waktu'])) ?></td>
            </tr>
          <?php endwhile ?>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
          </tbody>
        </table>
      </div>

      <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>

    </div>
  </div>
</div>

