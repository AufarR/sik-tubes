<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data</title>
  <link rel="stylesheet" href="edit.css">
  <script>
    // Fungsi untuk mengambil parameter dari URL
    function getParameterByName(name) {
      const url = window.location.href;
      const params = new URLSearchParams(url.split('?')[1]);
      return params.get(name);
    }

    // Tampilkan data di form saat halaman dimuat
    window.onload = function () {
      const nama = getParameterByName('nama');
      const nomor = getParameterByName('nomor');
      const telepon = getParameterByName('telepon');
      const email = getParameterByName('email');

      if (nama) document.getElementById('nama').value = nama;
      if (nomor) document.getElementById('nomor').value = nomor;
      if (telepon) document.getElementById('telepon').value = telepon;
      if (email) document.getElementById('email').value = email;
    };
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Edit Data</h1>
  </header>

  <main class="main-content">
    <section class="form-section">
      <h2>Edit Data</h2>
      <form action="edit_success" method="post">
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
        <div class="form-group">
          <button type="submit" class="btn-submit">Simpan</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
