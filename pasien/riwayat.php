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
  <title>Detail Pemeriksaan</title>
  <link rel="stylesheet" href="riwayat.css">
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati</h1>
  </header>

  <main class="main-content">
    <section class="detail-section">
      <h2>Riwayat Pemeriksaan</h2>
      <div class="detail-container">
        <table class="detail-table">
          <tbody>
            <tr>
              <th>Waktu dan Tanggal</th>
              <td>2025-01-02, 08:00</td>
            </tr>
            <tr>
              <th>Nama Dokter</th>
              <td>Dr. Nadira Salsabila Hayat</td>
            </tr>
            <tr>
              <th>Tensi</th>
              <td>120/80 mmHg</td>
            </tr>
            <tr>
              <th>Heart Rate</th>
              <td>72 bpm</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>Selesai</td>
            </tr>
            <tr>
              <th>Tinggi Badan</th>
              <td>170 cm</td>
            </tr>
            <tr>
              <th>Berat Badan</th>
              <td>65 kg</td>
            </tr>
            <tr>
              <th>Suhu</th>
              <td>36.5°C</td>
            </tr>
            <tr>
              <th>Keluhan</th>
              <td>Nyeri pada dada bagian kiri</td>
            </tr>
            <tr>
              <th>Diagnosis</th>
              <td>Angina Pektoris</td>
            </tr>
            <tr>
              <th>Obat</th>
              <td>Amlodipine 5 mg, Aspirin 81 mg</td>
            </tr>
            <tr>
              <th>Catatan Lainnya</th>
              <td>Pasien perlu pemeriksaan lanjutan dalam 1 minggu</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</body>
</html>
