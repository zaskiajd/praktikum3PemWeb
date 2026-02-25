<?php
require 'connection.php';
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['npm'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    try {
        $sql = "INSERT INTO mahasiswa (npm, nama, jurusan) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nim, $nama, $jurusan])) {
            header("Location: index.php");
            exit;
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) { // 1062 is MySQL error code for Duplicate Entry
            $error_message = "Error: NIM '$nim' sudah terdaftar. Gunakan NIM yang berbeda.";
        } else {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="area">
        <ul class="circles">
            <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>

    <div class="container" style="max-width: 500px;">
        <div class="ribbon-wrapper">
            <h2 class="ribbon">Tambah Data</h2>
        </div>
        
        <?php if (!empty($error_message)): ?>
            <div style="background-color: #ffcdd2; color: #b71c1c; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="npm" placeholder="Masukkan NIM" required value="<?= isset($_POST['npm']) ? htmlspecialchars($_POST['npm']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan Nama" required value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" placeholder="Masukkan Jurusan" required value="<?= isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : '' ?>">
            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <button type="submit" class="btn">Simpan Data</button>
                <a href="index.php" class="btn" style="background-color: #b0bec5; margin-left: 10px;">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>