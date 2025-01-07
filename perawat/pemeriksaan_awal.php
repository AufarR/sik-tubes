<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemeriksaan Awal</title>
  <link rel="stylesheet" href="pemeriksaan_awal.css">
  <script>
    // Fungsi untuk mengambil parameter dari URL
    function getParameterByName(name) {
      const url = window.location.href;
      const params = new URLSearchParams(url.split('?')[1]);
      return params.get(name);
    }

    // Tampilkan data pasien saat halaman dimuat
    window.onload = function () {
      const date = getParameterByName('date');
      const time = getParameterByName('time');
      const patient = getParameterByName('patient');
      const complaint = "Nyeri pada dada bagian kiri"; // Contoh data keluhan dari pasien

      // Tampilkan informasi pasien di tabel
      document.getElementById('nama-pasien').textContent = patient;
      document.getElementById('tanggal-pemeriksaan').textContent = date;
      document.getElementById('waktu-pemeriksaan').textContent = time;
      document.getElementById('keluhan-pasien').textContent = complaint;
    };
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Pemeriksaan Awal</h1>
  </header>

  <main class="main-content">
    <!-- Informasi Pasien -->
    <section class="info-section">
      <h2>Informasi Pasien</h2>
      <table class="info-table">
        <tr>
          <th>Nama Pasien</th>
          <td id="nama-pasien"></td>
        </tr>
        <tr>
          <th>Tanggal Pemeriksaan</th>
          <td id="tanggal-pemeriksaan"></td>
        </tr>
        <tr>
          <th>Waktu Pemeriksaan</th>
          <td id="waktu-pemeriksaan"></td>
        </tr>
        <tr>
          <th>Keluhan</th>
          <td id="keluhan-pasien"></td>
        </tr>
      </table>
    </section>

    <!-- Form Pemeriksaan Awal -->
    <section class="form-section">
      <h2>Form Pemeriksaan Awal</h2>
      <form action="pemeriksaan_success" method="post" class="pemeriksaan-form">
        <div class="form-group">
          <label for="tensi">Tensi (mmHg)</label>
          <input type="text" id="tensi" name="tensi" placeholder="Masukkan dalam mmHg" required>
        </div>
        <div class="form-group">
          <label for="heart-rate">Heart Rate (bpm)</label>
          <input type="number" id="heart-rate" name="heart-rate" placeholder="Masukkan dalam bpm" required>
        </div>
        <div class="form-group">
          <label for="tinggi-badan">Tinggi Badan (cm)</label>
          <input type="number" id="tinggi-badan" name="tinggi-badan" placeholder="Masukkan dalam cm" required>
        </div>
        <div class="form-group">
          <label for="berat-badan">Berat Badan (kg)</label>
          <input type="number" id="berat-badan" name="berat-badan" placeholder="Masukkan dalam kg" required>
        </div>
        <div class="form-group">
          <label for="suhu">Suhu (°C)</label>
          <input type="number" step="0.1" id="suhu" name="suhu" placeholder="Masukkan dalam °C" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn-submit">Simpan</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
