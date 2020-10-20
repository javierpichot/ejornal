# Ejornal
Sistema de gestión de jornadas de trabajo.

## Instalación

### Algunos requerimientos principales
* PHP 7.1.3
* Laravel 5.6
* Laravel Collective 5.4.0
* Vue 2.5.17
* Sass 1.15.2
* Jquery 3.2
* Bootstrap 4.1.0
* cross-env 5.1
* Axios 0.18
* Laravel mix 4.0.7

### Localmente (Windows)
- Debes habilitar la extension de " extension=php_imap.dll " en el php.ini
- Correr: composer install
- Correr: npm install



### Servidor
Al subirlo por primera vez debes tener en cuenta que la extension de " extension=php_imap.dll " en el php.ini esté habilitada.
Luego correr:
- composer install
- npm install

Al subirlo verificar que exista, en la carpeta storage, la carpeta framework. Dentro de framework debe estar cache, sessions y views.
En caso de que no se hayan subido deberás crearlas
