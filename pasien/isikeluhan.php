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
  <title>Isi Keluhan</title>
  <link rel="stylesheet" href="isikeluhan.css">
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
    <section class="keluhan-section">
      <h2>Isi Keluhan</h2>
      <form action="proses_pendaftaran.php" method="post" class="keluhan-form">
      <?php
      $bookingid = isset($_GET['id']) ? $_GET['id'] : '';
      ?>
      <input type="hidden" name="bookingid" value="<?php echo htmlspecialchars($bookingid); ?>">
        <div class="form-group">
          <label for="keluhan">Isi Keluhan Anda</label>
          <textarea id="keluhan" name="keluhan" rows="5" placeholder="Tulis keluhan Anda di sini..." required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn-pilih">Submit</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
