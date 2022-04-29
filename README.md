# Utilidades php
Docker - PHP 7.1

## Docker
- Si se inicia con docker o se cambia los archivos de docker ejecutar:
```bash
sudo docker-compose up --build -d
```
- En las siguientes oportunidades ejecutar:

Para levantar:
```bash
sudo docker-compose start
```
Para detener:
```bash
sudo docker-compose stop
```
- Para ingresar al contenedor con php ejecutar:
```bash
sudo docker-compose exec webserver bash
```
- Para ver desde un navegador:

Sin virtualhost:
```bash
http://localhost:8383
```
Con virtualhost:

Si se usa Linux, agregar en /etc/hosts de la pc host la siguiente linea:
```bash
11.23.21.19    local.domain.com
```

#### Generar Csv
- Crear carpeta `files` en la raíz (/) de la aplicación y darle permisos de lectura y escritura
- En la carpeta `files` se colocarán los csv's generados
- Al iniciar con docker, en la ruta `docker/php` se encuentra el archivo `init.sh` donde se asigna permisos a la carpeta `files` cuando se levante el contendor
-  Los archivos csv's se están generando a partir del archivo `users.json` que se encuentra en la raíz (/) de la aplicación, para generar el archivo csv, ingresar al contenedor con php (webserver) y dentro ejecutar el siguiente comando:
```bash
php public/generate_csv.php
```
- Si se quiere generar el csv desde el navegador comentar en el archivo `Csv.php` lo siguiente y luego ingresar a la url `http://localhost:8383/public/generate_csv.php`:
```bash
$val_cli = (PHP_SAPI === 'cli' OR defined('STDIN'));
if(!$val_cli) {
   die('Request is not permited.');
}
```
#### Generar Zip
- Se necesita instalar y habilitar la extensión zip para php, al iniciar docker se instalará está extensión.
- Crear carpeta `files_zip` en la raíz (/) de la aplicación y darle permisos de lectura y escritura
- En la carpeta `files_zip` se colocarán los archivos para luego agregar estos al zip que se va a generar.
- Al iniciar con docker, en la ruta `docker/php` se encuentra el archivo `init.sh` donde se asigna permisos a la carpeta `files_zip` cuando se levante el contendor
- Para generar el zip, ingresar desde el navegador a la siguiente url:
```bash
http://localhost:8383/public/generate_zip.php
```
#### Leer archivo .txt y generar archivo .sql
- Crear carpeta `files` en la raíz (/) de la aplicación y darle permisos de lectura y escritura
- En la carpeta `files` se colocarán los sql's generados
- Al iniciar con docker, en la ruta `docker/php` se encuentra el archivo `init.sh` donde se asigna permisos a la carpeta `files` cuando se levante el contendor
- Los archivos sql's se están generando a partir del archivo `read_data.txt` que se encuentra en la raíz (/) de la aplicación, para generar el archivo sql ingresar al contenedor con php (webserver) y dentro ejecutar el siguiente comando:
```bash
php public/read_file.php
```
- Si se quiere generar el sql desde el navegador ingresar a la url `http://localhost:8383/public/read_file.php`