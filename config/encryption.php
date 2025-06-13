<?php
// Clave de cifrado (debería almacenarse en una variable de entorno en producción)
define('ENCRYPTION_KEY', 'clave_segura_12345');

// Método de cifrado AES-256-CBC
define('CIPHER_METHOD', 'AES-256-CBC');

/**
 * Cifra un texto usando AES-256-CBC
 */
function encryptData($plaintext) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(CIPHER_METHOD));
    $encrypted = openssl_encrypt($plaintext, CIPHER_METHOD, ENCRYPTION_KEY, 0, $iv);
    return base64_encode($iv . $encrypted);
}

/**
 * Descifra un texto cifrado con AES-256-CBC
 */
function decryptData($ciphertext) {
    $ciphertext = base64_decode($ciphertext);
    $ivLength = openssl_cipher_iv_length(CIPHER_METHOD);
    $iv = substr($ciphertext, 0, $ivLength);
    $encrypted = substr($ciphertext, $ivLength);
    return openssl_decrypt($encrypted, CIPHER_METHOD, ENCRYPTION_KEY, 0, $iv);
}
?>
