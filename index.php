<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa - Coquette Theme</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="area">
        <ul class="hearts">
            <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>

    <div class="container" style="text-align: center;">
        <div class="ribbon-wrapper" style="margin-top: 20px;">
            <h2 class="ribbon-3d">Daftar Mahasiswa</h2>
        </div>
        
        <div style="margin-bottom: 30px;">
            <a href="tambah.php" class="btn btn-add">✧ Tambah Data Baru ✧</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th width="8%">No</th>
                    <th width="20%">NIM</th>
                    <th width="32%">Nama</th>
                    <th width="20%">Jurusan</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($mahasiswa as $row): ?>
                <tr>
                    <td style="font-weight: bold; color: var(--ribbon-dark);"><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['npm']); ?></td>
                    <td style="font-family: 'Playfair Display', serif; font-size: 1.1em;"><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['jurusan']); ?></td>
                    <td class="action-links">
                        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" style="color: #e57373;">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>