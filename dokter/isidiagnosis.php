<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Isi Diagnosis</title>
  <link rel="stylesheet" href="isidiagnosis.css">
  <script>
    // Fungsi untuk menambah baris baru pada tabel obat
    function tambahBaris() {
      const table = document.getElementById("tabel-obat");
      const row = table.insertRow();
      const cell1 = row.insertCell(0);
      const cell2 = row.insertCell(1);

      // Kolom Nama Obat (Dropdown)
      cell1.innerHTML = `
        <select class="dropdown-obat" required>
          <option value="">Pilih Obat</option>
          <option value="Paracetamol">Paracetamol</option>
          <option value="Amoxicillin">Amoxicillin</option>
          <option value="Ibuprofen">Ibuprofen</option>
        </select>
      `;

      // Kolom Dosis (Input Text)
      cell2.innerHTML = `
        <input type="text" class="dosis-input" placeholder="Masukkan dosis" required>
      `;
    }

    // Fungsi untuk membuka halaman riwayat.html dengan parameter
    function lihatRiwayat(date, time) {
      const url = `riwayat.html?date=${date}&time=${time}`;
      window.location.href = url;
    }

    // Fungsi untuk mengambil parameter dari URL
    function getParameterByName(name) {
      const url = window.location.href;
      const params = new URLSearchParams(url.split('?')[1]);
      return params.get(name);
    }

    // Tampilkan informasi pasien saat halaman dimuat
    window.onload = function () {
      const time = getParameterByName('time') || "Tidak tersedia";
      const patient = getParameterByName('patient') || "Tidak tersedia";
      const complaint = "Nyeri pada dada bagian kiri"; // Contoh keluhan, ini dapat diambil dari backend jika tersedia

      // Tampilkan informasi pasien
      document.getElementById('info-nama-pasien').textContent = patient;
      document.getElementById('info-waktu').textContent = time;
      document.getElementById('info-keluhan').textContent = complaint;
    };
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Isi Diagnosis</h1>
  </header>

  <main class="main-content">
    <!-- Informasi Pasien -->
    <section class="info-section">
      <h2>Informasi Pasien</h2>
      <table class="info-table">
        <tr>
          <th>Nama Pasien</th>
          <td id="info-nama-pasien">Loading...</td>
        </tr>
        <tr>
          <th>Waktu</th>
          <td id="info-waktu">Loading...</td>
        </tr>
        <tr>
          <th>Keluhan</th>
          <td id="info-keluhan">Loading...</td>
        </tr>
        <tr>
          <th>Heart Rate</th>
          <td>72 bpm</td>
        </tr>
        <tr>
          <th>Suhu</th>
          <td>36.5°C</td>
        </tr>
      </table>
    </section>

    <!-- Form Diagnosis -->
    <section class="form-section">
      <h2>Form Diagnosis</h2>
      <form action="diagnosis_success.html" method="post" class="diagnosis-form">
        <!-- Kode ICD -->
        <div class="form-group">
          <label for="kode-icd">Kode ICD (Diagnosis)</label>
          <select id="kode-icd" name="kode-icd" required>
            <option value="">Pilih Kode ICD</option>
            <option value="A00">A00 - Cholera</option>
            <option value="B01">B01 - Chickenpox</option>
            <option value="C50">C50 - Breast Cancer</option>
          </select>
        </div>

        <!-- Obat dan Dosis -->
        <div class="form-group">
          <label>Obat dan Dosis</label>
          <table id="tabel-obat">
            <tr>
              <th>Nama Obat</th>
              <th>Dosis</th>
            </tr>
            <tr>
              <td>
                <select class="dropdown-obat" required>
                  <option value="">Pilih Obat</option>
                  <option value="Paracetamol">Paracetamol</option>
                  <option value="Amoxicillin">Amoxicillin</option>
                  <option value="Ibuprofen">Ibuprofen</option>
                </select>
              </td>
              <td>
                <input type="text" class="dosis-input" placeholder="Masukkan dosis" required>
              </td>
            </tr>
          </table>
          <button type="button" onclick="tambahBaris()" class="btn-tambah-baris">+ Tambah Baris</button>
        </div>

        <!-- Catatan Lainnya -->
        <div class="form-group">
          <label for="catatan">Catatan Lainnya</label>
          <textarea id="catatan" name="catatan" rows="4" placeholder="Masukkan catatan lainnya..."></textarea>
        </div>

        <!-- Tombol Simpan -->
        <div class="form-group">
          <button type="submit" class="btn-submit">Simpan</button>
        </div>
      </form>
    </section>

    <!-- Riwayat Pemeriksaan -->
    <section class="riwayat-section">
      <h2>Riwayat Pemeriksaan</h2>
      <table class="riwayat-table">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-01-02</td>
            <td>08:00</td>
            <td>Selesai</td>
            <td><button class="btn-detail" onclick="lihatRiwayat('2025-01-02', '08:00')">Detail</button></td>
          </tr>
          <tr>
            <td>2025-01-03</td>
            <td>10:00</td>
            <td>Selesai</td>
            <td><button class="btn-detail" onclick="lihatRiwayat('2025-01-03', '10:00')">Detail</button></td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
