<?php
require_once 'koneksi.php';

if (isset($_POST['submit'])) {
    // Sanitasi data form agar aman dari SQL Injection
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $semester = (int) $_POST['semester'];
    $ipk = (float) $_POST['ipk'];
    $beasiswa = isset($_POST['beasiswa']) ? mysqli_real_escape_string($conn, $_POST['beasiswa']) : '-';
    
    // Tentukan status ajuan berdasarkan IPK
    $status_ajuan = ($ipk >= 3) ? 'Lolos' : 'Tidak Lolos';
    
    $nama_file_baru = '-';
    $upload_sukses = true;
    
    // Jika IPK >= 3, wajib upload berkas
    if ($ipk >= 3 && isset($_FILES['berkas']) && $_FILES['berkas']['error'] == UPLOAD_ERR_OK) {
        $berkas_nama = $_FILES['berkas']['name'];
        $berkas_tmp  = $_FILES['berkas']['tmp_name'];
        
        $nama_file_baru = time() . '_' . basename($berkas_nama); 
        $target_dir = "uploads/";
        
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }
        
        $target_path = $target_dir . $nama_file_baru;
        if(!move_uploaded_file($berkas_tmp, $target_path)) {
            $upload_sukses = false;
        }
    }
    
    if($upload_sukses) {
        // Simpan ke Database
        $query = "INSERT INTO tb_pendaftar (nama, email, hp, semester, ipk, beasiswa, berkas, status_ajuan) 
                  VALUES ('$nama', '$email', '$hp', $semester, $ipk, '$beasiswa', '$nama_file_baru', '$status_ajuan')";
                  
        if(mysqli_query($conn, $query)) {
            // Berhasil
            header("Location: index.php?status=success");
            exit();
        } else {
            // Gagal insert ke DataBase
            die("Error SQL: " . mysqli_error($conn));
        }
    } else {
        // Gagal pindah file upload
        header("Location: index.php?status=error");
        exit();
    }
} else {
    // Apabila akses langsung dari URL
    header("Location: index.php");
    exit();
}
?>
