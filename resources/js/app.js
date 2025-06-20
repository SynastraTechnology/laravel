import './bootstrap';
import Alpine from 'alpinejs'
import dropdownMenu from './plugins/dropdown-menu'

window.Alpine = Alpine
Alpine.plugin(dropdownMenu)
Alpine.start()
