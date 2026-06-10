import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

// Register Alpine plugins
Alpine.plugin(intersect);

// Make Alpine available globally
window.Alpine = Alpine;

Alpine.start();
