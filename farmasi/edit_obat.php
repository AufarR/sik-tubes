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
  <title>Edit Obat</title>
  <link rel="stylesheet" href="edit_obat.css">
  <script>
    // Fungsi untuk memuat data obat dari URL
    window.onload = function () {
      const urlParams = new URLSearchParams(window.location.search);
      const namaObat = urlParams.get("obat") || "Tidak tersedia";

      // Isi input dengan data obat
      document.getElementById("nama-obat").value = namaObat;
    };
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Edit Obat</h1>
  </header>

  <main class="main-content">
    <form action="proses_edit_obat.php" method="post" class="edit-form">
      <div class="form-group">
        <label for="nama-obat">Nama Obat</label>
        <input type="text" id="nama-obat" name="nama-obat" required>
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
  </main>
</body>
</html>
