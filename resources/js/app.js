import './bootstrap';
import Alpine from 'alpinejs'
import anchor from "@alpinejs/anchor";
import collapse from "@alpinejs/collapse";
import dropdownMenu from './plugins/dropdown-menu'

Alpine.plugin(anchor);
Alpine.plugin(collapse);

window.Alpine = Alpine
Alpine.plugin(dropdownMenu)

const modules = import.meta.glob("./plugins/**/*.js", { eager: true });
 
for (const path in modules) {
    Alpine.plugin(modules[path].default);
}

Alpine.start()
