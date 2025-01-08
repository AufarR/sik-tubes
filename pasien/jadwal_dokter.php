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

// Ambil tanggal dari input (default hari ini)
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');

// Query untuk mengambil data jadwal dan dokter
$sql = "SELECT b.id AS booking_id, b.waktu, b.status, d.nama, d.no_telp, d.email
        FROM booking b
        JOIN dokter d ON b.dokterid = d.id
        WHERE b.tgl = ? AND b.status = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tanggal);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter</title>
    <link rel="stylesheet" href="jadwal_dokter.css">
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
    <section class="jadwal-section">
        <h2>Pilih Dokter dan Waktu</h2>
        <div class="jadwal-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $waktuMulai = date('H:i', strtotime($row['waktu']));
                    $waktuSelesai = date('H:i', strtotime($waktuMulai . " +1 hour"));

                    $dokterNama = $row['nama'];

                    echo "<div class='jadwal-row'>";
                    echo "  <div class='jadwal-waktu'>";
                    echo "    <strong>{$waktuMulai}-{$waktuSelesai}</strong>";
                    echo "    <p class='kuota'>Sisa Kuota: 1</p>"; // Kuota bisa diambil dari database jika tersedia
                    echo "  </div>";
                    echo "  <div class='dokter-card'>";
                    //echo "    <img src='{$dokter['gambar']}' alt='{$dokter['nama']}'>";
                    echo "    <div class='dokter-info'>";
                    echo "      <h3>{$dokterNama}</h3>";
                    echo "      <button class='btn-pilih' onclick=\"location.href='isikeluhan.php?id={$row['booking_id']}'\">Pilih</button>";
                    echo "    </div>";
                    echo "  </div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Tidak ada jadwal yang belum dipesan pada tanggal $tanggal.</p>";
            }
            ?>
        </div>
    </section>
</main>
</body>
</html>

<?php
// Tutup koneksi
$stmt->close();
$conn->close();
?>