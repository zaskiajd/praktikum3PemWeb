<?php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS kampus");
    echo "Database 'kampus' berhasil dibuat atau sudah ada.
";
    
    // Switch to database
    $pdo->exec("USE kampus");
    
    // Create table
    $sql = "CREATE TABLE IF NOT EXISTS mahasiswa (
        id INT AUTO_INCREMENT PRIMARY KEY,
        npm VARCHAR(20) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        jurusan VARCHAR(100) NOT NULL
    )";
    $pdo->exec($sql);
    echo "Tabel 'mahasiswa' berhasil dibuat atau sudah ada.
";
    
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
