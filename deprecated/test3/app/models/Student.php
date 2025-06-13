<?php
// app/models/Student.php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../utils/Encryption.php';

class Student {
    private $db;
    private $encryptionKey;

    public function __construct() {
        // Obtener conexión a la base de datos
        $this->db = Database::getInstance()->getConnection();
        
        // Obtener clave de encriptación desde configuración
        require_once __DIR__ . '/../../config/env.php';
        $this->encryptionKey = ENCRYPTION_KEY;
        
        // Validar longitud de clave
        if (strlen($this->encryptionKey) !== 32) {
            throw new Exception("La clave de encriptación debe tener exactamente 32 caracteres");
        }
    }

    // Crear un nuevo estudiante (encripta datos sensibles)
    public function create($data) {
        try {
            // Encriptar datos sensibles
            $encryptedData = [
                'nombre_completo' => Encryption::encrypt($data['nombre_completo'], $this->encryptionKey),
                'dni' => Encryption::encrypt($data['dni'], $this->encryptionKey),
                'direccion' => Encryption::encrypt($data['direccion'], $this->encryptionKey),
                'telefono' => isset($data['telefono']) ? Encryption::encrypt($data['telefono'], $this->encryptionKey) : null,
                'historial_medico' => isset($data['historial_medico']) ? Encryption::encrypt($data['historial_medico'], $this->encryptionKey) : null,
                'email' => $data['email'] // Dato no sensible
            ];

            // Preparar consulta SQL
            $sql = "INSERT INTO estudiantes (nombre_completo, dni, direccion, telefono, historial_medico, email) 
                    VALUES (:nombre_completo, :dni, :direccion, :telefono, :historial_medico, :email)";
            
            $stmt = $this->db->prepare($sql);
            
            // Ejecutar consulta
            return $stmt->execute($encryptedData);
            
        } catch (Exception $e) {
            error_log("Error al crear estudiante: " . $e->getMessage());
            return false;
        }
    }

    // Obtener estudiante por ID (desencripta datos sensibles)
    public function getById($id) {
        try {
            $sql = "SELECT * FROM estudiantes WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($student) {
                // Desencriptar datos sensibles
                $student['nombre_completo'] = Encryption::decrypt($student['nombre_completo'], $this->encryptionKey);
                $student['dni'] = Encryption::decrypt($student['dni'], $this->encryptionKey);
                $student['direccion'] = Encryption::decrypt($student['direccion'], $this->encryptionKey);
                
                if ($student['telefono']) {
                    $student['telefono'] = Encryption::decrypt($student['telefono'], $this->encryptionKey);
                }
                
                if ($student['historial_medico']) {
                    $student['historial_medico'] = Encryption::decrypt($student['historial_medico'], $this->encryptionKey);
                }
            }
            
            return $student;
            
        } catch (Exception $e) {
            error_log("Error al obtener estudiante: " . $e->getMessage());
            return null;
        }
    }

    // Obtener todos los estudiantes (sin desencriptar - para demostración)
    public function getAllEncrypted() {
        try {
            $sql = "SELECT id, email, nombre_completo AS nombre_encrypted, 
                    dni AS dni_encrypted, created_at 
                    FROM estudiantes";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (Exception $e) {
            error_log("Error al obtener estudiantes: " . $e->getMessage());
            return [];
        }
    }

    // Actualizar estudiante
    public function update($id, $data) {
        try {
            // Encriptar datos sensibles
            $encryptedData = [
                'nombre_completo' => Encryption::encrypt($data['nombre_completo'], $this->encryptionKey),
                'dni' => Encryption::encrypt($data['dni'], $this->encryptionKey),
                'direccion' => Encryption::encrypt($data['direccion'], $this->encryptionKey),
                'telefono' => isset($data['telefono']) ? Encryption::encrypt($data['telefono'], $this->encryptionKey) : null,
                'historial_medico' => isset($data['historial_medico']) ? Encryption::encrypt($data['historial_medico'], $this->encryptionKey) : null,
                'email' => $data['email'],
                'id' => $id
            ];

            $sql = "UPDATE estudiantes SET 
                    nombre_completo = :nombre_completo,
                    dni = :dni,
                    direccion = :direccion,
                    telefono = :telefono,
                    historial_medico = :historial_medico,
                    email = :email
                    WHERE id = :id";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($encryptedData);
            
        } catch (Exception $e) {
            error_log("Error al actualizar estudiante: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar estudiante
    public function delete($id) {
        try {
            $sql = "DELETE FROM estudiantes WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
            
        } catch (Exception $e) {
            error_log("Error al eliminar estudiante: " . $e->getMessage());
            return false;
        }
    }
}