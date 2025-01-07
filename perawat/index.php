<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'perawat') {
    header('Location: /auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Perawat</title>
  <link rel="stylesheet" href="perawat.css">
  <script>
    // Fungsi untuk mengarahkan ke halaman pengisian hasil pemeriksaan
    function isiPemeriksaan(id) {
      const url = `pemeriksaan_awal.php?id=${id}`;
      window.location.href = url;
    }
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Halaman Perawat</h1>
  </header>

  <main class="main-content">
    <section class="list-pasien-section">
      <h2>List Pasien Hari Ini</h2>
      <?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Ambil email dari sesi
$email = $_SESSION["username"]; // Pastikan sesi username sudah diset

// Ambil ID dokter dari tabel dokter berdasarkan email
$sql = "SELECT id FROM perawat WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $perawat_id = $row['id'];

    // Query untuk mengambil tanggal, waktu, dan status dari tabel pemeriksaan dan booking
    $sql_pemeriksaan = "
        SELECT pemeriksaan.id as id, booking.waktu as waktu, pasien.nama as nama
        FROM pemeriksaan
        JOIN booking ON booking.id = pemeriksaan.bookingid
        JOIN pasien ON pasien.id = pemeriksaan.pasienid
        WHERE booking.tgl = CURDATE() AND
              pemeriksaan.status = 0
    ";
    $stmt_pemeriksaan = $conn->prepare($sql_pemeriksaan);
    $stmt_pemeriksaan->execute();
    $result_pemeriksaan = $stmt_pemeriksaan->get_result();

    // Tampilkan data jika ada hasil
    if ($result_pemeriksaan->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='list-pasien-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
          <th>Waktu</th>
          <th>Nama</th>
          <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_pemeriksaan->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['waktu']}</td>
              <td>{$row['nama']}</td>
              <td>
                  <button onclick=\"isiPemeriksaan({$row['id']})\" class='btn-isi'>Isi</a>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Tidak ada pasien hari ini.</p>";
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
