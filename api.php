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

  function get($parameter) {
    if (isset($_GET[$parameter])) {
      return strip_tags(trim(addslashes($_GET[$parameter])));
    }
    else {
      return false;
    }
  }

  $kontrol = $db->prepare("SELECT * FROM rivayetki_user_permissions WHERE uuid = ?");
  $kontrol->execute(array(get("uuid")));
  
  if (get("uuid")){
    if($kontrol->rowCount() > 0){
      $redoarray = [];
      foreach($kontrol as $readkontrol) {
        $redoarray[] = array(
          'id' => $readkontrol["id"],
          'permission' => $readkontrol["permission"],
          'server' => $readkontrol["server"],
          'expiry' => $readkontrol["expiry"]
        );
      } 
      echo json_encode($redoarray);
    } else {
      die("Bu uuidde kullanıcı yok");
    }
  } else {
    die("Uuid belirlememişsin");
  }

$kontrol = $db->prepare("SELECT * FROM rivayetki_players WHERE uuid = ?");
  $kontrol->execute(array(get("uuid")));
  
  if (get("uuid")){
    if($kontrol->rowCount() > 0){
      $redoarray = [];
      foreach($kontrol as $readkontrol) {
        $redoarray[] = array(
          'uuid' => $readkontrol["uuid"],
          'username' => $readkontrol["username"],
          'primary_group' => $readkontrol["primary_group"]
        );
      } 
      echo json_encode($redoarray);
    } else {
      die("Bu uuidde kullanıcı yok");
    }
  } else {
    die("Uuid belirlememişsin");
  }


?>