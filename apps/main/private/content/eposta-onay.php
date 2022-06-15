<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(E_ALL);
ini_set("display_errors", 1);

//if (!isset($_SESSION["login"])) {
//	go("/giris-yap");
//}

if (post("send") == "true"){
	$url = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http").'://'.$_SERVER["SERVER_NAME"].'/dogrula/'.$readAccount["id"].'-'.strtotime(date("Y-m-d H:i:s")));
	$content1 = str_replace("%url%", $url, $readSettings["mailVerifyTemplate"]);
	//echo $readAccount["email"];

  require_once(__ROOT__."/apps/main/private/packages/class/phpmailer/exception.php");
  require_once(__ROOT__."/apps/main/private/packages/class/phpmailer/phpmailer.php");
  require_once(__ROOT__."/apps/main/private/packages/class/phpmailer/smtp.php");
  $phpMailer = new PHPMailer(true);
  
  $content = "Merhaba ".$readAccount["username"].";<br>E-posta adresini doğrulamak için aşağıdaki bağlantıyı tıklayabilirsin.<br><a href='".$url."'>".$url."</a>";
  try {
    $phpMailer->IsSMTP();
    $phpMailer->setLanguage('tr', __ROOT__.'/apps/main/private/packages/class/phpmailer/lang/');
    $phpMailer->SMTPAuth = true;
		//$phpMailer->SMTPDebug  = 2;
    $phpMailer->Host = $readSettings["smtpServer"];
    $phpMailer->Port = $readSettings["smtpPort"];
    $phpMailer->SMTPSecure = (($readSettings["smtpSecure"] == 1) ? PHPMailer::ENCRYPTION_SMTPS : (($readSettings["smtpSecure"] == 2) ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS));
    $phpMailer->Username = $readSettings["smtpUsername"];
    $phpMailer->Password = $readSettings["smtpPassword"];
    $phpMailer->SetFrom($phpMailer->Username, $readSettings["serverName"]);
    $phpMailer->AddAddress($readAccount["email"], $readAccount["realname"]);
    $phpMailer->isHTML(true);
    $phpMailer->CharSet = 'UTF-8';
    $phpMailer->Subject = $readSettings["serverName"]." - E-Posta Adresini Doğrula";
    $phpMailer->Body = $content1;
    $phpMailer->send();

  } catch (Exception $e) {
    echo alertError("Sistemsel bir hata nedeni ile mail gönderilemedi: ".$e->errorMessage());
  }
}


?>

<div class="gap"></div>
<div class="container">
  <div class="mail-dogrulama-wrapper">
    <!-- aşamalar -->
    <div class="steps-wrap">
      <div class="bar"></div>
      <div class="step active">
        <div class="number">1</div>
        <span>E-Posta Doğrulama</span>
      </div>
      <div class="step">
        <div class="number">2</div>
        <span>E-Posta Onay</span>
      </div>
    </div>
    <?php if (post("send") == "true"): ?>
      <style>.dogrulama-alert{display: block !important;}</style>
    <?php endif; ?>
    <!-- dogrulama alert kutusu-->
    <div class="dogrulama-alert">
      <p>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
          class="bi bi-check-circle-fill" viewBox="0 0 16 16">
          <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
        Mail Başarıyla Gönderildi.
      </p>
    </div>
    <!-- doğrulama gönderme kutusu -->
    <div class="dogrulama-box">
      <b>E-Posta Adresini Doğrula</b>
      <p>Kullanıcı sayfalarını görüntüleyebilmen ve işlem yapabilmen için e-posta adresini doğrulaman gerek.</p>
      <form method="post" accept-charset="utf-8">
        <input type="hidden" name="send" value="true">
        <button type="submit" class="animation-btn animation-btn-blue scrollbar-animation"><span>Doğrulama Maili Gönder</span></button>
      </form>
    </div>
  </div>
</div>
<div class="gap"></div>