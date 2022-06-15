<?php
  define('DB_HOST', '92.249.24.103');
  define('DB_PORT', '3306');
  define('DB_USERNAME', 'riva_auth');
  define('DB_PASSWORD', 'i8E85fs@');
  define('DB_NAME', 'riva_auth');

  try {
    $db = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=utf8", DB_USERNAME, DB_PASSWORD);
  }
  catch (PDOException $e) {
    die("<strong>MySQL bağlantı hatası:</strong> ".utf8_encode($e->getMessage()));
  }
?>