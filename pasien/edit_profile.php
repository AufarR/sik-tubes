<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'pasien') {
    header('Location: /auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="edit_profile.css">
  <link rel="stylesheet" href="pasien.css">
</head>
<body>
  <header class="header">
    <h1>Puskesmas Cinta Kasih Satu Hati</h1>
  </header>
  <main class="main-content">
    <section class="edit-profile-section">
      <h2>Edit Data Diri Pasien</h2>
      <form action="proses_edit_profile.php" method="post" class="edit-profile-form">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" value="John Doe" required>
        </div>
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" id="nik" name="nik" value="1234567890123456" required>
        </div>
        <div class="form-group">
          <label for="tanggal-lahir">Tanggal Lahir</label>
          <input type="date" id="tanggal-lahir" name="tanggal-lahir" value="1990-01-01" required>
        </div>
        <div class="form-group">
          <label for="jenis-kelamin">Jenis Kelamin</label>
          <select id="jenis-kelamin" name="jenis-kelamin" required>
            <option value="Laki-laki" selected>Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea id="alamat" name="alamat" rows="3" required>Jl. Mawar No. 123</textarea>
        </div>
        <div class="form-group">
          <label for="telepon">No. Telepon</label>
          <input type="text" id="telepon" name="telepon" value="08123456789" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="johndoe@example.com" required>
        </div>
        <div class="button-group">
          <button type="submit" class="btn-save">Simpan</button>
          <button type="button" class="btn-cancel" onclick="window.history.back()">Batal</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
