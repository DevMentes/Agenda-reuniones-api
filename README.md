# AgendaReunionesCiisa-Back


Este proyecto contiene el backend para la agenda de reuniones de ciisa

Requisitos:

-PHP v7.2 +.

-Composer v1.8.0.

-Mysql v5.7 +.
*Nota: Si utilizas una versión de mysql 8 o superior, debes tener en cuenta que el tipo de autenticación por defecto ha cambiado, por lo que tendrás problemas con el proyecto, asegurate de configurar el tipo de autentificacion nativa para mysql.

-Git



Instalación:

*Nota: El proyecto se encuentra en fase de desarrollo y este es solo un MVP, por lo que el siguiente manual está enfocado para la realización de pruebas o para que puedas desarrollar por tu cuenta. Para el manual de instalación para configurar el proyecto en entorno de producción, deberás esperar la primera versión estable del proyecto que será lanzado prontamente.

Preparando el proyecto.

Antes de comenzar con este apartado, asegurate de tener instalados los requisitos minímos para el proyecto que están declarados en la sección de "Requisitos", una vez tengas todos los requisitos, prosigue con esta sección.

Obtener una copia del proyecto:

Lo primero que debes hacer es clonar o descargar el proyecto, debes acceder a él mediante el siguiente compando en consola:

git clone https://github.com/GetColors/Agenda-reuniones-api.git

Una vez hayas clonado el proyecto ya cuentas con el código fuente del proyecto, por lo que ya podemos comenzar con los preparativos, 

Instalando el proyecto:

Para realizar la instalación del proyecto, contamos con la ayuda de composer para gestionar las dependencias, por lo que se encargará de realizar casi todo el trabajo por nosotros.
Debes situarte dentro de el directorio raíz del proyecto (donde está ubicado el archivo composer.json), una vez dentro del directorio debes ejecutar el siguiente comando en la consola:

composer install

Debes contar con una conexión a internet para realizar ésto, puesto que composer debe descargar las dependencias requeridas por el proyecto para llevar a cabo su correcto funcionamiento. Una vez ejecutes el comando, composer comenzará a descargar todas las dependencias y las guardará en una carpeta "vendor" que se ubicará automáticamente en la raíz del proyecto, por lo que no debes realizar nada más que esperar a que finalice.

Configurando la base de datos.

El proyecto incluye un script para configurar la base de datos por lo que recomendamos lo ejecutes en mysql, directamente en consola o en algún gestor. El script creará automáticamente un nuevo  esquema de base de datos, además de proporcionarte un primer usuario de tipo administrador. Por defecto es "email = admin@email.com", "password = 00000000".

Perfecto, con esto ya tienes montada la base de datos y un primer usuario, ahora debes configurar el proyecto para que pueda conectarse a tu base de datos, para esto debes acceder al siguiente archivo:

proyecto/src/Infrastructure/Slim/bootstrap/databaseConfig.php

Dentro de ese archivo, debes confirurar los parámetros de acceso a tu base de datos.

host = dirección del host que mantiene la base de datos.
database = nombre de la base de datos.
username = nombre de usuario para acceder a la base de datos.
password = contraseña de acceso del usuario.

Ejecutar la aplicación:

Con los pasos anteriores ya has terminado de preparar y configurar el proyecto, por lo que puedes ejecutarlo, para ello, solo ejecuta dentro del directorio raíz del proyecto el siguiente comando:

php -S localhost:8000 -t public

esto ejecutará el proyecto en el puerto 8000 en tu direccion ip, puedes configurar el puerto y el host que quieras solo cambiando el parámetro correspondiente. 

Para probar que esté funcionando ve a tu navegador y accede a:

http://localhost:8000/

Deberías ver el mensaje "Api de Agenda Ciisa", esto quiere decir que el proyecto se ha levantado correctamente.
