<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Puskesmas Cinta Kasih Satu Hati</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    // Fungsi untuk mengarahkan ke halaman login
    function masuk() {
      window.location.href = "/auth/login.php";
    }

    // Fungsi untuk mengarahkan ke halaman jadwal dokter
    function lihatJadwalDokter() {
      window.location.href = "jadwal_dokter.html";
    }
  </script>
</head>
<body>
  <header class="hero-section">
    <div class="hero-content">
      <h1>Selamat Datang</h1>
      <h2>Puskesmas Cinta Kasih Satu Hati</h2>
      <p>Serve You With Love</p>
      <button class="btn-primary" onclick="masuk()">Masuk</button>
    </div>
  </header>

  <section class="info-section">
    <div class="info-card">
      <h3>Tentang Kami</h3>
      <p>Untuk mengetahui informasi mengenai Puskesmas Cinta Kasih Satu Hati, silahkan klik tombol dibawah ini</p>
      <button class="btn-secondary">Informasi Selengkapnya</button>
    </div>
    <div class="info-card">
      <h3>Jadwal Dokter</h3>
      <table>
        <thead>
          <tr>
            <th>Nama Dokter</th>
            <th>Hari</th>
            <th>Jam</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Dokter A</td>
            <td>Senin - Jumat</td>
            <td>08:00 - 15:59</td>
          </tr>
          <tr>
            <td>Dokter B</td>
            <td>Senin - Jumat</td>
            <td>16:00 - 19:59</td>
          </tr>
          <tr>
            <td>Dokter B</td>
            <td>Sabtu - Minggu</td>
            <td>09:00 - 14:59</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="info-card">
      <h3>Kontak kami</h3>
      <p><strong>Alamat</strong> - Bandung</p>
      <p><strong>Telepon</strong> - 022-872 56789</p>
      <p><strong>Whatsapp</strong> - +62811056789</p>
      <p><strong>Instagram</strong> - @ebebeb</p>
    </div>
    <div class="info-card">
      <h3>Halo Ebebeb!</h3>
      <p>📞 022-87256789</p>
      <p>Silakan menghubungi nomor Halo Grabun! untuk memperoleh informasi terkini</p>
    </div>
  </section>
</body>
</html>
