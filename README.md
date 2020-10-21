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
- Instalar Imagick en el sistema y también sus librerias. Este punto puede causar problemas por lo que investigue bien en la documentación oficial: https://imagemagick.org/index.php
Le recomiendo buscar en foros cuando tenga inconvenientes.
Debe colocar un phpinfo en su index para saber la version de php y datos de valor que le ayudarán a elegir correctamente los archivos a descargar para implementar ésta librería. Este paso es importante, ya que puede tener varios problemas si confunde la versión.
Recuerde que deberá tener la extensión en el php.ini habilitada.

Luego correr:
- Correr: composer install
- Correr: npm install



### Servidor
Al subirlo por primera vez debes tener en cuenta que la extension de " extension=php_imap.dll " en el php.ini esté habilitada.
- Instalar Imagick en el sistema y también sus librerias. Este punto puede causar problemas por lo que investigue bien en la documentación oficial: https://imagemagick.org/index.php
Le recomiendo buscar en foros cuando tenga inconvenientes.
Debe colocar un phpinfo en su index para saber la version de php y datos de valor que le ayudarán a elegir correctamente los archivos a descargar para implementar ésta librería. Este paso es importante, ya que puede tener varios problemas si confunde la versión.
Recuerde que deberá tener la extensión en el php.ini habilitada.

Luego correr:
- composer install
- npm install

Al subirlo verificar que exista, en la carpeta storage, la carpeta framework. Dentro de framework debe estar cache, sessions y views.
En caso de que no se hayan subido deberás crearlas
