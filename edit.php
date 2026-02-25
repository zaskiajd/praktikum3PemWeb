<?php
require 'connection.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$npm = $_POST['npm'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$sql = "UPDATE mahasiswa SET npm = ?, nama = ?, jurusan = ? WHERE id
= ?";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$npm, $nama, $jurusan, $id])) {
header("Location: index.php");
exit;
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Edit Mahasiswa</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="npm" value="<?= htmlspecialchars($data['npm']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" value="<?= htmlspecialchars($data['jurusan']); ?>" required>
            </div>
            
            <div style="margin-top: 10px;">
                <button type="submit" class="btn">Update Data</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>