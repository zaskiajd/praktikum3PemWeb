<?php

require 'connection.php';
$stmt = $pdo->query("SELECT * FROM mahasiswa ORDER BY id DESC");
$mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa - Coquette Aesthetic</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="area">
        <ul class="hearts">
            <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>

    <div class="container" style="text-align: center;">
        <div class="ribbon-wrapper">
            <h2 class="ribbon-3d">✿ Daftar Mahasiswa ✿</h2>
        </div>
        
        <div style="margin-top: 20px; margin-bottom: 20px;">
            <a href="tambah.php" class="btn btn-add">✧ Tambah Data Baru ✧</a>
        </div>

        <!-- Search Feature (Baru) -->
        <div class="search-wrapper">
            <input type="text" id="searchInput" class="search-input" placeholder="Cari Mahasiswa... ♡" onkeyup="searchTable()">
        </div>
        
        <table id="mahasiswaTable">
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
                <?php if (empty($mahasiswa)): ?>
                    <tr>
                        <td colspan="5" class="empty-state">Belum ada data mahasiswa... ʚɞ</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach($mahasiswa as $row): ?>
                    <tr>
                        <td class="td-no"><?= $no++; ?></td>
                        <td class="td-nim"><?= htmlspecialchars($row['npm']); ?></td>
                        <td class="td-nama">✿ <?= htmlspecialchars($row['nama']); ?></td>
                        <td class="td-jurusan"><?= htmlspecialchars($row['jurusan']); ?></td>
                        <td class="action-links">
                            <a href="edit.php?id=<?= $row['id']; ?>" title="Edit">✏️</a>
                            <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" style="color: #e57373;" title="Hapus">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Script Search Baru -->
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("mahasiswaTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                found = false;
                for (j = 0; j < td.length - 1; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }
    </script>
</body>
</html>