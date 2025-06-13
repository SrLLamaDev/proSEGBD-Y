<?php
// app/models/Database.php

class Database {
    private static $instance = null;
    private $connection;
    
    // Constructor privado para prevenir instanciación directa
    private function __construct() {
        try {
            // Requerir configuración
            require_once __DIR__ . '/../../config/env.php';
            
            // Crear conexión PDO
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $this->connection = new PDO($dsn, DB_USER, DB_PASS);
            
            // Configurar atributos
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
    
    // Método para obtener la instancia única
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    // Método para obtener la conexión
    public function getConnection() {
        return $this->connection;
    }
    
    // Prevenir la clonación del objeto
    private function __clone() { }
}