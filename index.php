<?php
session_start();
$usuario_actual = $_SESSION['username'] ?? 'Invitado';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agenda de Actividades</title>
  <link rel="stylesheet" href="fullcalendar/main.min.css">
  <!-- Esto carga Font Awesome 6 (última versión gratuita) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="style.css">

</head>
<body>




  <h1>AGENDA DEL CONSEJO REGIONAL - HUANUCO 2025</h1>
  <div class="contenedor-2">  
  <span>Usuario: <strong><?php echo htmlspecialchars($usuario_actual); ?></strong></span>
  <div class="iconos">
    <?php if ($usuario_actual === 'admin'): ?>
      <a href="dashboard.php" title="Ir al Dashboard">
        <i class="fas fa-chart-line"></i>
      </a>
    <?php endif; ?>
    <a href="logout.php" title="Cerrar sesión">
      <i class="fas fa-sign-out-alt"></i>
    </a>
  </div>
</div>


  <div class="contenedor">
    

    <div class="formulario">
  <h2>Agregar Actividad</h2>
  <form id="actividadForm">
    <!-- Asunto de la actividad -->
    <label>Asunto de la actividad:</label>
    <input type="text" name="asunto_actividad" required>

    <!-- Convoca -->
    <label>Convoca:</label>
    <input type="text" name="convoca" required>

    <!-- Participantes -->
    <label>Participantes:</label>
    <input type="text" name="participantes" required>

    <!-- Hora de inicio -->
    <label>Hora de inicio:</label>
    <input type="datetime-local" name="hora_inicio" required>

    <!-- Hora de fin -->
    <label>Hora de fin:</label>
    <input type="datetime-local" name="hora_fin" required>

    <!-- Lugar -->
    <label>Lugar:</label>
    <input type="text" name="lugar" required>

    <!-- Descripción -->
    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea><br>

    <!-- Enlace virtual (opcional) -->
    <label>Enlace virtual (opcional):</label>
    <input type="url" name="enlace_virtual" placeholder="https://...">

    <!-- Botón para registrar -->
    <button type="submit">Registrar</button>
  </form>
</div>


    <div id="calendar"></div>
    
    


  </div>

  <!-- Modales -->
  <div id="eventModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="eventTitle"></h2>
      <p><strong>Convoca:</strong> <span id="eventConvoca"></span></p>
      <p><strong>Participantes:</strong> <span id="eventParticipantes"></span></p>
      <p><strong>Inicia:</strong> <span id="hora_inicio"></span></p>
      <p><strong>Finaliza:</strong> <span id="hora_fin"></span></p>

      <p><strong>Duración:</strong> <span id="eventDuracion"></span></p>


      <p><strong>Lugar:</strong> <span id="eventLugar"></span></p>
      <p><strong>Descripcion:</strong> <span id="eventDescripcion"></span></p>
      <p><strong>Creado por:</strong> <span id="eventcreado_por"></span></p>
      <p><strong>Enlace virtual:</strong> <a href="#" id="eventEnlace" target="_blank">Ir al enlace</a></p>


    </div>
  </div>

  <div id="errorModal" class="modal">
    <div class="modal-content">
      <span class="close-error">&times;</span>
      <h2>Actividad Duplicada!</h2>
      <p>Ya existe una actividad registrada en ese horario.</p>
      <p id="errorConflictInfo" style="color: #d8000c; font-weight: bold;"></p>
      <p>Por favor, seleccione otro horario.</p>

    </div>
  </div>

  <script src="fullcalendar/main.min.js"></script>
  <script src="fullcalendar/locales/es.js"></script>
  <script src="script.js"></script>

  <footer class="footer">
  <p>Hecho con <i class="fas fa-heart"></i> por La vie en rose</p>
</footer>



</body>
</html>

