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
  <title>Tambah Obat</title>
  <link rel="stylesheet" href="tambah_obat.css">
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Tambah Obat</h1>
  </header>

  <main class="main-content">
    <form action="farmasi" method="post" class="tambah-form">
      <div class="form-group">
        <label for="nama-obat">Nama Obat</label>
        <input type="text" id="nama-obat" name="nama-obat" placeholder="Masukkan nama obat" required>
      </div>
      <div class="form-group">
        <label for="kedaluarsa">Tanggal Kedaluarsa</label>
        <input type="date" id="kedaluarsa" name="kedaluarsa" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn-submit">Simpan</button>
      </div>
    </form>
  </main>
</body>
</html>
