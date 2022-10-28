# Lumen PHP Framework (REST) y Laravel Framework (SOAP)

Se uso para el servicio SOAP Doctrine ORM, y PHPUNIT para pruebas unitarias.

# Instalación

Habilitar la extensión:
extension=php_soap.dll

Crear una base de datos llamada epayco

Importar epayco.sql
No se crearon migraciones por cuestiones de tiempo

Clonar el repositorio:
    git clone https://github.com/webmasterscity/epayco_test.git
En la terminal entrar a la carpeta:
    soap
ejecutar el comando:
    composer install

Configurar el ENV con su base de datos y correo o puede usar el .ENVUSAR ya tiene un SMTP Valido para pruebas


En la terminal entrar a la carpeta:
    service_rest
ejecutar el comando:
    composer install

# En windows

synfony:
choco install symfony-cli
refreshenv
symfony server:start
symfony server:stop

# Extras

Correr pruebas unitarias SOAP
php bin/phpunit

Se adjunta Colección POSTMAN

