<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Dokter</title>
  <link rel="stylesheet" href="dokter.css">
  <script>
    // Fungsi untuk mengarahkan ke halaman isidiagnosis.html dengan parameter URL
    function isiHasilPemeriksaan(waktu, pasien) {
      const url = `isidiagnosis.html?time=${encodeURIComponent(waktu)}&patient=${encodeURIComponent(pasien)}`;
      window.location.href = url;
    }
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Halaman Dokter</h1>
  </header>

  <main class="main-content">
    <section class="list-pasien-section">
      <h2>List Pasien Hari Ini</h2>
      <table class="list-pasien-table">
        <thead>
          <tr>
            <th>Waktu</th>
            <th>Nama Pasien</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Data Pasien 1 -->
          <tr>
            <td>08:00</td>
            <td>Budi Santoso</td>
            <td>
              <button class="btn-isi" onclick="isiHasilPemeriksaan('08:00', 'Budi Santoso')">Isi</button>
            </td>
          </tr>
          <!-- Data Pasien 2 -->
          <tr>
            <td>09:00</td>
            <td>Siti Aminah</td>
            <td>
              <button class="btn-isi" onclick="isiHasilPemeriksaan('09:00', 'Siti Aminah')">Isi</button>
            </td>
          </tr>
          <!-- Data Pasien Tambahan -->
          <tr>
            <td>10:00</td>
            <td>Ahmad Fauzi</td>
            <td>
              <button class="btn-isi" onclick="isiHasilPemeriksaan('10:00', 'Ahmad Fauzi')">Isi</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
