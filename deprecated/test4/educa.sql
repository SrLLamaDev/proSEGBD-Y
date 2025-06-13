-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS educa CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE educa;

-- Usuario administrador
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL -- hash con password_hash()
);

-- Clave para cifrado (simulada aquí, en la app será segura)
SET @key := 'clave_segura_12345';

-- Tabla de estudiantes (con campos cifrados)
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARBINARY(255) NOT NULL,
    correo VARBINARY(255) NOT NULL,
    ci VARBINARY(255) NOT NULL
);

-- Tabla de materias
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARBINARY(255) NOT NULL,
    descripcion VARBINARY(255)
);
