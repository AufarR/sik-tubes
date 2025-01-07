<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: /auth/login.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="admin.css">
  <script>
    // Fungsi untuk mengarahkan ke halaman Tambah
    function tambahData(role) {
      window.location.href = `tambah.php?role=${role}`;
    }

    // Fungsi untuk mengarahkan ke halaman Edit dengan parameter data
    function editData(role, nama, nomor, telepon, email) {
      const url = `edit.php?role=${role}&nama=${encodeURIComponent(nama)}&nomor=${encodeURIComponent(nomor)}&telepon=${encodeURIComponent(telepon)}&email=${encodeURIComponent(email)}`;
      window.location.href = url;
    }

    // Fungsi untuk menghapus data (simulasi alert)
    function hapusData(role, nama) {
      const confirmDelete = confirm(`Apakah Anda yakin ingin menghapus ${role} bernama ${nama}?`);
      if (confirmDelete) {
        alert(`${role} bernama ${nama} telah dihapus.`);
      }
    }
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Admin Panel</h1>
  </header>

  <main class="main-content">
    <!-- List Pasien -->
    <section class="list-section">
      <h2>List Pasien</h2>
      <table class="data-table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>NIK</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Budi Santoso</td>
            <td>1990-01-15</td>
            <td>1234567890123456</td>
            <td>
              <button class="btn-hapus" onclick="hapusData('Pasien', 'Budi Santoso')">Hapus</button>
            </td>
          </tr>
          <tr>
            <td>Siti Aminah</td>
            <td>1985-06-12</td>
            <td>2345678901234567</td>
            <td>
              <button class="btn-hapus" onclick="hapusData('Pasien', 'Siti Aminah')">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- List Dokter -->
    <section class="list-section">
      <h2>List Dokter</h2>
      <table class="data-table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Nomor SIP</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Dr. Ahmad Fauzi</td>
            <td>SIP-12345</td>
            <td>081234567890</td>
            <td>ahmad.fauzi@example.com</td>
            <td>
              <button class="btn-edit" onclick="editData('Dokter', 'Dr. Ahmad Fauzi', 'SIP-12345', '081234567890', 'ahmad.fauzi@example.com')">Edit</button>
              <button class="btn-hapus" onclick="hapusData('Dokter', 'Dr. Ahmad Fauzi')">Hapus</button>
            </td>
          </tr>
          <tr>
            <td>Dr. Citra Lestari</td>
            <td>SIP-54321</td>
            <td>082345678901</td>
            <td>citra.lestari@example.com</td>
            <td>
              <button class="btn-edit" onclick="editData('Dokter', 'Dr. Citra Lestari', 'SIP-54321', '082345678901', 'citra.lestari@example.com')">Edit</button>
              <button class="btn-hapus" onclick="hapusData('Dokter', 'Dr. Citra Lestari')">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
      <button class="btn-tambah" onclick="tambahData('Dokter')">Tambah</button>
    </section>

    <!-- List Perawat -->
    <section class="list-section">
      <h2>List Perawat</h2>
      <table class="data-table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Linda Wati</td>
            <td>081234567891</td>
            <td>linda.wati@example.com</td>
            <td>
              <button class="btn-edit" onclick="editData('Perawat', 'Linda Wati', '', '081234567891', 'linda.wati@example.com')">Edit</button>
              <button class="btn-hapus" onclick="hapusData('Perawat', 'Linda Wati')">Hapus</button>
            </td>
          </tr>
          <tr>
            <td>Rina Sari</td>
            <td>082345678902</td>
            <td>rina.sari@example.com</td>
            <td>
              <button class="btn-edit" onclick="editData('Perawat', 'Rina Sari', '', '082345678902', 'rina.sari@example.com')">Edit</button>
              <button class="btn-hapus" onclick="hapusData('Perawat', 'Rina Sari')">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
      <button class="btn-tambah" onclick="tambahData('Perawat')">Tambah</button>
    </section>

    <!-- List Farmasi -->
    <section class="list-section">
      <h2>List Farmasi</h2>
      <table class="data-table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Nomor STR</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Rahmat Saputra</td>
            <td>STR-67890</td>
            <td>081345678912</td>
            <td>rahmat.saputra@example.com</td>
            <td>
              <button class="btn-edit" onclick="editData('Farmasi', 'Rahmat Saputra', 'STR-67890', '081345678912', 'rahmat.saputra@example.com')">Edit</button>
              <button class="btn-hapus" onclick="hapusData('Farmasi', 'Rahmat Saputra')">Hapus</button>
            </td>
          </tr>
          <tr>
            <td>Dina Amelia</td>
            <td>STR-09876</td>
            <td>082456789013</td>
            <td>dina.amelia@example.com</td>
            <td>
              <button class="btn-edit" onclick="editData('Farmasi', 'Dina Amelia', 'STR-09876', '082456789013', 'dina.amelia@example.com')">Edit</button>
              <button class="btn-hapus" onclick="hapusData('Farmasi', 'Dina Amelia')">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
      <button class="btn-tambah" onclick="tambahData('Farmasi')">Tambah</button>
    </section>
  </main>
</body>
</html>
