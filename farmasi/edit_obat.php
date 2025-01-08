<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'farmasi') {
    header('Location: /auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Obat</title>
  <link rel="stylesheet" href="edit_obat.css">
  <link rel="stylesheet" href="farmasi.css">
  <script>
    // Fungsi untuk memuat data obat dari URL
    window.onload = function () {
      const urlParams = new URLSearchParams(window.location.search);
      const namaObat = urlParams.get("obat") || "Tidak tersedia";

      // Isi input dengan data obat
      document.getElementById("nama-obat").value = namaObat;
    };
  </script>
</head>
<body>
  <header class="header">
    <h1>Puskesma Cinta Kasih Satu Hati</h1>
    <div class="header-buttons">
      <button class="btn-profile" onclick="history.back()">Back</button>
      <button class="btn-logout" onclick="location.href='/auth/logout.php'">Logout</button>
    </div>
  </header>

  <main class="main-content">
    <h2>Edit Informasi Obat</h2>

<?php

include_once("../lib/connection.php");
$conn = connectDB();

// Prepare and bind parameters
$stmt = $conn->prepare("SELECT * FROM obat WHERE id=?");
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$stmt->bind_result($id, $nama, $tgl_exp);

// Fetch data & print HTML
while ($stmt->fetch()) {
    echo '
    <form action="proses_edit_obat.php" method="post" class="edit-form">
        <input type="hidden" name="id" value="' . $id .'">
        <div class="form-group">
            <label for="nama-obat">Nama Obat</label>
            <input type="text" id="nama" name="nama" value="' . $nama . '" required>
        </div>
        <div class="form-group">
            <label for="kedaluarsa">Tanggal Kedaluarsa</label>
            <input type="date" id="kedaluarsa" name="tgl_exp" value="'.$tgl_exp.'" required>
        </div>
        <div class="button-group">
            <button type="submit" class="btn-submit">Simpan</button>
            <button type="button" class="btn-cancel" onclick="window.history.back()">Batal</button>
        </div>
    </form>
    ';
}

$stmt->close();
$conn->close();

?>
  </main>
</body>
</html>
