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
          <label for="role">Role</label>
          <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($_GET['role']); ?>" readonly>
        </div>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
          <label for="nid">Nomor Identifikasi</label>
          <input type="text" id="nid" name="nid" placeholder="Masukkan Nomor (SIP/STR/NIK)" required>
        </div>
        <div class="form-group">
          <label for="no_telp">Nomor Telepon</label>
          <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan Nomor Telepon" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Masukkan Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
        </div>
        <div class="button-group">
          <button type="submit" class="btn-submit">Simpan</button>
          <button type="button" class="btn-cancel" onclick="window.history.back();">Batal</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
