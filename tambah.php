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
    <title>Tambah Mahasiswa - Coquette</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="area">
        <ul class="ribbons">
            <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>

    <div class="container" style="max-width: 550px; text-align: center;">
        <div class="ribbon-wrapper">
            <h2 class="ribbon-3d">Tambah Data</h2>
        </div>
        
        <?php if (!empty($error_message)): ?>
            <div style="background-color: #ffebf0; color: #b71c1c; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #f8bbd0;">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Nomor Induk Mahasiswa (NIM)</label>
                <input type="text" name="npm" placeholder="Contoh: 2021001" required value="<?= isset($_POST['npm']) ? htmlspecialchars($_POST['npm']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Contoh: Princess Rose" required value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
            </div>
            
            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" placeholder="Contoh: Desain Fashion" required value="<?= isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : '' ?>">
            </div>
            
            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-add">✧ Simpan ✧</button>
                <a href="index.php" class="btn" style="border-color: #ddd; margin-left: 15px;">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>