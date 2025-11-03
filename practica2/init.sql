CREATE DATABASE IF NOT EXISTS webdb;
USE webdb;

CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Datos de prueba
INSERT INTO estudiantes (nombre, email) VALUES
("Daniel López", "dani@example.com"),
("Rubén de Mora", "ruben@example.com");

GRANT ALL PRIVILEGES ON webdb.* TO 'webuser'@'localhost' IDENTIFIED BY 'password123';
FLUSH PRIVILEGES;

EXIT