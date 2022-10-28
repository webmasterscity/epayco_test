# Lumen PHP Framework (REST) y Laravel Framework (SOAP)

Se uso para el servicio SOAP Doctrine ORM, y PHPUNIT para pruebas unitarias.

# Instalación en windows

Habilitar la extensión:
extension=php_soap.dll

Crear una base de datos llamada epayco

Importar epayco.sql
No se crearon migraciones por cuestiones de tiempo

Clonar el repositorio:
    git clone https://github.com/webmasterscity/epayco_test.git


# SYMFONY
choco install symfony-cli
refreshenv

En la terminal entrar a la carpeta:
    service_soap
ejecutar el comando:
    composer install

Configurar el ENV con su base de datos y correo o puede usar el .ENVUSAR ya tiene un SMTP Valido para pruebas
iniciar y parar servidor
symfony server:start
symfony server:stop

# LUMEN
En la terminal entrar a la carpeta:
    service_rest
ejecutar el comando:
    composer install

Se recomienda usar el puerto 8002
Iniciar servidor
php -S localhost:8002 -t public

# Extras

Correr pruebas unitarias SOAP
php bin/phpunit

Se adjunta Colección POSTMAN

Se adjunta Modelo entidad relación (MER)
