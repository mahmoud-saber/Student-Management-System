<?php
include __DIR__ . '/config/db_connect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// print_r($student);

if (isset($_POST['update'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $age      = $_POST['age'];

    $stmt = $pdo->prepare("UPDATE students SET name = ?, email = ?, age = ? WHERE id = ?");
    $stmt->execute([$name, $email, $age, $id]);

    header("Location: index.php");
    exit;
}