<?php
// Pengaturan standar untuk Server Lokal (XAMPP/Laragon)
$host = "localhost";
$user = "root";       // Username bawaan XAMPP
$pass = "";           // Password bawaan XAMPP (kosong)
$db   = "db_beasiswa"; // Nama database yang ada di phpMyAdmin

// Membuat koneksi ke database MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek apakah koneksi berhasil
if (!$conn) {
    // Paksa mesin Browser untuk menyadari bahwa ini adalah Error Fatal Server (HTTP 500)
    http_response_code(500);
    die("<div style='background:red; color:white; padding:50px; text-align:center; font-size: 2rem;'>
        <b>☠️ FATAL ERROR ☠️</b><br><br>
        DATABASE MYSQL DI XAMPP ANDA SEDANG MATI / TIDAK AKTIF!<br><br>
        Nyala-kan modul MySQL di XAMPP Anda sekarang untuk membuka website ini!
    </div>");
}
?>