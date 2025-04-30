<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">Credenciales inválidas</p>
    <?php endif; ?>

    <form method="POST" action="api/login_handler.php">
        <input type="text" name="username" placeholder="Usuario" required><br><br>
        <input type="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
