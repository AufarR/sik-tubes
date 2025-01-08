<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'dokter') {
    header('Location: /auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Isi Diagnosis</title>
  <link rel="stylesheet" href="isidiagnosis.css">
  <link rel="stylesheet" href="dokter.css">
  <script>
    // Fungsi untuk menambah baris baru pada tabel diagnosis
    function tambahBarisICD() {
      const table = document.getElementById("tabel-ICD");
      const row = table.insertRow();
      const cell1 = row.insertCell(0);

      // Kolom Nama ICD (Dropdown)
      cell1.innerHTML = `
        <select id="kode-icd" name="kode-icd" required>
            <option value="" disabled selected>Pilih Kode ICD</option>
<?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Ambil ID pasien dari tabel pasien berdasarkan email
$sql = "SELECT kode, deskripsi from icd";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<option value=\"{$row['kode']} {$row['deskripsi']}\">{$row['kode']} {$row['deskripsi']}</option>";
  }
    
} else {
    echo "<p>Data diagnosis tidak ditemukan.</p>";
}

// Tutup koneksi
$conn->close()
?>
        </select>
      `;
    }

    function tambahBarisObat() {
      const table = document.getElementById("tabel-obat");
      const row = table.insertRow();
      const cell1 = row.insertCell(0);
      const cell2 = row.insertCell(1);

      // Kolom Nama Obat (Dropdown)
      cell1.innerHTML = `
        <select class="dropdown-obat" required>
          <option value="" disabled selected>Pilih Obat</option>
          <?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Ambil ID pasien dari tabel pasien berdasarkan email
$sql = "SELECT nama from obat";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<option value=\"{$row['nama']}\">{$row['nama']}</option>";
  }
    
} else {
    echo "<p>Data obat tidak ditemukan.</p>";
}

// Tutup koneksi
$conn->close()
?>
        </select>
      `;

      // Kolom Dosis (Input Text)
      cell2.innerHTML = `
        <input type="text" class="dosis-input" placeholder="Masukkan dosis" required>
      `;
    }

    // Fungsi untuk membuka halaman riwayat dengan parameter
    function lihatRiwayat(id) {
      const url = `riwayat.php?id=${id}`;
      window.location.href = url;
    }

    // Fungsi untuk mengambil parameter dari URL
    function getParameterByName(name) {
      const url = window.location.href;
      const params = new URLSearchParams(url.split('?')[1]);
      return params.get(name);
    }

  </script>
</head>
<body>
  <header class="header">
    <h1>Puskesmas Cinta Kasih Satu Hati - Isi Diagnosis</h1>
    <div class="header-buttons">
      <button class="btn-profile" onclick="history.back()">Back</button>
      <button class="btn-logout" onclick="location.href='/auth/logout.php'">Logout</button>
    </div>
  </header>

  <main class="main-content">
    <!-- Informasi Pasien -->
    <section class="info-section">
      <h2>Informasi Pasien</h2>
      <table class="info-table">
      <?php

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

    // Query untuk mengambil tanggal, waktu, dan status dari tabel pemeriksaan dan booking
    $sql_pemeriksaan = "
        SELECT *
        FROM pemeriksaan
        JOIN booking ON booking.id = pemeriksaan.bookingid
        JOIN pasien ON pemeriksaan.pasienid = pasien.id
        WHERE pemeriksaan.id = ?
    ";
    $stmt_pemeriksaan = $conn->prepare($sql_pemeriksaan);
    $stmt_pemeriksaan->bind_param("i", $_GET['id']);
    $stmt_pemeriksaan->execute();
    $result_pemeriksaan = $stmt_pemeriksaan->get_result();

    // Tampilkan data jika ada hasil
    if ($result_pemeriksaan->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='info-table'>"; // Gunakan kelas untuk styling tabel
      echo "<tbody>";

      while ($row = $result_pemeriksaan->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
                  <th>Tanggal dan Waktu</th>
                  <td>".htmlspecialchars($row['tgl'].' '.$row['waktu'])."</td>
                </tr>
                <tr>
                  <th>Nama Pasien</th>
                  <td>".htmlspecialchars($row['nama'])."</td>
                </tr>
                <tr>
                  <th>Tensi</th>
                  <td>".htmlspecialchars($row['sistol'].'/'.$row['diastol'])."</td>
                </tr>
                <tr>
                  <th>Heart Rate</th>
                  <td>".htmlspecialchars($row['heart_rate'])."</td>
                </tr>
                <tr>
                  <th>Tinggi Badan</th>
                  <td>".htmlspecialchars($row['tinggi'])."</td>
                </tr>
                <tr>
                  <th>Berat</th>
                  <td>".htmlspecialchars($row['berat'])."</td>
                </tr>
                <tr>
                  <th>Suhu</th>
                  <td>".htmlspecialchars($row['suhu'])."</td>
                </tr>
                <tr>
                  <th>Keluhan</th>
                  <td>".htmlspecialchars($row['keluhan'])."</td>
                </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }

// Tutup koneksi
$conn->close()
?>
      </table>
    </section>

    <!-- Form Diagnosis -->
    <section class="form-section">
      <h2>Form Diagnosis</h2>
      <form action="proses_diagnosis.php" method="post" class="diagnosis-form">
        <!-- Kode ICD -->
        <div class="form-group">
          <table id="tabel-ICD">
            <tr>
              <th><label for="kode-icd">Kode ICD (Diagnosis)</label></th>
            </tr>
          </table>
          <button type="button" onclick="tambahBarisICD()" class="btn-tambah-baris">+ Tambah Diagnosis</button>
        </div>

        <!-- Obat dan Dosis -->
        <div class="form-group">
          <table id="tabel-obat">
            <tr>
              <th>Nama Obat</th>
              <th>Dosis</th>
            </tr>
          </table>
          <button type="button" onclick="tambahBarisObat()" class="btn-tambah-baris">+ Tambah Obat</button>
        </div>

        <!-- Catatan Lainnya -->
        <div class="form-group">
          <table>
            <tr><th><label for="catatan">Catatan Lainnya</label></th></tr>
            <tr><td>
              <textarea id="catatan" name="catatan" rows="4" placeholder="Masukkan catatan lainnya..."></textarea>
            </td></tr>
          </table>
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
      <?php

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Ambil ID pasien dari tabel pasien berdasarkan email
$sql_pasien = "SELECT pasien.id FROM pasien
JOIN pemeriksaan ON  pasien.id = pemeriksaan.pasienid 
WHERE pemeriksaan.id = ?
";
$stmt_pasien = $conn->prepare($sql_pasien);
$stmt_pasien->bind_param("s", $_GET["id"]);
$stmt_pasien->execute();
$result_pasien = $stmt_pasien->get_result();

if ($result_pasien->num_rows > 0) {
    $row_pasien = $result_pasien->fetch_assoc();
    $pasien_id = $row_pasien['id'];

    // Query untuk mengambil tanggal, waktu, dan status dari tabel pemeriksaan dan booking
    $sql_pemeriksaan = "
        SELECT pemeriksaan.id as id, dokter.nama as nama, booking.tgl as tgl, booking.waktu as waktu
        FROM pemeriksaan
        JOIN booking ON booking.id = pemeriksaan.bookingid
        JOIN dokter ON pemeriksaan.dokterid = dokter.id
        WHERE pemeriksaan.pasienid = ? AND
        pemeriksaan.status = 2
    ";
    $stmt_pemeriksaan = $conn->prepare($sql_pemeriksaan);
    $stmt_pemeriksaan->bind_param("i", $pasien_id);
    $stmt_pemeriksaan->execute();
    $result_pemeriksaan = $stmt_pemeriksaan->get_result();

    // Tampilkan data jika ada hasil
    if ($result_pemeriksaan->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='riwayat-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
          <th>Tanggal</th>
          <th>Waktu</th>
          <th>Dokter</th>
          <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_pemeriksaan->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['tgl']}</td>
              <td>{$row['waktu']}</td>
              <td>{$row['nama']}</td>
              <td>
                  <button onclick=\"lihatRiwayat({$row['id']})\" class='btn-detail'>Detail</a>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Tidak ada data riwayat pemeriksaan untuk pasien ini.</p>";
    }
} else {
    echo "<p>Pasien tidak ditemukan.</p>";
}

// Tutup koneksi
$conn->close()
?>
    </section>
  </main>
</body>
</html>
