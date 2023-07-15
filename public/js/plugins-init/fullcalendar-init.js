"use strict"

function fullCalender(events){
	
	/* initialize the external events
		-----------------------------------------------------------------*/

		var containerEl = document.getElementById('external-events');
		new FullCalendar.Draggable(containerEl, {
		  itemSelector: '.external-event',
		  eventData: function(eventEl) {
			return {
			  title: eventEl.innerText.trim()
			}
		  }
		 
		});
		/* initialize the calendar
		-----------------------------------------------------------------*/

		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
		  headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay'
		  },
		  locale: 'es',
		  
		  selectable: false,
		  selectMirror: true,		  
		  editable: false,
		  droppable: false, // this allows things to be dropped onto the calendar
		  drop: function(arg) {
			// is the "remove after drop" checkbox checked?
			if (document.getElementById('drop-remove').checked) {
			  // if so, remove the element from the "Draggable Events" list
			  arg.draggedEl.parentNode.removeChild(arg.draggedEl);
			}
		  },
			  weekNumbers: false,
			  navLinks: true, // can click day/week names to navigate views
			  editable: true,
			  selectable: true,
			  nowIndicator: true,
		   events: events
		});
		calendar.render();
	
}	
	

		

