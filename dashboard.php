<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
