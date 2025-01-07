<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'farmasi') {
    header('Location: /auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Farmasi</title>
  <link rel="stylesheet" href="farmasi.css">
  <script>
    // Fungsi untuk mengarahkan ke halaman tambah obat
    function tambahObat() {
      window.location.href = "tambah_obat.php";
    }

    // Fungsi untuk mengarahkan ke halaman edit obat
    function editObat(id) {
      const url = `edit_obat.php?id=${id}`;
      window.location.href = url;
    }

    // Fungsi untuk menghapus obat dari tabel
    function hapusObat(row) {
      if (confirm("Apakah Anda yakin ingin menghapus obat ini?")) {
        const table = document.getElementById("tabel-obat");
        table.deleteRow(row.parentNode.parentNode.rowIndex);
        alert("Obat berhasil dihapus!");
      }
    }

    // Fungsi untuk melihat daftar obat pasien
    function lihatResep(id) {
      const url = `daftar_obat.php?id=${id}`;
      window.location.href = url;
    }
  </script>
</head>
<body>
  <header class="header">
    <h1>Cinta Kasih Satu Hati - Halaman Farmasi</h1>
  </header>

  <main class="main-content">
    <!-- List Resep -->
    <section class="resep-section">
      <h2>List Resep Obat</h2>
      <?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();

// Ambil email dari sesi
$email = $_SESSION["username"]; // Pastikan sesi username sudah diset

// Ambil ID farmasi dari tabel farmasi berdasarkan email
$sql_farmasi = "SELECT id FROM farmasi WHERE email = ?";
$stmt_farmasi = $conn->prepare($sql_farmasi);
$stmt_farmasi->bind_param("s", $email);
$stmt_farmasi->execute();
$result_farmasi = $stmt_farmasi->get_result();

if ($result_farmasi->num_rows > 0) {
    $row_farmasi = $result_farmasi->fetch_assoc();
    $farmasi_id = $row_farmasi['id'];

    // Query untuk mengambil tanggal, waktu, dan status dari tabel pemeriksaan dan booking
    $sql_pemeriksaan = "
        SELECT pemeriksaan.id as id, booking.waktu as waktu, pasien.nama as nama
        FROM pemeriksaan
        JOIN booking ON booking.id = pemeriksaan.bookingid
        JOIN pasien ON pasien.id = pemeriksaan.pasienid
        WHERE booking.tgl = CURDATE() AND
              pemeriksaan.status = 2
    ";
    $stmt_pemeriksaan = $conn->prepare($sql_pemeriksaan);
    $stmt_pemeriksaan->execute();
    $result_pemeriksaan = $stmt_pemeriksaan->get_result();

    // Tampilkan data jika ada hasil
    if ($result_pemeriksaan->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='resep-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
          <th>Waktu</th>
          <th>Nama Pasien</th>
          <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_pemeriksaan->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['waktu']}</td>
              <td>{$row['nama']}</td>
              <td>
                  <button onclick=\"lihatResep({$row['id']})\" class='btn-isi'>Daftar Obat</a>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Tidak ada pasien hari ini.</p>";
    }
} else {
    echo "<p>Pasien tidak ditemukan.</p>";
}

// Tutup koneksi
$conn->close()
?>
    </section>

    <!-- List Obat Puskesmas -->
    <section class="obat-section">
      <h2>List Obat Puskesmas</h2>
<?php
// Create connection
include_once("../lib/connection.php");
$conn = connectDB();
$sql_obat = "
        SELECT *
        FROM obat
    ";
    $stmt_obat = $conn->prepare($sql_obat);
    $stmt_obat->execute();
    $result_obat = $stmt_obat->get_result();

    // Tampilkan data jika ada hasil
    if ($result_obat->num_rows > 0) {
      echo "<div class='table-container'>"; // Bungkus tabel dalam div untuk styling
      echo "<table class='obat-table'>"; // Gunakan kelas untuk styling tabel
      echo "<thead><tr>
          <th>Nama Obat</th>
          <th>Tanggal Kadaluarsa</th>
          <th>Aksi</th>
      </tr></thead><tbody>";

      while ($row = $result_obat->fetch_assoc()) {

          // Tampilkan data dalam tabel
          echo "<tr>
              <td>{$row['nama']}</td>
              <td>{$row['tgl_exp']}</td>
              <td>
                  <button onclick=\"editObat({$row['id']})\" class='btn-edit'>Edit</button>
                  <button onclick=\"hapusObat({$row['id']})\" class='btn-hapus'>Hapus</button>
              </td>
          </tr>";
      }

      echo "</tbody></table></div>";
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }

// Tutup koneksi
$conn->close()
?>
      <button class="btn-tambah" onclick="tambahObat()">Tambah</button>
    </section>
  </main>
</body>
</html>
