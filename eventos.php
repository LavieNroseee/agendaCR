<?php
session_start();

// Verifica que haya sesión activa y que el usuario sea "admin"
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php"); // Redirige si no es admin
    exit;
}

// Conexión a la base de datos usando PDO
require 'api/db.php';

// Consulta para obtener las actividades
$sql = "SELECT id, asunto_actividad, convoca, participantes, hora_inicio, hora_fin, lugar, descripcion, enlace_virtual, creado_por FROM actividades";

// Ejecutar la consulta usando PDO
$stmt = $conexion->prepare($sql);
$stmt->execute();

// Obtener los resultados
$actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actividades</title>
  <link rel="stylesheet" href="css/dashboard.css">
  
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
  <link rel="stylesheet" href="css/eventos.css">
  <!-- DataTables CSS -->
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2><i class="fas fa-chart-pie"></i> Dashboard</h2>
    <h4>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo $_SESSION['sede']; ?>)</h4>
    <a href="dashboard"><i class="fas fa-chart-line"></i> Estadísticas</a>
    <a href="eventos"><i class="fas fa-calendar-alt"></i> Eventos/Actividades</a>
    <a href="index"><i class="fas fa-calendar-alt"></i> Calendario</a>
    <a href="logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
  </div>

  <!-- Contenido -->
  <div class="main-content">
    <h2 style="font-weight:bold;color:#0d3a85">Listado de Eventos</h2>

    <table id="eventTable" >
      <thead>
        <tr>
          <th>Asunto</th>
          <th>Convoca</th>
          <th>Dia</th>
          <th>Inicia</th>
          <th>Finaliza</th>
          <th>Lugar</th>
          <th>Creado por</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($actividades as $actividad): ?>
          <tr>
            <td><?php echo htmlspecialchars($actividad['asunto_actividad']); ?></td>
            <td><?php echo htmlspecialchars($actividad['convoca']); ?></td>
            <td>
            <?php
                $fecha = new DateTime($actividad['hora_inicio']);
                echo htmlspecialchars($fecha->format('d-m-Y'));
            ?>
            </td>
            <td>
            <?php
                $inicio = new DateTime($actividad['hora_inicio']);
                echo htmlspecialchars($inicio->format('h:i:s A'));
            ?>
            </td>
            <td>
            <?php
                $fin = new DateTime($actividad['hora_fin']);
                echo htmlspecialchars($fin->format('h:i:s A'));
            ?>
            </td>

            <td><?php echo htmlspecialchars($actividad['lugar']); ?></td>
            <td><?php echo htmlspecialchars($actividad['creado_por']); ?></td>
            <td>
                
            <button class="btn-editar" 
  data-id="<?php echo $actividad['id']; ?>"
  data-asunto="<?php echo htmlspecialchars($actividad['asunto_actividad']); ?>"
  data-convoca="<?php echo htmlspecialchars($actividad['convoca']); ?>"
  data-fecha="<?php echo (new DateTime($actividad['hora_inicio']))->format('Y-m-d'); ?>"
  data-fecha-fin="<?php echo (new DateTime($actividad['hora_fin']))->format('Y-m-d'); ?>"
  data-inicio="<?php echo (new DateTime($actividad['hora_inicio']))->format('H:i'); ?>"
  data-fin="<?php echo (new DateTime($actividad['hora_fin']))->format('H:i'); ?>"
  data-lugar="<?php echo htmlspecialchars($actividad['lugar']); ?>">
  Editar
</button>

            <button class="btn-eliminar"
                onclick="abrirModalEliminar(<?php echo $actividad['id']; ?>)">
                Eliminar
            </button>
 
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div id="modalEliminar" class="modal-eliminar">
  <div class="modal-content-eliminar">
    <h3>¿Estás seguro de que deseas eliminar este evento?</h3>
    <form id="formEliminar" method="POST" action="api/eliminar_evento">
      <input type="hidden" name="id" id="eliminar-id">
      <div class="btn-eliminar-container">
        <button type="button" class="btn-cancelar" onclick="cerrarModalEliminar()">Cancelar</button>
        <button type="submit" class="btn-confirmar">Eliminar</button>
      </div>
    </form>
  </div>
</div>

<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>




</body>
</html>

<div id="modal-editar" class="modal-editar">
  <div class="modal-content-editar">
  <span class="close-editar"></span>
    <form id="formEditar" method="POST" action="api/editar_evento">
      <input type="hidden" name="id" id="edit-id">
      

            
      <label class="label-editar">Asunto:</label>
      <input type="text" name="asunto" id="edit-asunto" required><br> 

      <label class="label-editar">Convoca:</label>
      <input type="text" name="convoca" id="edit-convoca" required><br> 

<div class="hora-container">

<div class="hora-group">
  <label class="label-editar" for="edit-fecha">Fecha Inicio:</label>
  <input type="date" name="fecha" id="edit-fecha" required readonly>
</div>
<div class="hora-group">
  <label class="label-editar" for="edit-fecha-fin">Fecha Fin:</label>
  <input type="date" name="fecha_fin" id="edit-fecha-fin" required readonly>
</div>
  <div class="hora-group">
    <label class="label-editar" for="edit-inicio">Hora Inicio:</label>
    <input type="time" name="hora_inicio" id="edit-inicio" required>
  </div>
  <div class="hora-group">
    <label class="label-editar" for="edit-fin">Hora Fin:</label>
    <input type="time" name="hora_fin" id="edit-fin" required>
  </div>
</div>

      <label class="label-editar"> Lugar:</label>
      <input type="text" name="lugar" id="edit-lugar"><br>

     <div class="btn-container-edit">

     <button class="btn-edit type="submit">Guardar Cambios</button>

     </div>

    </form>
  </div>
</div>


            

<script>
  const modal = document.getElementById('modal-editar');
  const closeBtn = document.querySelector('.modal-editar .close-editar');
  const form = document.getElementById('formEditar');

  document.querySelectorAll('.btn-editar').forEach(button => {
    button.addEventListener('click', () => {
      document.getElementById('edit-id').value = button.dataset.id;
      document.getElementById('edit-asunto').value = button.dataset.asunto;
      document.getElementById('edit-convoca').value = button.dataset.convoca;
      document.getElementById('edit-fecha').value = button.dataset.fecha;
      document.getElementById('edit-inicio').value = button.dataset.inicio;
      document.getElementById('edit-fin').value = button.dataset.fin;
      document.getElementById('edit-fecha-fin').value = button.dataset.fechaFin;

      document.getElementById('edit-lugar').value = button.dataset.lugar;
      modal.style.display = 'block';
    });
  });

  closeBtn.onclick = () => modal.style.display = 'none';
  window.onclick = e => { if (e.target == modal) modal.style.display = 'none'; }
</script>

<?php

if (isset($_SESSION['actividad_actualizada'])):
    unset($_SESSION['actividad_actualizada']);
?>
  <!-- Modal -->
  <div id="modalSuccess" class="modal-success">
    <div class="modal-content-success">
        <h2>Registro actualizado correctamente!</h2>
        <div class="aceptar-container">
        <button id="modalAccept" class="btn-accept">Aceptar</button>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
// Verifica si el modal está presente en la página
window.onload = function() {
    var modal = document.getElementById("modalSuccess");
    var acceptButton = document.getElementById("modalAccept");
    var closeButton = document.querySelector(".close-success"); // esto es lo que faltaba

    if (modal) {
        modal.style.display = "block";

        // Cerrar el modal cuando el usuario hace clic en "X"
        if (closeButton) {
            closeButton.onclick = function() {
                modal.style.display = "none";
            }
        }

        // Cerrar el modal si el usuario hace clic fuera del modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Redirigir a eventos.php cuando el usuario haga clic en "Aceptar"
        acceptButton.onclick = function() {
            window.location.href = "eventos";
        }
    }
};

</script>

<script>
function abrirModalEliminar(id) {
  document.getElementById('eliminar-id').value = id;
  document.getElementById('modalEliminar').style.display = 'flex';
}

function cerrarModalEliminar() {
  document.getElementById('modalEliminar').style.display = 'none';
}
</script>

<!-- El resto de tu código para mostrar las actividades -->

<script>
$(document).ready(function() {
  $('#eventTable').DataTable({
    language: {
      url: 'js/datatables.spanish.json'
    },
    pageLength: 5
  });
});


</script>