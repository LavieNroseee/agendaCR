<?php
require 'db.php';

// Capturar los datos del formulario
$asunto_actividad = $_POST['asunto_actividad'];
$convoca = $_POST['convoca'];
$participantes = $_POST['participantes'];
$hora = $_POST['hora'];
$lugar = $_POST['lugar'];
$descripcion= $_POST['descripcion'];
$enlace_virtual = $_POST['enlace_virtual'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO actividades (asunto_actividad, convoca, participantes, hora, lugar,descripcion, enlace_virtual) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$asunto_actividad, $convoca, $participantes, $hora, $lugar,$descripcion, $enlace_virtual]);

 
function generarColorAleatorio() {
        $colores = ['#FFB6C1', '#87CEFA', '#90EE90', '#FFD700', '#FFA07A', '#DDA0DD', '#00CED1'];
        return $colores[array_rand($colores)];
    }
    
    $color = generarColorAleatorio();

    
// Redireccionar luego de guardar
header("Location: ../index.html");
