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
            <td>John Doe</td>
          </tr>
          <tr>
            <td>NIK</td>
            <td>1234567890123456</td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>1 Januari 1990</td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td>Laki-laki</td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>Jl. Mawar No. 123</td>
          </tr>
          <tr>
            <td>No. Telepon</td>
            <td>08123456789</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>johndoe@example.com</td>
          </tr>
        </table>
        <button class="btn-edit" onclick="location.href='edit_profile.php'">Edit</button>
      </div>
    </section>
  </main>
</body>
</html>
