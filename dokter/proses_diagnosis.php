<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'dokter') {
    header('Location: /auth/login.php');
}
/* Nama2 variabel input:
    - id (id pemeriksaan)
    - diagnosis (string panjang isinya kode2 ICD digabungin jd satu string dipisah titik koma ";". Beda2 spasi dikit gapapa
                 Contoh: "A00.0 Kolera disebabkan Vibrio cholerae 01, biovar cholerae ;A01.0 Demam tifoid")
    - obat (daftar obat dipisah titik koma ";" mirip diagnosis)
    - catatan (string catatan)
*/
?>