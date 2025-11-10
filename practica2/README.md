# Práctica 2: Creación de aplicación web en Azure

## Autores

- Daniel López Escobar
- Rubén de Mora Losada

## Instrucciones de despliegue e instalación en prueba local

1. El primer paso es instalar las dependencias.
    ``` bash
    # actualizamos el registro de paquetes
    sudo apt update             

    # instalamos paquetes necesarios
    sudo apt install -y nginx php-fpm mariadb-server php-mysql 
    ```

2. Iniciar la base de datos.
    ``` bash
    # Puede que haga falta encer el servicio, pero normalmente suele arrancar
    sudo mysql -u root -p < init.sql
    ``` 

3. Copiar el contenido de la página web.
    ``` bash
    # Copiar directorio
    sudo mkdir /var/www/practica2
    sudo cp -r web /var/www/practica2/web

    # Ajustar permisos
    sudo chown -R www-data:www-data /var/www/practica2/web
    ```


4. Mover el archivo configurador del servidor nginx y activar el sitio.
    ``` bash
    # Mover el archivo de configuracion
    sudo cp nginx_practica2.conf /etc/nginx/sites-available/practica2
    sudo ln -s /etc/nginx/sites-available/practica2 /etc/nginx/sites-enabled/
    sudo nginx -t
    sudo systemctl reload nginx
    ```

5. Abrir el navegador y comprobar `http://localhost/index.php`.



---

## Despliegue en Azure

Para realizar este despligue hemos utilizado nuestras cuentas institucionales de la universidad, aprovechando el crédeito gratuito disponible.

1. Iniciar sesión y escoger licencia.
    ``` bash
    az login          
    ```

2. Creación del servidor SQL.
   ``` bash
    az mysql flexible-server create --resource-group practica2-rg --name "practica2-DII-dani-ruben-sql" --location "francecentral" --admin-user "webuser" --admin-password 'Password123!' --sku-name Standard_B1ms --public-access all
   ```

3. Creación de la base de datos.
   ``` bash
    az mysql flexible-server db create --resource-group "practica2-rg" --server-name "practica2-DII-dani-ruben-sql" --database-name webdb
   ```

4. Desactivación de SSL.
   ``` bash
    az mysql flexible-server parameter set --resource-group "practica2-rg" --server-name "practica2-DII-dani-ruben-sql" --name require_secure_transport --value OFF
   ```
5. Creación del App Service.
   ``` bash
    az webapp config appsettings set --resource-group "practica2-rg" --name "practica2-DII-dani-ruben" --settings DB_HOST="$DBHOST" DB_NAME="webdb" DB_USER="webuser@practica2-dii-dani-ruben-sql.mysql.database.azure.com" DB_PASS="Password123!"
   ```

6. Empaquetar y desplegar la aplicación.

   ``` bash
    zip -r webapp.zip index.php insert.php config.php

    az webapp deploy --resource-group "practica2-rg" --name "practica2-DII-dani-ruben" --src-path ./webapp.zip
   ```
5. Abrir el navegador y comprobar `https://practica2-dii-dani-ruben.azurewebsites.net/index.php`.


