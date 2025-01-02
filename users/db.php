<?php
$con = mysqli_connect("localhost", "serwer314716", "Wielorybhipis32!", "serwer314716_sobrerro");
// Check connection
if (mysqli_connect_errno()) {
    echo "Nie udało połączyć się z MySQL: " . mysqli_connect_error();
}

// Klucz szyfrowania
define('ENCRYPTION_KEY', 'TwójSekretnyKlucz123!@#'); // Upewnij się, że klucz jest unikalny i bezpieczny!

// Funkcja do szyfrowania danych
function encryptData($data)
{
    $key = ENCRYPTION_KEY;
    $cipher = "AES-256-CBC";
    $iv = substr(hash('sha256', $key), 0, 16); // Stały IV oparty na kluczu
    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
    return base64_encode($encrypted);
}

function decryptData($encryptedData)
{
    $key = ENCRYPTION_KEY;
    $cipher = "AES-256-CBC";
    $iv = substr(hash('sha256', $key), 0, 16); // Stały IV musi być taki sam
    $encrypted = base64_decode($encryptedData);
    return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
}

?>