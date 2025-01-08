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
  <title>Admin Panel</title>
  <link rel="stylesheet" href="admin.css">
  <script>
    // Fungsi untuk mengarahkan ke halaman Tambah
    function tambahData(role) {
      window.location.href = `tambah.php?role=${role}`;
    }

    // Fungsi untuk mengarahkan ke halaman Edit dengan parameter data
    function editData(id, role) {
      const url = `edit.php?id=${id}&role=${role}`;
      window.location.href = url;
    }

    // Fungsi untuk menghapus data (simulasi alert)
    function hapusData(id, role) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'proses_hapus.php';

        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'userid';
        inputId.value = id;
        form.appendChild(inputId);

        const inputRole = document.createElement('input');
        inputRole.type = 'hidden';
        inputRole.name = 'role';
        inputRole.value = role; // Sesuaikan dengan role yang sesuai
        form.appendChild(inputRole);

        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
</head>
<body>
  <header class="header">
  <h1>Puskesma Cinta Kasih Satu Hati</h1>
    <div class="header-buttons">
      <button class="btn-logout" onclick="location.href='/auth/logout.php'">Logout</button>
    </div>
  </header>

  <main class="main-content">
    <!-- List Pasien -->
    <section class="list-section">
      <h2>List Pasien</h2>

<?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();
$sql_pasien = "
        SELECT *
        FROM pasien
    ";
    $stmt_pasien = $conn->prepare($sql_pasien);
    $stmt_pasien->execute();
    $result_pasien = $stmt_pasien->get_result();

    // Tampilkan data jika ada hasil
    if ($result_pasien->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='data-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
          <th>Nama</th>
          <th>Tanggal Lahir</th>
          <th>NIK</th>
          <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_pasien->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['nama']}</td>
              <td>{$row['tgl_lahir']}</td>
              <td>{$row['nik']}</td>
              <td>
                  <button onclick=\"hapusdata({$row['userid']},'pasien')\" class='btn-hapus'>Hapus</button>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }
?>
    </section>

    <!-- List Dokter -->
    <section class="list-section">
      <h2>List Dokter</h2>
      <?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();
$sql_dokter = "
        SELECT *
        FROM dokter
    ";
    $stmt_dokter = $conn->prepare($sql_dokter);
    $stmt_dokter->execute();
    $result_dokter = $stmt_dokter->get_result();

    // Tampilkan data jika ada hasil
    if ($result_dokter->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='data-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
            <th>Nama</th>
            <th>Nomor SIP</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_dokter->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['nama']}</td>
              <td>{$row['sip']}</td>
              <td>{$row['no_telp']}</td>
              <td>{$row['email']}</td>
              <td>
                  <button onclick=\"hapusdata({$row['userid']},'dokter')\" class='btn-edit'>Edit</button>
                  <button onclick=\"hapusdata({$row['userid']}, 'dokter')\" class='btn-hapus'>Hapus</button>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }
?>
      <button class="btn-tambah" onclick="tambahData('dokter')">Tambah</button>
    </section>

    <!-- List Perawat -->
    <section class="list-section">
      <h2>List Perawat</h2>
      <?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();
$sql_perawat = "
        SELECT *
        FROM perawat
    ";
    $stmt_perawat = $conn->prepare($sql_perawat);
    $stmt_perawat->execute();
    $result_perawat = $stmt_perawat->get_result();

    // Tampilkan data jika ada hasil
    if ($result_perawat->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='data-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_perawat->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['nama']}</td>
              <td>{$row['no_telp']}</td>
              <td>{$row['email']}</td>
              <td>
                  <button onclick=\"hapusdata({$row['userid']},'perawat')\" class='btn-edit'>Edit</button>
                  <button onclick=\"hapusdata({$row['userid']},'perawat')\" class='btn-hapus'>Hapus</button>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }
?>
      <button class="btn-tambah" onclick="tambahData('perawat')">Tambah</button>
    </section>

    <!-- List Farmasi -->
    <section class="list-section">
      <h2>List Farmasi</h2>
      <?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();
$sql_farmasi = "
        SELECT *
        FROM farmasi
    ";
    $stmt_farmasi = $conn->prepare($sql_farmasi);
    $stmt_farmasi->execute();
    $result_farmasi = $stmt_farmasi->get_result();

    // Tampilkan data jika ada hasil
    if ($result_farmasi->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='data-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
            <th>Nama</th>
            <th>Nomor STR</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_farmasi->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['nama']}</td>
              <td>{$row['str']}</td>
              <td>{$row['no_telp']}</td>
              <td>{$row['email']}</td>
              <td>
                  <button onclick=\"hapusdata({$row['userid']}, 'farmasi')\" class='btn-edit'>Edit</button>
                  <button onclick=\"hapusdata({$row['userid']}, 'farmasi')\" class='btn-hapus'>Hapus</button>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }
?>
      <button class="btn-tambah" onclick="tambahData('farmasi')">Tambah</button>
    </section>
  </main>
</body>
</html>
