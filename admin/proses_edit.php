<?php
// Selalu lempar user yg salah ataupun ga login
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: /auth/login.php');
}
// Nama2 variabel input: userid (bukan dokterid/pasienid/dsb.), role, nama, nid (nomor identitas: NIK/STR/SIP), email, password
// Klw ada yg dikosongin/ga ada brrt ga diubah tp userid & role wajib yahh
?>