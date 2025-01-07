<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'perawat') {
    header('Location: /auth/login.php');
    exit();
}
?>
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
<?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();
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

    <!-- Form Pemeriksaan Awal -->
    <section class="form-section">
      <h2>Form Pemeriksaan Awal</h2>
      <form action="proses_pemeriksaan_awal.php" method="post" class="pemeriksaan-form">
        <div class="form-group">
          <label for="tensi">Tensi (mmHg)</label>
          <input type="text" id="tensi" name="tensi" placeholder="Masukkan dalam mmHg (Contoh: 120/80)" required>
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
