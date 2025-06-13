<?php
// app/utils/Encryption.php

class Encryption {
    // Método para encriptar datos
    public static function encrypt($data, $key) {
        // Validar clave (32 bytes para AES-256)
        if (strlen($key) !== 32) {
            throw new Exception("La clave de encriptación debe tener 32 caracteres");
        }
        
        // Generar IV (Initialization Vector)
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        
        // Encriptar datos
        $encrypted = openssl_encrypt(
            $data, 
            'aes-256-cbc', 
            $key, 
            OPENSSL_RAW_DATA, 
            $iv
        );
        
        // Combinar IV + datos encriptados
        return base64_encode($iv . $encrypted);
    }

    // Método para desencriptar datos
    public static function decrypt($data, $key) {
        // Validar clave
        if (strlen($key) !== 32) {
            throw new Exception("Clave de encriptación inválida");
        }
        
        // Decodificar base64
        $data = base64_decode($data);
        
        // Extraer IV (primeros 16 bytes)
        $iv = substr($data, 0, 16);
        
        // Extraer datos encriptados
        $encrypted = substr($data, 16);
        
        // Desencriptar
        return openssl_decrypt(
            $encrypted, 
            'aes-256-cbc', 
            $key, 
            OPENSSL_RAW_DATA, 
            $iv
        );
    }
}