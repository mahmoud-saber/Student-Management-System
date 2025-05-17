<?php
include __DIR__ . './config/db_connect.php';

$search = $_GET['search'] ?? '';
$students = [];

try {
    if (!empty($search)) {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE name LIKE ?");
        $stmt->execute(["%$search%"]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM students");
        $stmt->execute();
    }

    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Failed to fetch data: ' . $e->getMessage());
}


?>