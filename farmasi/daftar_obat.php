<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'farmasi') {
    header('Location: /auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Obat</title>
  <link rel="stylesheet" href="daftar_obat.css">
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Daftar Obat</h1>
  </header>

  <main class="main-content">
    <!-- Informasi Pasien -->
    <section class="info-section">
      <h2>Informasi Pasien</h2>
      <table class="info-table">
        <tr>
          <th>Nama Pasien</th>
          <td>Budi Santoso</td>
        </tr>
        <tr>
          <th>Waktu</th>
          <td>08:00</td>
        </tr>
        <tr>
          <th>Keluhan</th>
          <td>Nyeri pada dada bagian kiri</td>
        </tr>
        <tr>
          <th>Dokter</th>
          <td>Dr. Ahmad Fauzi</td>
        </tr>
      </table>
    </section>

    <!-- Tabel Daftar Obat -->
    <section class="obat-section">
      <h2>Resep Obat</h2>
      <table class="obat-table">
        <thead>
          <tr>
            <th>Nama Obat</th>
            <th>Dosis</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Paracetamol</td>
            <td>500mg, 3x sehari</td>
          </tr>
          <tr>
            <td>Amoxicillin</td>
            <td>250mg, 2x sehari</td>
          </tr>
          <tr>
            <td>Ibuprofen</td>
            <td>200mg, jika nyeri</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
