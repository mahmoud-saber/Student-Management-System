<?php
include __DIR__ . './config/db_connect.php';


if (isset($_POST['submit'])) {
    $errors = [];
    $username = filter('name');
    $email = filter('email');
    $password = filter('password');
    $age = filter('age');

    if (empty($username)) {
        $errors[] = "Name is required";
    } else {
        $username = filter('name');
    }
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

    if (empty($age)) {
        $errors[] = "age is required";
    } else {
        $age = filter('age');
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        $sql = "INSERT INTO `students`( `name`, `email`, `password`, `age`) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$username, $email, $password, $age]);
        echo "<p style='color:green;'>Data is valid</p>";


        if ($result  ) { 
            header("Location:log in.php");
            exit;
        } else {
            echo 'faild';
        }
    }
}