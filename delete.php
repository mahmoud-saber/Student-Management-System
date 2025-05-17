<?php
include __DIR__ . './config/db_connect.php';
$id = $_GET['id'];
  $sql = "DELETE FROM students WHERE id=$id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header("Location: index.php");
?>