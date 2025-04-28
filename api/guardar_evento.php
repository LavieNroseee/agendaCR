<?php
require 'db.php';

// Capturar los datos del formulario
$asunto_actividad = $_POST['asunto_actividad'] ?? '';
$convoca = $_POST['convoca'] ?? '';
$participantes = $_POST['participantes'] ?? '';
$hora = $_POST['hora'] ?? '';
$lugar = $_POST['lugar'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$enlace_virtual = $_POST['enlace_virtual'] ?? '';

// Validar que los campos principales no estén vacíos
if (empty($asunto_actividad) || empty($convoca) || empty($participantes) || empty($hora) || empty($lugar) || empty($descripcion)) {
    echo json_encode(['success' => false, 'error' => 'faltan_datos']);
    exit();
}

try {
    // Verificar duplicidad de hora
    $sql_check = "SELECT COUNT(*) FROM actividades WHERE hora = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->execute([$hora]);
    $existe = $stmt_check->fetchColumn();

    if ($existe > 0) {
        // Hay un evento ya registrado en esa misma hora
        echo json_encode(['success' => false, 'error' => 'duplicado']);
        exit();
    }

    // Insertar el nuevo evento
    $sql = "INSERT INTO actividades (asunto_actividad, convoca, participantes, hora, lugar, descripcion, enlace_virtual) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$asunto_actividad, $convoca, $participantes, $hora, $lugar, $descripcion, $enlace_virtual]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // Error en la base de datos
    echo json_encode(['success' => false, 'error' => 'db_error', 'message' => $e->getMessage()]);
}
exit();
?>



