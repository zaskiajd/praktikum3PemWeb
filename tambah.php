<?php
require 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$nim = $_POST['npm'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
// Gunakan Prepared Statement (?) untuk keamanan
$sql = "INSERT INTO mahasiswa (npm, nama, jurusan) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$nim, $nama, $jurusan])) {
header("Location: index.php");
exit;
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Tambah Mahasiswa</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="npm" placeholder="Masukkan NIM" required>
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan Nama" required>
            </div>
            
            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" placeholder="Masukkan Jurusan" required>
            </div>
            
            <div style="margin-top: 10px;">
                <button type="submit" class="btn">Simpan Data</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>