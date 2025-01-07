<?php
/*
PENTING
Sejauh ini masih belum terpakai ini page :v
*/
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'pasien') {
    header('Location: /auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Berdasarkan Tanggal</title>
  <link rel="stylesheet" href="pendaftaran_tanggal.css">
</head>
<body>
  <header class="header">
    <h1>Puskesmas Cinta Kasih Satu Hati</h1>
  </header>

  <main class="main-content">
    <!-- Pendaftaran Pemeriksaan -->
    <section class="pendaftaran-section">
      <h2>Pendaftaran Pemeriksaan</h2>
      <form class="pendaftaran-form" action="pendaftaran_success" method="post">
        <div class="form-group">
          <label for="tanggal">Tanggal dan Waktu</label>
          <input type="datetime-local" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
          <label for="dokter">Pilih Dokter</label>
          <select id="dokter" name="dokter" required>
            <option value="">Pilih Dokter</option>
            <option value="dokter1">Dr. Ani Suryani</option>
            <option value="dokter2">Dr. Budi Santoso</option>
            <option value="dokter3">Dr. Citra Lestari</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn-cari">Cari</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
