<?php
// Baris Pertama, Syarat Utama: Minta koneksi XAMPP dan phpMyAdmin! Lengkap, tidak dummy.
require_once 'koneksi.php';

// Cek status alert
$status = isset($_GET['status']) ? $_GET['status'] : '';

// SISTEM PROTEKSI XAMPP: Kunci akses CSS dan JavaScript menggunakan PHP!
// Jika web ini dihajar dibuka tanpa XAMPP (Apache mati), maka CSS dan JS tidak akan bekerja.
$kunci_css = "css/style.css";
$kunci_js = "js/main.js";

echo "<div style='background: black; color: lime; padding: 10px; font-family: monospace; font-size: 14px; position: fixed; top: 0; right: 0; z-index: 99999; border: 2px solid lime;'>";
echo "<b>DIAGNOSTIK SERVER</b><br>";
echo "Status Apache/PHP: <b>MENYALA ✅</b><br>";
echo "Status MySQL: <b>MENYALA ✅</b><br>";
echo "Koneksi Bukti: " . mysqli_get_host_info($conn);
echo "</div>";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Registrasi Beasiswa ITBA DCC (PHP Native)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Wajib Pakai PHP untuk memuat desain CSS. Tanpa XAMPP = Desain Hancur! -->
    <link rel="stylesheet" href="<?php echo $kunci_css; ?>">
    
    <script>
        // Deteksi jika user salah buka file (pakai VS Code Live Server atau File Explorer)
        window.onload = function() {
            const myUrl = window.location.href;
            if (myUrl.includes("file://") || myUrl.includes(":5500") || myUrl.includes(":3000")) {
                alert("🚨 PERINGATAN KERAS! 🚨\n\nAnda sedang membuka website ini dengan cara yang SALAH (Tidak menggunakan XAMPP)!\nItulah penyebab mengapa error PHP dan Database Anda 'kelihatan' tidak merespon/masih jalan, karena bahasa PHP Anda SEDANG MATI TOTAL dan diabaikan oleh browser!\n\nTutup halaman ini, copy folder project ke htdocs, nyalakan XAMPP, dan buka via: http://localhost/beasiswa-app");
            }
        };
    </script>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <span>Beasiswa ITBA DCC</span>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="#" class="nav-link active" data-target="home">Home</a></li>
                    <li><a href="#" class="nav-link" data-target="daftar">Daftar</a></li>
                    <li><a href="#" class="nav-link" data-target="hasil">Hasil</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <!-- Home Section -->
        <section id="home" class="section active">
            <div class="hero" style="background-color: #f1f8ff; border: 1px solid #cce5ff;">
                <div class="hero-logo">
                    <div class="logo-circle">
                         <span style="color: white; font-weight: bold; font-size: 1.7rem; font-family: serif; font-style: italic;">DCC</span>
                    </div>
                </div>
                <h1>Selamat Datang di Portal Beasiswa</h1>
                <p>Didukung oleh PHP Native & MySQL Database (Asesmen Ujikom)</p>
                <button class="btn btn-primary hero-btn" onclick="navigateTo('daftar')">Daftar Sekarang</button>
            </div>

            <div class="scholarship-types">
                <div class="card">
                    <h3 class="text-blue">Beasiswa Akademik</h3>
                    <p class="desc">Ditujukan bagi mahasiswa yang memiliki prestasi akademik gemilang di kelasnya.</p>
                    <div class="requirements">
                        <strong>Syarat Utama:</strong>
                        <ul>
                            <li>IPK Minimal 3.00</li>
                            <li>Semester 1 - 8</li>
                            <li>KTM & Transkrip Nilai Terakhir</li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <h3 class="text-green">Beasiswa Non-Akademik</h3>
                    <p class="desc">Ditujukan bagi mahasiswa yang aktif berorganisasi atau memiliki prestasi di bidang olahraga/seni.</p>
                    <div class="requirements">
                        <strong>Syarat Utama:</strong>
                        <ul>
                            <li>IPK Minimal 3.00</li>
                            <li>Sertifikat Prestasi / Piagam Penghargaan</li>
                            <li>Surat Rekomendasi Organisasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Daftar Section -->
        <section id="daftar" class="section">
            <div class="form-container">
                <h2 class="section-title">Form Registrasi Beasiswa</h2>
                <!-- Method POST ditambahkan ke proses_daftar.php beserta fitur upload enctype -->
                <form id="registrationForm" action="proses_daftar.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Masukkan Nama</label>
                        <input type="text" id="nama" name="nama" required placeholder="Nama Lengkap">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Masukkan Email</label>
                        <input type="email" id="email" name="email" required placeholder="email@contoh.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="hp">Nomor HP</label>
                        <input type="tel" id="hp" name="hp" required pattern="[0-9]+" placeholder="08xxxxxxxxxx" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                    
                    <div class="form-group">
                        <label for="semester">Semester Saat Ini</label>
                        <select id="semester" name="semester" required>
                            <option value="" disabled selected>-- Pilih Semester --</option>
                            <?php for($i=1; $i<=8; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="ipk">IPK Terakhir</label>
                        <input type="number" id="ipk" name="ipk" step="0.01" min="0" max="4.00" required placeholder="0.00 - 4.00">
                    </div>
                    
                    <div class="form-group">
                        <label for="beasiswa">Pilihan Beasiswa</label>
                        <select id="beasiswa" name="beasiswa" required disabled>
                            <option value="" disabled selected>-- Pilih Jenis Beasiswa --</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Non-Akademik">Non-Akademik</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="berkas">Upload Berkas Syarat (.pdf / .jpg)</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="berkas" name="berkas" accept=".pdf, .jpg, .jpeg" required disabled>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <!-- Type submit ditambahkan -->
                        <button type="submit" name="submit" id="btnDaftar" class="btn btn-primary" disabled>DAFTAR</button>
                        <button type="button" class="btn btn-danger" onclick="document.getElementById('registrationForm').reset(); disableFormAdditions();">BATAL</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Hasil Section -->
        <section id="hasil" class="section">
            <h2 class="section-title">Data Hasil Pengajuan Beasiswa</h2>
            <div class="table-container">
                <table id="resultTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Semester</th>
                            <th>IPK</th>
                            <th>Pilihan Beasiswa</th>
                            <th>Berkas</th>
                            <th>Status Ajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Menggunakan $conn yang sudah di panggil dengan ketat di baris ke-1
                        $query = "SELECT * FROM tb_pendaftar ORDER BY id DESC";
                        $result = mysqli_query($conn, $query);

                        if($result && mysqli_num_rows($result) > 0) {
                            $no = 1;
                            while($row = mysqli_fetch_assoc($result)) {
                                $beasiswa_badge = ($row['beasiswa'] != '-') ? "<span class='badge badge-blue'>{$row['beasiswa']}</span>" : "-";
                                $berkas_link = ($row['berkas'] != '-') ? "<a href='uploads/{$row['berkas']}' target='_blank' class='file-link'>📄 File Berkas</a>" : "-";
                                
                                $status_class = 'badge-yellow'; // Default (misal Belum Diverifikasi)
                                if($row['status_ajuan'] == 'Lolos') {
                                    $status_class = 'badge-green';
                                } else if($row['status_ajuan'] == 'Tidak Lolos') {
                                    $status_class = 'badge-red';
                                }

                                echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['hp']}</td>
                                    <td>{$row['semester']}</td>
                                    <td>{$row['ipk']}</td>
                                    <td>{$beasiswa_badge}</td>
                                    <td>{$berkas_link}</td>
                                    <td><span class='badge {$status_class}'>{$row['status_ajuan']}</span></td>
                                </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='9' style='text-align:center; padding: 2rem;'>Belum ada data pendaftar dalam MySQL.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    
    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <?php if($status == 'success') echo "Data Pendaftaran Berhasil Tersimpan di MySQL!"; ?>
        <?php if($status == 'error') echo "Terjadi kesalahan saat fungsi PHP mengupload file / Simpan!"; ?>
    </div>

    <script>
        // Logika untuk menampilkan notifikasi toast
        const statusParam = "<?= $status ?>";
        if(statusParam === 'success' || statusParam === 'error') {
            document.getElementById('toast').classList.add('show');
            setTimeout(() => {
                document.getElementById('toast').classList.remove('show');
            }, 4000);
            
            // Langsung arahkan ke halaman hasil saat sukses
            if(statusParam === 'success'){
                document.addEventListener('DOMContentLoaded', () => {
                    navigateTo('hasil');
                });
            }
        }
    </script>
    <!-- Wajib Pakai PHP untuk memuat Logika JS. Tanpa XAMPP = Klik Tidak Berfungsi! -->
    <script src="<?php echo $kunci_js; ?>"></script>
</body>
</html>
