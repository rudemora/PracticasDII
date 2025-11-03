# Práctica 2: Creación de aplicación web en Azure

## Autores

- Daniel López Escobar
- Rubén de Mora Losada

## Instrucciones de despliegue e instalación en prueba local

1. El primer paso es instalar las dependencias
    ``` bash
    # actualizamos el registro de paquetes
    sudo apt update             

    # instalamos paquetes necesarios
    sudo apt install -y nginx php-fpm mariadb-server php-mysql 
    ```

2. Iniciar la base de datos
    ``` bash
    # Puede que haga falta encer el servicio, pero normalmente suele arrancar
    sudo mysql -u root -p < init.sql
    ``` 

3. Copiar el contenido de la página web
    ``` bash
    # Copiar directorio
    sudo mkdir /var/www/practica2
    sudo cp -r web /var/www/practica2/web

    # Ajustar permisos
    sudo chown -R www-data:www-data /var/www/practica2/web
    ```


4. Mover el archivo configurador del servidor nginx y activar el sitio
    ``` bash
    # Mover el archivo de configuracion
    sudo cp nginx_practica2.conf /etc/nginx/sites-available/practica2
    sudo ln -s /etc/nginx/sites-available/practica2 /etc/nginx/sites-enabled/
    sudo nginx -t
    sudo systemctl reload nginx
    ```

5. Abrir el navegador y comprobar `http://localhost/index.php`

---

## Despliegue en Azure
