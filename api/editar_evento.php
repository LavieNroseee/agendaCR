<?php
session_start();

// Verifica que haya sesión activa y que el usuario sea "admin"
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php"); // Redirige si no es admin
    exit;
}

// Conexión a la base de datos
require '../api/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $asunto = $_POST['asunto'];
    $convoca = $_POST['convoca'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $lugar = $_POST['lugar'];

    // Validación básica (puedes agregar más validaciones si lo necesitas)
    if (empty($asunto) || empty($convoca) || empty($fecha) || empty($hora_inicio) || empty($hora_fin)) {
        die("Todos los campos son requeridos.");
    }

    // Convertir la fecha y horas en formato datetime
    $hora_inicio = $fecha . ' ' . $hora_inicio;
    $hora_fin = $fecha . ' ' . $hora_fin;

    try {
        // Consulta SQL para actualizar la actividad
        $sql = "UPDATE actividades SET
                asunto_actividad = :asunto,
                convoca = :convoca,
                hora_inicio = :hora_inicio,
                hora_fin = :hora_fin,
                lugar = :lugar
                WHERE id = :id";
        
        // Preparar la consulta
        $stmt = $conexion->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':convoca', $convoca);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_fin', $hora_fin);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        $stmt->execute();

        // Almacenar un valor de sesión para mostrar el modal
        $_SESSION['actividad_actualizada'] = true;

        // Redirigir a la página de eventos (sin parámetros en la URL)
        header("Location: ../eventos.php");
        exit;
    } catch (PDOException $e) {
        die("Error al actualizar el evento: " . $e->getMessage());
    }
}
?>
