<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Farmasi</title>
  <link rel="stylesheet" href="farmasi.css">
  <script>
    // Fungsi untuk mengarahkan ke halaman tambah obat
    function tambahObat() {
      window.location.href = "tambah_obat.html";
    }

    // Fungsi untuk mengarahkan ke halaman edit obat
    function editObat(namaObat) {
      const url = `edit_obat.html?obat=${encodeURIComponent(namaObat)}`;
      window.location.href = url;
    }

    // Fungsi untuk menghapus obat dari tabel
    function hapusObat(row) {
      if (confirm("Apakah Anda yakin ingin menghapus obat ini?")) {
        const table = document.getElementById("tabel-obat");
        table.deleteRow(row.parentNode.parentNode.rowIndex);
        alert("Obat berhasil dihapus!");
      }
    }

    // Fungsi untuk melihat daftar obat pasien
    function lihatResep(waktu, pasien) {
      const url = `daftar_obat.html?time=${waktu}&patient=${pasien}`;
      window.location.href = url;
    }
  </script>
</head>
<body>
  <header class="header">
    <div class="header-container">
      <div class="header-left">
        <h1>Cinta Kasih Satu Hati</h1>
      </div>
      <div class="header-right">
        <p class="user-info">Login sebagai: <strong>Farmasi</strong></p>
        <button class="btn-logout" onclick="window.location.href='login.html'">Logout</button>
      </div>
    </div>
  </header>

  <main class="main-content">
    <!-- List Resep -->
    <section class="resep-section">
      <h2>List Resep Obat</h2>
      <table class="resep-table">
        <thead>
          <tr>
            <th>Waktu</th>
            <th>Nama Pasien</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh Data 1 -->
          <tr>
            <td>08:00</td>
            <td>Budi Santoso</td>
            <td>
              <button class="btn-resep" onclick="lihatResep('08:00', 'Budi Santoso')">Daftar Obat</button>
            </td>
          </tr>
          <!-- Contoh Data 2 -->
          <tr>
            <td>09:00</td>
            <td>Siti Aminah</td>
            <td>
              <button class="btn-resep" onclick="lihatResep('09:00', 'Siti Aminah')">Daftar Obat</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- List Obat Puskesmas -->
    <section class="obat-section">
      <h2>List Obat Puskesmas</h2>
      <table id="tabel-obat" class="obat-table">
        <thead>
          <tr>
            <th>Nama Obat</th>
            <th>Tanggal Kedaluarsa</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh Data Obat 1 -->
          <tr>
            <td>Paracetamol</td>
            <td>2025-12-31</td>
            <td>
              <button class="btn-edit" onclick="editObat('Paracetamol')">Edit</button>
              <button class="btn-hapus" onclick="hapusObat(this)">Hapus</button>
            </td>
          </tr>
          <!-- Contoh Data Obat 2 -->
          <tr>
            <td>Amoxicillin</td>
            <td>2024-08-15</td>
            <td>
              <button class="btn-edit" onclick="editObat('Amoxicillin')">Edit</button>
              <button class="btn-hapus" onclick="hapusObat(this)">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
      <button class="btn-tambah" onclick="tambahObat()">Tambah</button>
    </section>
  </main>
</body>
</html>
