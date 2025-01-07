<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: /auth/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data</title>
  <link rel="stylesheet" href="tambah.css">
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Tambah Data</h1>
  </header>

  <main class="main-content">
    <section class="form-section">
      <h2>Tambah Data</h2>
      <form action="proses_tambah.php" method="post">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
          <label for="nomor">Nomor Identifikasi</label>
          <input type="text" id="nomor" name="nomor" placeholder="Masukkan Nomor (SIP/STR/NIK)" required>
        </div>
        <div class="form-group">
          <label for="telepon">Nomor Telepon</label>
          <input type="text" id="telepon" name="telepon" placeholder="Masukkan Nomor Telepon" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Masukkan Email" required>
        </div>
        <div class="button-group">
          <button type="submit" class="btn-submit">Simpan</button>
          <button type="button" class="btn-cancel" onclick="window.location.href='admin.html';">Batal</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
