<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'pasien') {
    header('Location: /auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Pasien</title>
  <link rel="stylesheet" href="pasien.css">
  <script>
    // Fungsi untuk membuka halaman riwayat dengan parameter
    function showDetail(id) {
      const url = `riwayat.php?id=${id}`;
      window.location.href = url;
    }
  </script>
</head>
<body>
  <header class="header">
    <h1>Puskesmas Cinta Kasih Satu Hati</h1>
    <div class="header-buttons">
      <button class="btn-profile" onclick="location.href='profile.php'">Profile</button>
      <button class="btn-logout" onclick="location.href='/auth/logout.php'">Logout</button>
    </div>
  </header>

  <main class="main-content">
    <!-- Pendaftaran Pemeriksaan -->
    <section class="pendaftaran-section">
      <h2>Pendaftaran Pemeriksaan</h2>
      <form class="pendaftaran-form" action="jadwal_dokter.php" method="get">
        <div class="form-group">
          <label for="tanggal">Pilih Tanggal</label>
          <input type="date" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn-cari">Cari</button>
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

// Ambil email dari sesi
$email = $_SESSION["username"]; // Pastikan sesi username sudah diset

// Ambil ID pasien dari tabel pasien berdasarkan email
$sql_pasien = "SELECT id FROM pasien WHERE email = ?";
$stmt_pasien = $conn->prepare($sql_pasien);
$stmt_pasien->bind_param("s", $email);
$stmt_pasien->execute();
$result_pasien = $stmt_pasien->get_result();

if ($result_pasien->num_rows > 0) {
    $row_pasien = $result_pasien->fetch_assoc();
    $pasien_id = $row_pasien['id'];

    // Query untuk mengambil tanggal, waktu, dan status dari tabel pemeriksaan dan booking
    $sql_pemeriksaan = "
        SELECT pemeriksaan.id as id, pemeriksaan.status, booking.tgl, booking.waktu
        FROM pemeriksaan
        JOIN booking ON booking.id = pemeriksaan.bookingid
        WHERE pemeriksaan.pasienid = ?
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
          <th>Status</th>
          <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_pemeriksaan->fetch_assoc()) {
          // Terjemahkan status ke deskripsi
          switch ($row['status']) {
              case 0:
                  $status_desc = "Pendaftaran diterima";
                  break;
              case 1:
                  $status_desc = "Menunggu dokter";
                  break;
              case 2:
                  $status_desc = "Selesai";
                  break;
              case 3:
                  $status_desc = "Dibatalkan";
                  break;
              default:
                  $status_desc = "Status tidak dikenal";
          }

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['tgl']}</td>
              <td>{$row['waktu']}</td>
              <td>{$status_desc}</td>
              <td>
                  <button onclick=\"showDetail({$row['id']})\" class='btn-detail'>Detail</a>
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
