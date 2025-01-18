import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
import focus from '@alpinejs/focus';

Alpine.plugin(focus);
Alpine.start();
