# Ejornal
Sistema de gestión de jornadas de trabajo.

## Instalación

### Algunos requerimientos principales
* PHP 7.1.3
* Tener instalado Node Js y Npm
* Tener instalado composer
* Laravel 5.6
* Laravel Collective 5.4.0
* Vue 2.5.17
* Sass 1.15.2
* Jquery 3.2
* Bootstrap 4.1.0
* cross-env 5.1
* Axios 0.18
* Laravel mix 4.0.7


### importante
Verificar que exista, en la carpeta storage, la carpeta framework. Dentro de framework debe estar cache, sessions y views.
Si no existen deberás crearlas.


### Localmente (Windows)
- Debes habilitar la extension de " extension=php_imap.dll " en el php.ini
- Instalar Imagick en el sistema y también sus librerias. Este punto puede causar problemas por lo que investigue bien en la documentación oficial: https://imagemagick.org/index.php
Le recomiendo buscar en foros cuando tenga inconvenientes.
Debe colocar un phpinfo en su index para saber la version de php y datos de valor que le ayudarán a elegir correctamente los archivos a descargar para implementar ésta librería. Este paso es importante, ya que puede tener varios problemas si confunde la versión.
Recuerde que deberá tener la extensión en el php.ini habilitada.
- En el php.ini el memory_limit llevarlo a 2048M

Luego correr:
- Correr: composer install
- Posiblemente haya versiones deprecadas. Corra: composer update y vea de actualizar las correspondientes (eso no podrá correrlo si tiene el memory_limit mas bajo, como en 512)
- Si tiene problemas considere correr: composer dump-autoload
- Instale ésta version de Carbon:  "nesbot/carbon": "^2.41"
- Correr: npm install
- Si tiene problemas puede probar:
  * npm cache clear (algunas versiones ya no hacen solo)
  * npm install --cache /tmp/empty-cache
  * Puede que tenga problemas por usar una consola sin permisos de administrador (si es el caso ejecute la consola como administrador)




### Servidor
Al subirlo por primera vez debes tener en cuenta que la extension de " extension=php_imap.dll " en el php.ini esté habilitada.
- Instalar Imagick en el sistema y también sus librerias. Este punto puede causar problemas por lo que investigue bien en la documentación oficial: https://imagemagick.org/index.php
Le recomiendo buscar en foros cuando tenga inconvenientes.
Debe colocar un phpinfo en su index para saber la version de php y datos de valor que le ayudarán a elegir correctamente los archivos a descargar para implementar ésta librería. Este paso es importante, ya que puede tener varios problemas si confunde la versión.
Recuerde que deberá tener la extensión en el php.ini habilitada.
- En el php.ini el memory_limit llevarlo a 2048M

Luego correr:
- composer install
- Posiblemente haya versiones deprecadas. Corra: composer update y vea de actualizar las correspondientes (eso no podrá correrlo si tiene el memory_limit mas bajo, como en 512)
- Si tiene problemas considere correr: composer dump-autoload
- Instale ésta version de Carbon:  "nesbot/carbon": "^2.41"
- npm install
- Si tiene problemas puede probar:
  * npm cache clear (algunas versiones ya no hacen solo)
  * npm install --cache /tmp/empty-cache
  * Puede que tenga problemas por usar una consola sin permisos de administrador (si es el caso ejecute la consola como administrador)
