<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Cinta Kasih Satu Hati</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="register-container">
    <h1>Puskesmas Cinta Kasih Satu Hati</h1>
    <form class="register-form" action="proses_register.php" method="post">
      <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" id="nik" name="nik" placeholder="Masukkan NIK" required>
      </div>
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
      </div>
      <div class="form-group">
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" id="tgl_lahir" name="tgl_lahir" required>
      </div>
      <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
          <option value="" selected disabled>Pilih Jenis Kelamin</option>
          <option value="L">Laki-laki</option>
          <option value="P">Perempuan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
      </div>
      <div class="form-group">
        <label for="no_telp">No. Telepon</label>
        <input type="tel" id="no_telp" name="no_telp" placeholder="Masukkan No. Telepon" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan Email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
      </div>
      <button type="submit" class="btn-login">Daftar</button>
    </form>
    <button class="btn-register" onclick="location.href='login.php'">Kembali ke Login</button>
  </div>
</body>
</html>
