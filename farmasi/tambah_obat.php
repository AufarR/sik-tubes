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
    <section class="form-section">
      <h2>Tambah Obat</h2>
      <form action="farmasi.html" method="post" class="tambah-form">
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
