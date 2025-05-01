<?php
session_start();

// Verificar si hay un usuario logueado
if (isset($_SESSION['username'])) {
    echo json_encode(['logged_in' => true]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>
