-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS sistema_escolar;
USE sistema_escolar;

-- Tabla de usuarios (administradivos/profesores)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- Almacenará hash de contraseña
    rol ENUM('admin', 'docente') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de estudiantes (datos sensibles encriptados)
CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo BLOB NOT NULL,  -- Almacenará dato encriptado
    dni BLOB NOT NULL,              -- Almacenará dato encriptado
    direccion BLOB NOT NULL,        -- Almacenará dato encriptado
    telefono BLOB,                  -- Almacenará dato encriptado
    historial_medico BLOB,          -- Almacenará dato encriptado
    email VARCHAR(100),             -- Dato no sensible (sin encriptar)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de materias
CREATE TABLE IF NOT EXISTS materias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    codigo VARCHAR(20) NOT NULL UNIQUE
);

-- Tabla de calificaciones (ejemplo adicional)
CREATE TABLE IF NOT EXISTS calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT NOT NULL,
    materia_id INT NOT NULL,
    puntuacion DECIMAL(5,2) NOT NULL,
    fecha_evaluacion DATE,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id),
    FOREIGN KEY (materia_id) REFERENCES materias(id)
);

-- Insertar usuario administrador inicial
-- Contraseña: "Admin123" (debes cambiarla en producción)
INSERT INTO usuarios (username, password, rol) 
VALUES (
    'admin', 
    '$2y$10$E3e0lWc3e0lWc3e0lWc3e.4e0lWc3e0lWc3e0lWc3e0lWc3e0lWc3e0', 
    'admin'
);

-- Insertar datos de prueba en materias
INSERT INTO materias (nombre, codigo) VALUES
('Matemáticas', 'MAT-101'),
('Lenguaje', 'LEN-201'),
('Ciencias Naturales', 'CIE-301');