<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: /auth/login.php');
    exit();
}

// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Get the role and userid from the GET parameters
$role = $_GET['role'];
$userid = $_GET['id'];

// Initialize variables
$nama = $nid = $no_telp = $email = "";

// Determine the table to query based on the role
switch ($role) {
    case 'dokter':
        $sql = "SELECT nama, sip AS nid, no_telp, email FROM dokter WHERE userid = ?";
        break;
    case 'perawat':
        $sql = "SELECT nama, nik AS nid, no_telp, email FROM perawat WHERE userid = ?";
        break;
    case 'farmasi':
        $sql = "SELECT nama, str AS nid, no_telp, email FROM farmasi WHERE userid = ?";
        break;
    default:
        // Handle invalid role
        http_response_code(400);
        exit();
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($nama, $nid, $no_telp, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data</title>
  <link rel="stylesheet" href="edit.css">
  <link rel="stylesheet" href="admin.css">
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
    <section class="form-section">
      <h2>Edit Data</h2>
      <form action="proses_edit.php" method="post" class="edit-form">
        <input type="hidden" name="userid" value="<?php echo htmlspecialchars($userid); ?>">
        <div class="form-group">
          <label for="role">Role</label>
          <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($role); ?>" readonly>
        </div>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
          <label for="nid">Nomor Identifikasi</label>
          <input type="text" id="nid" name="nid" value="<?php echo htmlspecialchars($nid); ?>" placeholder="Masukkan Nomor (SIP/STR/NIK)" required>
        </div>
        <div class="form-group">
          <label for="no_telp">Nomor Telepon</label>
          <input type="text" id="no_telp" name="no_telp" value="<?php echo htmlspecialchars($no_telp); ?>" placeholder="Masukkan Nomor Telepon" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Masukkan Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
        </div>
        </div>
        <div class="button-group">
          <button type="submit" class="btn-submit">Simpan</button>
          <button type="button" class="btn-cancel" onclick="window.history.back()">Batal</button>
      </form>
    </section>
  </main>
</body>
</html>
