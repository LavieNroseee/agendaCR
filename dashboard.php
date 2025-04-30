<?php
session_start();

// Verifica que haya sesión activa y que el usuario sea "admin"
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php"); // Redirige si no es admin
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo $_SESSION['sede']; ?>)</h2>

    <a href="index.php">Ir al Calendario</a><br><br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
