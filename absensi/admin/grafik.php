<?php
session_start();
include '../config/db.php';
if ($_SESSION['role'] != 'admin') exit;

$data = mysqli_query($conn, "
  SELECT DATE(waktu) tgl, COUNT(*) total
  FROM absensi
  GROUP BY DATE(waktu)
  ORDER BY tgl
");

$tanggal = [];
$total = [];

while ($r = mysqli_fetch_assoc($data)) {
  $tanggal[] = $r['tgl'];
  $total[] = $r['total'];
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="mb-3">📊 Grafik Absensi</h4>
      <canvas id="grafikAbsensi"></canvas>

      <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Kembali</a>
    </div>
  </div>
</div>

<script>
const ctx = document.getElementById('grafikAbsensi');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($tanggal) ?>,
    datasets: [{
      label: 'Jumlah Absensi',
      data: <?= json_encode($total) ?>,
      backgroundColor: '#4CAF50'
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: { beginAtZero: true }
    }
  }
});
</script>
