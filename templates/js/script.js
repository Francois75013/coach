'use strict';

window.onload = () => {
    let elementCalendrier = document.getElementById('calendrier')

      // On instancie le calendrier
      let calendar = new FullCalendar.Calendar(elementCalendrier, {
        // On charge le composant "dayGrid"
       plugins: [ 'dayGrid', 'list' ],
    });
        
    // On affiche le calendrier
    calendar.render();

}