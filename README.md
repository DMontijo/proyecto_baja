# Proyecto Video Denuncia (Baja California) by Yo Contigo IT.

## ¿Cómo instalar?

Para instalar este repo debes tener instalado composer.

Una vez instalado composer vas a la carpeta raíz del proyecto y corres el comanto `composer install` y listo.

**Nota:** Para poder iniciarlo debes tener un servidor local como mamp, xamp, laragon, etc., colocar el proyecto en la carpeta www o htdocs y posterior dirijirte al proyecto desde el navegador a la carpeta public.

## Documentación sobre codeigniter y bootstrap 5

[Documentación Codeigniter 4.](https://www.codeigniter.com/user_guide/index.html)
[Documentación Bootstrap 5.](https://getbootstrap.com/docs/5.0/getting-started/introduction/)

## Configuraciones

- Instalar composer.
- Correr el comando `composer install`.
- Copiar el archivo `env` y renombrar la copia a `.env`.
- Descomentar `CI_ENVIRONMENT = production` y pasar a `CI_ENVIRONMENT = development`.
- Descomentar `app.baseURL` y colocar la liga de tu proyecto `app.baseURL = 'http://localhost/proyecto_baja/public/`.

**Notas:**
- Cualquier configuración que se desee en el ambiente de desarrollo debes hacerlo en el archivo `.env`.
- Cualquier configuracióbn para el ambiente de producción se debe realizar en los archivos de configuraciones en app/Config

<!-- ## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works! -->

## Sobre el repositorio

Se esta usando un repositorio privado a nombre de Yo Contigo IT por lo tanto no es posible compartirlo sin autorización de Yo Contigo IT, de hacerlo se harán acreedores a las sanciones pertinentes.

## Requerimientos del servidor

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
