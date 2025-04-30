<?php
session_start();

// Verifica que haya sesión activa y que el usuario sea "admin"
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: ../index.php"); // Redirige si no es admin
    exit;
}

// Conexión a la base de datos
require '../api/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("ID de evento no válido.");
    }

    $id = intval($_POST['id']);

    try {
        // Preparar y ejecutar la consulta DELETE
        $sql = "DELETE FROM actividades WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Almacenar estado en sesión para mostrar modal de éxito
        $_SESSION['actividad_eliminada'] = true;

        // Redirige a eventos.php
        header("Location: ../eventos.php");
        exit;
    } catch (PDOException $e) {
        die("Error al eliminar el evento: " . $e->getMessage());
    }
}
?>
