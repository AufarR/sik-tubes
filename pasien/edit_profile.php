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
  <title>Edit Profile</title>
  <link rel="stylesheet" href="edit_profile.css">
  <link rel="stylesheet" href="pasien.css">
</head>
<body>
  <header class="header">
    <h1>Puskesmas Cinta Kasih Satu Hati</h1>
  </header>
  <main class="main-content">
    <section class="edit-profile-section">
      <h2>Edit Data Diri Pasien</h2>
      <form action="proses_edit_profile.php" method="post" class="edit-profile-form">
        <input type="hidden" name="id" value=<?php echo $data["id"]?>>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" value=<?php echo $data["nama"]?> required>
        </div>
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" id="nik" name="nik" value=<?php echo $data["nik"]?> required>
        </div>
        <div class="form-group">
          <label for="tanggal-lahir">Tanggal Lahir</label>
          <input type="date" id="tanggal-lahir" name="tgl_lahir" value=<?php echo $data["tgl_lahir"]?> required>
        </div>
        <div class="form-group">
          <label for="jenis-kelamin">Jenis Kelamin</label>
            <select id="jenis-kelamin" name="jenis_kelamin" required>
              <option value="L" <?php echo ($data["jenis_kelamin"] == "L") ? "selected" : ""; ?>>Laki-laki</option>
              <option value="P" <?php echo ($data["jenis_kelamin"] == "P") ? "selected" : ""; ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea id="alamat" name="alamat" rows="3" required><?php echo $data["alamat"]?></textarea>
        </div>
        <div class="form-group">
          <label for="telepon">No. Telepon</label>
          <input type="text" id="telepon" name="no_telp" value=<?php echo $data["no_telp"]?> required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value=<?php echo $data["email"]?> required>
        </div>
        <div class="button-group">
          <button type="submit" class="btn-save">Simpan</button>
          <button type="button" class="btn-cancel" onclick="window.history.back()">Batal</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
