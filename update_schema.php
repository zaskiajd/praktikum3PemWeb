<?php
require 'connection.php';

try {
    // Check if the index already exists to avoid errors on re-run
    $checkIndex = $pdo->query("SHOW INDEX FROM mahasiswa WHERE Key_name = 'npm'");
    
    if ($checkIndex->rowCount() == 0) {
        $sql = "ALTER TABLE mahasiswa ADD UNIQUE (npm)";
        $pdo->exec($sql);
        echo "Berhasil: Kolom NPM sekarang bersifat unik (Unique Constraint added).";
    } else {
        echo "Info: Kolom NPM sudah bersifat unik.";
    }
} catch(PDOException $e) {
    echo "Gagal mengubah struktur database: " . $e->getMessage();
}
?>