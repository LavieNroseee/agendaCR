document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',   
    locale: 'es',                  
    events: 'api/obtener_eventos.php',  
    displayEventTime: false,       
    fixedWeekCount: false,
    showNonCurrentDates: false,    

    eventClick: function(info) {
      const event = info.event;

      document.getElementById('eventTitle').innerText = event.title;  
      document.getElementById('eventConvoca').innerText = event.extendedProps.convoca || 'No especificado'; 
      document.getElementById('eventParticipantes').innerText = event.extendedProps.participantes || 'No especificado'; 
      document.getElementById('hora_inicio').innerText = new Date(event.start).toLocaleString(); 
      document.getElementById('hora_fin').innerText = new Date(event.end).toLocaleString();  
      document.getElementById('eventLugar').innerText = event.extendedProps.lugar || 'No especificado'; 
      document.getElementById('eventDescripcion').innerText = event.extendedProps.descripcion || "No especificado";
      document.getElementById('eventcreado_por').innerText = event.extendedProps.creado_por || 'Desconocido';
      document.getElementById('eventEnlace').href = event.extendedProps.enlace_virtual || '#';  
      document.getElementById('eventEnlace').innerText = event.extendedProps.enlace_virtual ? 'Ir al enlace' : 'No disponible';

      const inicio = new Date(event.start);
      const fin = new Date(event.end);
      const duracionMs = fin - inicio;
      const duracionMin = Math.floor(duracionMs / (1000 * 60)); // duración en minutos

      let textoDuracion = '';

      if (duracionMin >= 60) {
        const horas = Math.floor(duracionMin / 60);
        const minutos = duracionMin % 60;
        textoDuracion = minutos > 0 ? `${horas} hora ${minutos} minutos` : `${horas} horas`;
      } else {
         textoDuracion = `${duracionMin} minutos`;
      }

        document.getElementById('eventDuracion').innerText = textoDuracion;
      
      


      const modal = document.getElementById('eventModal');
      modal.style.display = "block";  
    }
  });

  calendar.render();  

  // Cerrar el modal de evento
  const modal = document.getElementById('eventModal');
  const span = document.getElementsByClassName("close")[0];
  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  // Captura el formulario de nueva actividad
  const form = document.getElementById('actividadForm');

  form.addEventListener('submit', function(e) {
    e.preventDefault(); // Evitar envío normal

    const formData = new FormData(form);

    fetch('api/guardar_evento.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        window.location.reload(); // Si todo ok, recargar para ver el nuevo evento
      } else if (data.error === 'duplicado') {
        const conflict = data.conflict_event;
      
        if (conflict) {
          
          const inicioHora = new Date(conflict.inicio).toLocaleTimeString('es-PE', { hour: 'numeric', minute: '2-digit', hour12: true });
          const finHora = new Date(conflict.fin).toLocaleTimeString('es-PE', { hour: 'numeric', minute: '2-digit', hour12: true });
          
          const conflictMsg = `Actividad: ${conflict.asunto}<br>Desde: ${inicioHora} hasta ${finHora}`;
          document.getElementById('errorConflictInfo').innerHTML = conflictMsg;
          
        } else {
          document.getElementById('errorConflictInfo').innerText = 'El evento se cruza con otro existente.';
        }
      
        const errorModal = document.getElementById('errorModal');
        errorModal.style.display = "block";
      } else {
        alert('Ocurrió un error inesperado.');
      }
    })
    .catch(error => {
      console.error('Error en el envío del formulario:', error);
    });
  });

  // Cerrar el modal de error
  const errorModal = document.getElementById('errorModal');
  const closeError = document.getElementsByClassName("close-error")[0];
  if (closeError) {
    closeError.onclick = function() {
      errorModal.style.display = "none";
    }
  }

  window.addEventListener('click', function(event) {
    if (event.target == errorModal) {
      errorModal.style.display = "none";
    }
  });
});
