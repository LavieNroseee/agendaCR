<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="login-container">

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">Credenciales inválidas</div>
        <?php endif; ?>

        <form method="POST" action="api/login_handler.php">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" class="login-button">Iniciar Sesion</button>
        </form>
    </div>

    <div class="footer-illustration">
        <img src="images/footer3.webp" alt="Decoración inferior"> <!-- Cambia por tu imagen -->
    </div>

</body>
</html>
