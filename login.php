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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/index.css">
</head>

<body>

<div class="login-container">

<?php
if (isset($_SESSION['login_error'])) {
    echo "<p style='color:red'>" . $_SESSION['login_error'] . "</p>";
    unset($_SESSION['login_error']); // Borra el mensaje para que no se repita
}
?>


<form method="POST" action="api/login_handler.php">
<h3>Inicie sesión con su cuenta</h3>
<p>¡Bienvenido! Ingrese sus credenciales de acceso<p>
  <div class="input-group">
  
    <i class="fas fa-user"></i>
    <input type="text" name="username" placeholder="Usuario" required>
  </div>

  <div class="input-group">
    <i class="fas fa-lock"></i>
    <input type="password" name="password" placeholder="Contraseña" required>
  </div>

  <button type="submit" class="login-button">Iniciar Sesión</button>
  
  <a href="index" style= "text-decoration: none;"><p>Ver agenda</p></a>
  
</form>
</div>

  <div class="footer-illustration">
   <!-- <img src="images/footer3.webp" alt="Decoración inferior"> -->
  </div>

  <footer class="footer">
  <p>Hecho con <i class="fas fa-heart"></i> por la vie en rose</p>
</footer>
</body>

</html>
