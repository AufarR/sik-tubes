<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'farmasi') {
    header('Location: /auth/login.php');
}

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Ambil ID pemeriksaan dari parameter GET
$id_pemeriksaan = $_GET['id'];

// Ambil data riwayat pemeriksaan berdasarkan user ID
$sql = "SELECT p.*, b.tgl, b.waktu, d.nama AS nama_dokter, pn.nama AS nama_pasien
        FROM pemeriksaan p
        JOIN booking b ON p.bookingid = b.id
        JOIN dokter d ON p.dokterid = d.id
        JOIN pasien pn ON p.pasienid = pn.id
        WHERE p.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pemeriksaan);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Obat</title>
  <link rel="stylesheet" href="daftar_obat.css">
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Daftar Obat</h1>
  </header>

  <main class="main-content">
    <!-- Informasi Pasien -->
    <section class="info-section">
      <h2>Informasi Pemeriksaan</h2>
      <table class="info-table">
        <tr>
        <th>Tanggal dan Waktu</th>
        <td><?php echo htmlspecialchars($data['tgl'] . ', ' . $data['waktu']); ?></td>
        </tr>
        <tr>
          <th>Nama Pasien</th>
          <td><?php echo htmlspecialchars($data['nama_pasien']); ?></td>
        </tr>
        <tr>
          <th>Diagnosis</th>
          <td><?php echo str_replace(";","<br>",htmlspecialchars($data['diagnosis'])); ?></td>
        </tr>
        <tr>
          <th>Nama Dokter</th>
          <td><?php echo htmlspecialchars($data['nama_dokter']); ?></td>
        </tr>
      </table>
    </section>

    <!-- Tabel Daftar Obat -->
    <section class="obat-section">
      <h2>Resep Obat</h2>
      <table class="obat-table">
        <thead>
          <tr>
            <th>Nama Obat dan Dosis</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo str_replace(";","</td></tr><tr><td>",htmlspecialchars($data['obat'])); ?></td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>