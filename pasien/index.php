<?php
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
  <title>Halaman Pasien</title>
  <link rel="stylesheet" href="pasien.css">
  <script>
    // Fungsi untuk membuka halaman riwayat dengan parameter
    function showDetail(date, time) {
      const url = `riwayat.php?date=${date}&time=${time}`;
      window.location.href = url;
    }
  </script>
</head>
<body>
  <header class="header">
    <h1>Puskesmas Cinta Kasih Satu Hati</h1>
    <div class="header-buttons">
      <button class="btn-profile" onclick="location.href='profile.php'">Profile</button>
      <button class="btn-logout" onclick="location.href='/auth/logout.php'">Logout</button>
    </div>
  </header>

  <main class="main-content">
    <!-- Pendaftaran Pemeriksaan -->
    <section class="pendaftaran-section">
      <h2>Pendaftaran Pemeriksaan</h2>
      <form class="pendaftaran-form" action="jadwal_dokter" method="get">
        <div class="form-group">
          <label for="tanggal">Pilih Tanggal</label>
          <input type="date" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn-cari">Cari</button>
        </div>
      </form>
    </section>

    <!-- Riwayat Pemeriksaan -->
    <section class="riwayat-section">
      <h2>Riwayat Pemeriksaan</h2>
      <table class="riwayat-table">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh Data 1 -->
          <tr>
            <td>2025-01-02</td>
            <td>08:00</td>
            <td>Selesai</td>
            <td>
              <button class="btn-detail" onclick="showDetail('2025-01-02', '08:00')">Detail</button>
            </td>
          </tr>
          <!-- Contoh Data 2 -->
          <tr>
            <td>2025-01-03</td>
            <td>10:00</td>
            <td>Proses</td>
            <td>
              <button class="btn-detail" onclick="showDetail('2025-01-03', '10:00')">Detail</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
