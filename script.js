document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',   // Vista inicial como mes
    locale: 'es',                   // Establece el idioma a español
    events: 'api/obtener_eventos.php',  // Fuente de los eventos
    displayEventTime: false,        // No mostrar la hora de los eventos
    fixedWeekCount: false,
    showNonCurrentDates: false,     // Ajusta el número de semanas al mes actual (sin días extra)

    // Cuando se hace clic en un evento
    eventClick: function(info) {
      // Aquí se obtienen los detalles del evento
      const event = info.event;

      document.getElementById('eventTitle').innerText = event.title;  
      document.getElementById('eventConvoca').innerText = event.extendedProps.convoca || 'No especificado'; 
      document.getElementById('eventParticipantes').innerText = event.extendedProps.participantes || 'No especificado'; 
      document.getElementById('eventHora').innerText = new Date(event.start).toLocaleString();  
      document.getElementById('eventLugar').innerText = event.extendedProps.lugar || 'No especificado'; 
      document.getElementById('eventDescripcion').innerText = event.extendedProps.descripcion || "No especificado"
      document.getElementById('eventEnlace').href = event.extendedProps.enlace_virtual || '#';  
      document.getElementById('eventEnlace').innerText = event.extendedProps.enlace_virtual ? 'Ir al enlace' : 'No disponible'; 

    
      const modal = document.getElementById('eventModal');
      modal.style.display = "block";  

    }
  });

  calendar.render();  // Renderiza el calendario

  // Cerrar el modal
  const modal = document.getElementById('eventModal');
  const span = document.getElementsByClassName("close")[0];
  span.onclick = function() {
    modal.style.display = "none";  // Al hacer clic en la 'X' cierra el modal
  }

  // Cerrar el modal si se hace clic fuera de él
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";  // Al hacer clic fuera, también cierra el modal
    }
  }
});
