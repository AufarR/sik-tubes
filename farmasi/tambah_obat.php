<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'farmasi') {
    header('Location: /auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Obat</title>
  <link rel="stylesheet" href="edit_obat.css">
  <link rel="stylesheet" href="farmasi.css">
</head>
<body>
<header class="header">
    <h1>Puskesma Cinta Kasih Satu Hati</h1>
    <div class="header-buttons">
      <button class="btn-profile" onclick="history.back()">Back</button>
      <button class="btn-logout" onclick="location.href='/auth/logout.php'">Logout</button>
    </div>
  </header>

  <main class="main-content">
    <h2>Tambah Obat</h2>
      <form action="proses_tambah_obat.php" method="post" class="edit-form">
        <div class="form-group">
          <label for="nama-obat">Nama Obat</label>
          <input type="text" id="nama-obat" name="nama-obat" placeholder="Masukkan nama obat" required>
        </div>
        <div class="form-group">
          <label for="kedaluarsa">Tanggal Kedaluarsa</label>
          <input type="date" id="kedaluarsa" name="kedaluarsa" required>
        </div>
        <div class="button-group">
          <button type="submit" class="btn-submit">Simpan</button>
          <button type="button" class="btn-cancel" onclick="window.history.back()">Batal</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
