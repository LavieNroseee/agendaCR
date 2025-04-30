<?php
require 'db.php';

$sql = "SELECT id, asunto_actividad, convoca, participantes, hora, lugar, descripcion, enlace_virtual, creado_por FROM actividades";
$stmt = $conexion->query($sql);
$eventos = [];

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $color = '#ffffff'; // Color por defecto
    $class = 'default'; // Clase por defecto

    // Asignar clases personalizadas según el usuario creador
    if ($fila['creado_por'] === 'admin') {
        $class = 'admin';
    } elseif ($fila['creado_por'] === 'drtc') {
        $class = 'drtc';
    }

    $eventos[] = [
        'id' => $fila['id'],
        'title' => $fila['asunto_actividad'],
        'start' => $fila['hora'],
        'color' => $color,
        'className' => $class,
        'extendedProps' => [
            'convoca' => $fila['convoca'],
            'participantes' => $fila['participantes'],
            'lugar' => $fila['lugar'],
            'descripcion' => $fila['descripcion'],
            'enlace_virtual' => $fila['enlace_virtual'],
            'creado_por' => $fila['creado_por'] // ✅ Incluido para el modal
        ]
    ];
}

echo json_encode($eventos);
?>
