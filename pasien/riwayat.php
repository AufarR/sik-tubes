<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'pasien') {
    header('Location: /auth/login.php');
    exit();
}

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Ambil ID pemeriksaan dari parameter GET
$id_pemeriksaan = $_GET['id'];

// Ambil data riwayat pemeriksaan berdasarkan user ID
$sql = "SELECT p.*, b.tgl, b.waktu, d.nama AS nama_dokter
        FROM pemeriksaan p
        JOIN booking b ON p.bookingid = b.id
        JOIN dokter d ON p.dokterid = d.id
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
    <title>Detail Pemeriksaan</title>
    <link rel="stylesheet" href="riwayat.css">
    <link rel="stylesheet" href="pasien.css">
</head>
<body>
    <header class="header">
        <h1>Puskesmas Cinta Kasih Satu Hati</h1>
        <div class="header-buttons">
        <button class="btn-profile" onclick="history.back()">Back</button>
        </div>
  </header>
    <main class="main-content">
        <section class="detail-section">
            <h2>Riwayat Pemeriksaan</h2>
            <div class="detail-container">
                <table class="detail-table">
                    <tbody>
                        <tr>
                            <th>Waktu dan Tanggal</th>
                            <td><?php echo htmlspecialchars($data['tgl'] . ', ' . $data['waktu']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Dokter</th>
                            <td><?php echo htmlspecialchars($data['nama_dokter']); ?></td>
                        </tr>
                        <tr>
                            <th>Tensi</th>
                            <td><?php echo htmlspecialchars($data['sistol']."/".$data['diastol']); ?></td>
                        </tr>
                        <tr>
                            <th>Heart Rate</th>
                            <td><?php echo htmlspecialchars($data['heart_rate']); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                          <?php 
                            switch ($data['status']) {
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
                            echo htmlspecialchars($status_desc); ?></td>
                        </tr>
                        <tr>
                            <th>Tinggi Badan</th>
                            <td><?php echo htmlspecialchars($data['tinggi']); ?></td>
                        </tr>
                        <tr>
                            <th>Berat Badan</th>
                            <td><?php echo htmlspecialchars($data['berat']); ?></td>
                        </tr>
                        <tr>
                            <th>Suhu</th>
                            <td><?php echo htmlspecialchars($data['suhu']); ?></td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td><?php echo htmlspecialchars($data['keluhan']); ?></td>
                        </tr>
                        <tr>
                            <th>Diagnosis</th>
                            <td><?php echo str_replace(";","<br>",htmlspecialchars($data['diagnosis'])); ?></td>
                        </tr>
                        <tr>
                            <th>Obat</th>
                            <td><?php echo str_replace(";","<br>",htmlspecialchars($data['obat'])); ?></td>
                        </tr>
                        <tr>
                            <th>Catatan Lainnya</th>
                            <td><?php echo htmlspecialchars($data['catatan']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>