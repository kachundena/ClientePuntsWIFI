Ejemplo cliente de servicios REST para Punts WIFI
=================================================

Requisitos
----------

Para que esta aplicación funcione debemos tener instalado los siguientes proyectos

* csvDistrictes: https://github.com/kachundena/csvDistrictes
* csvBarris: https://github.com/kachundena/csvBarris
* csvPuntsWifi: https://github.com/kachundena/csvPuntsWifi


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

### Windows

Debes tener instalado el servidor apache con soporte php 5.0 (Wamp ó Xamp)

### Linux

Debes tener instalado el servidor apache y el soporte php

```
sudo apt-get install apache2

sudo apt-get install php5

sudo apt-get install libapache2-mod-php5

sudo /etc/init.d/apache2 restart
```

### Copia ficheros

Crea una carpeta (p.e. clientepuntswifi) en tu repositorio web del servidor apache

```
cd /var/www/html
sudo mkdir clientepuntswifi
```
Copia todo el contenido github en esta carpeta

### Permisos

Asociale www-data como propietario
```
sudo chown www-data:www-data -R clientepuntswifi/
```

Dale permisos

```
sudo chmod -R 775 clientepuntswifi/
```

Configuración
-------------

Existe un fichero XML de configuración, done indicamos las rutas de las diferentes API Rest que utiliza el proyecto. Debeis fijaros tanto en el servidor donde están alojadas como el puerto que utiliza. Yo utilizé Tomcat pero en el puerto 8084.

Tambien se debe configurar la llamada a la API de Google Maps. En este caso la ruta debe ser la que marco pero debeis indicar una key de Google Maps. Para obtenerla mirar la web  https://developers.google.com/maps/documentation/javascript/get-api-key?hl=ES. Sustituir <PON TU CODIGO> por la clave obtenida.

```
<?xml version="1.0" encoding="utf-8"?>
<config>
	<rutas>
		<rest><![CDATA[http://localhost:8084/csvPuntsWifi/api/ws]]></rest>
		<districte><![CDATA[http://localhost:8084/csvDistrictes/api/ws]]></districte>
		<barri><![CDATA[http://localhost:8084/csvBarris/api/ws]]></barri>
		<maps><![CDATA[https://maps.googleapis.com/maps/api/js?key=<PON TU CODIGO>&signed_in=true&callback=initMap]]></maps>
	</rutas>
</config>
```
