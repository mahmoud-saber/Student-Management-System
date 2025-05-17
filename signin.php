<?php
include __DIR__ . './config/db_connect.php';


if (isset($_POST['submit'])) {
    $errors = [];
    $email = filter('email');
    $password = filter('password');

    if (empty($email)) {
        $errors[] = "Email is required";
    } else {
        $email = filter('email');
    }
    if (empty($password)) {
        $errors[] = "password is required";
    } else {
        $password = filter('password');
    }


    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        $sql = "SELECT * FROM `students` WHERE email = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $password]);
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
        if ($user) {
           header("Location:index.php");
             echo "<p style='color:green;'>Data is valid</p>";
        } else {
            echo "<p style='color:red;'>Data is  not valid</p>";
        }
    }
}