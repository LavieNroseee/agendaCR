<?php
require 'db.php';
session_start();

$creado_por = $_SESSION['username'] ?? 'desconocido';

// Capturar los datos del formulario
$asunto_actividad = $_POST['asunto_actividad'] ?? '';
$convoca = $_POST['convoca'] ?? '';
$participantes = $_POST['participantes'] ?? '';
$hora_inicio = $_POST['hora_inicio'] ?? '';
$hora_fin = $_POST['hora_fin'] ?? '';
$lugar = $_POST['lugar'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$enlace_virtual = $_POST['enlace_virtual'] ?? '';

// Validar que los campos principales no estén vacíos
if (
    empty($asunto_actividad) || empty($convoca) || empty($participantes) ||
    empty($hora_inicio) || empty($hora_fin) || empty($lugar) || empty($descripcion)
) {
    echo json_encode(['success' => false, 'error' => 'faltan_datos']);
    exit();
}

try {
    // Buscar evento que se cruce
    $sql_check = "SELECT * FROM actividades 
                  WHERE (hora_inicio < ? AND hora_fin > ?)";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->execute([$hora_fin, $hora_inicio]);
    $conflicto = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($conflicto) {
        echo json_encode([
            'success' => false,
            'error' => 'duplicado',
            'conflict_event' => [
                'asunto' => $conflicto['asunto_actividad'],
                'inicio' => $conflicto['hora_inicio'],
                'fin' => $conflicto['hora_fin'],
                'lugar' => $conflicto['lugar']
            ]
        ]);
        exit();
    }

    // Insertar nuevo evento
    $sql = "INSERT INTO actividades (asunto_actividad, convoca, participantes, hora_inicio, hora_fin, lugar, descripcion, enlace_virtual, creado_por) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        $asunto_actividad,
        $convoca,
        $participantes,
        $hora_inicio,
        $hora_fin,
        $lugar,
        $descripcion,
        $enlace_virtual,
        $creado_por
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'db_error', 'message' => $e->getMessage()]);
}
exit();
?>
