<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = :username";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['sede'] = $user['sede'];
        header("Location: ../dashboard.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Credenciales incorrectas.";
        header("Location: ../login");
        exit;
    }
}
?>
