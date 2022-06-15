<?php 
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

if (!empty($_POST['username']) && !empty($_POST['password'])) {
	$password_sha256=hash('sha256', $_POST['password']);
	$username=strip_tags($_POST['username']);
	
		$user_email_check = $conn->query("SELECT * FROM Accounts WHERE username='$username'");
		if ( $user_email_check->rowCount()==1 ){
			$user_email_check_fech = $user_email_check->fetch(PDO::FETCH_ASSOC);

			$user_info = $conn->query("SELECT * FROM Accounts WHERE id='".$user_email_check_fech['id']."' AND password='$password_sha256'");
			if ( $user_info->rowCount()==1 ){
				$jsonArray["error"] = FALSE;
				$jsonArray["message_tr"] = 'Başarıyla giriş yaptınız.';
			}else{
				$jsonArray["error"] = TRUE;
				$jsonArray["error_description"] = 'Şifre yanlış.';
				$jsonArray["message_tr"] = 'Şifre yanlış.';
				$jsonArray["error_code"] = 002;
			}
			
		}else{
			$jsonArray["error"] = TRUE;
			$jsonArray["error_description"] = 'E-posta yanlış.';
			$jsonArray["message_tr"] = 'E-posta yanlış.';
			$jsonArray["error_code"] = 001;
		}

}else{
	$jsonArray["error"] = TRUE;
	$jsonArray["error_description"] = 'Eksik gönderi.';
	$jsonArray["message_tr"] = 'Tüm alanları doldurun.';
	$jsonArray["error_code"] = 003;
}

echo json_encode($jsonArray);
?>