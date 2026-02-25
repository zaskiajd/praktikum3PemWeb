<?php
require 'connection.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    
    try {
        $sql = "UPDATE mahasiswa SET npm = ?, nama = ?, jurusan = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$npm, $nama, $jurusan, $id])) {
            header("Location: index.php");
            exit;
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
             $error_message = "Error: NIM '$npm' sudah digunakan oleh mahasiswa lain.";
        } else {
             $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
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
            <h2 class="ribbon">Edit Data</h2>
        </div>
        
        <?php if (!empty($error_message)): ?>
            <div style="background-color: #ffcdd2; color: #b71c1c; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="npm" value="<?= isset($_POST['npm']) ? htmlspecialchars($_POST['npm']) : htmlspecialchars($data['npm']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : htmlspecialchars($data['nama']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" value="<?= isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : htmlspecialchars($data['jurusan']); ?>" required>
            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <button type="submit" class="btn">Update Data</button>
                <a href="index.php" class="btn" style="background-color: #b0bec5; margin-left: 10px;">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>