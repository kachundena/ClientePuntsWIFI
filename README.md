Ejemplo cliente de servicios REST para Punts WIFI
=================================================

Aplicación Backoffice para csvPuntsWifi
---------------------------------------

http://localhost/clientepuntswifi/lista.php

Permite realizar tareas de mantenimiento sobre el csv de Puntos WIFI.

Utiliza la API csvPuntsWifi: http://localhost:8084/csvPuntsWifi/api/ws

Para los servicios REST de tipo POST, PUT y DELETE es necesario introducir la clave de autorización correcta.

API csvPuntsWifi: http://localhost:8084/csvPuntsWifi/api/ws


Aplicación cliente de ejemplo
-----------------------------

http://localhost/clientepuntswifi/maps.php

A partir de la selección de un distrito y un barrio nos muestra en un mapa la posición de los puntos WIFI.

Utiliza 4 APIs diferentes

* API csvPuntsWifi: http://localhost:8084/csvPuntsWifi/api/ws
* API csvDistrictes: http://localhost:8084/csvDistrictes/api/ws
* API csvBarris: http://localhost:8084/csvBarris/api/ws
* API Google Maps: https://maps.googleapis.com/maps/api/js

En los 3 primeros casos el numero de puerto os puede variar.

Para los servicios REST de tipo POST, PUT y DELETE es necesario introducir la clave de autorización correcta.

Instalación
-----------

Crea una carpeta en tu servidor apache y copia el contenido en la misma estructura

Asociale la carpeta al grupo www-data
