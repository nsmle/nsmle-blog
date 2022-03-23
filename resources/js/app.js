require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



// Reference from published scripts
//require('./vendor/livewire-ui/modal');

// Reference from vendor
//require('../../vendor/livewire-ui/modal/resources/js/modal');



          

// Echo.channel('user-followed')
//       .listen('.follow', (e) => {
//           Livewire.emit('userFollowed')
//           alert(e.message)
//       });