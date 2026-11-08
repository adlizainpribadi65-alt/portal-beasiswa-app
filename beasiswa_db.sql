CREATE DATABASE IF NOT EXISTS db_beasiswa;
USE db_beasiswa;

CREATE TABLE IF NOT EXISTS tb_pendaftar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    hp VARCHAR(20) NOT NULL,
    semester INT NOT NULL,
    ipk DECIMAL(3,2) NOT NULL,
    beasiswa VARCHAR(50) NOT NULL,
    berkas VARCHAR(255) NOT NULL,
    status_ajuan VARCHAR(50) DEFAULT 'Belum Diverifikasi'
);
