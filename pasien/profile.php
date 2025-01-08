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

// Ambil data riwayat pemeriksaan berdasarkan user ID
$sql = "SELECT *
        FROM pasien
        WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["userid"]);
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
  <title>Profile Pasien</title>
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="pasien.css">
</head>
<body>
  <header class="header">
  <h1>Puskesmas Cinta Kasih Satu Hati</h1>
    <div class="header-buttons">
      <button class="btn-profile" onclick="history.back()">Back</button>
      <button class="btn-logout" onclick="location.href='/auth/logout.php'">Logout</button>
    </div>
  </header>

  <main class="main-content">
    <!-- Data Diri Pasien -->
    <section class="profile-section">
      <h2>Data Diri Pasien</h2>
      <div class="profile-container">
        <table class="profile-table">
          <tr>
            <th>Field</th>
            <th>Data</th>
          </tr>
          <tr>
            <td>Nama</td>
            <td><?php echo htmlspecialchars($data['nama']); ?></td>
          </tr>
          <tr>
            <td>NIK</td>
            <td><?php echo htmlspecialchars($data['nik']); ?></td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td><?php echo htmlspecialchars($data['tgl_lahir']); ?></td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td><?php echo ($data['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td><?php echo htmlspecialchars($data['alamat']); ?></td>
          </tr>
          <tr>
            <td>No. Telepon</td>
            <td><?php echo htmlspecialchars($data['no_telp']); ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><?php echo htmlspecialchars($data['email']); ?></td>
          </tr>
        </table>
        <button class="btn-edit" onclick="location.href='edit_profile.php'">Edit</button>
      </div>
    </section>
  </main>
</body>
</html>
