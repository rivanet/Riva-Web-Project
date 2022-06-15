<?php
  if (isset($_SESSION["login"])) {
    go("/profil");
  }
  use Phelium\Component\reCAPTCHA;
  $recaptchaPagesStatusJSON = $readSettings["recaptchaPagesStatus"];
  $recaptchaPagesStatus = json_decode($recaptchaPagesStatusJSON, true);
  $recaptchaStatus = $readSettings["recaptchaPublicKey"] != '0' && $readSettings["recaptchaPrivateKey"] != '0' && $recaptchaPagesStatus["loginPage"] == 1;
  if ($recaptchaStatus) {
    require_once(__ROOT__.'/apps/main/private/packages/class/extraresources/extraresources.php');
    require_once(__ROOT__.'/apps/main/private/packages/class/recaptcha/recaptcha.php');
    $reCAPTCHA = new reCAPTCHA($readSettings["recaptchaPublicKey"], $readSettings["recaptchaPrivateKey"]);
    $reCAPTCHA->setRemoteIp(getIP());
    $reCAPTCHA->setLanguage("tr");
    $reCAPTCHA->setTheme(($readTheme["recaptchaThemeID"] == 1) ? "light" : (($readTheme["recaptchaThemeID"] == 2) ? "dark" : "light"));
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource($reCAPTCHA->getScriptURL(), true, true);
  }
?>
  <style>
    iframe {
        padding: 0 0 0 0;
        height: 100px;
        width: 380px;
    }

    .g-recaptcha {
        width: 380px;
        height: 100px;
    }

    .header-hero-wrapper{
      display: none !important;
    }

    footer {
        display: none !important;
    }

    .register-banner {
        display: none !important;
    }

    .btn-danger, .badge-danger, .alert-danger, .bg-danger {
        background-color: #f62a5091;
        font-weight: bold;
        text-align: center;
        color: white;
    }
  </style>
<div class="register-wrapper">
  <div class="logo">
    <img src="images/footer-logo.svg" alt="Riva Network">
    <b>RIVA NETWORK</b>
  </div>
<?php
  require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
  $csrf = new CSRF('csrf-sessions', 'csrf-token');
  if (isset($_POST["login"])) {
    if (!$csrf->validate('login')) {
      echo alertError("Sistemsel bir sorun oluştu!");
    }
    else if ($recaptchaStatus && post("g-recaptcha-response") == null) {
      echo alertError("Robot olmadığınızı doğrulayın!");
    }
    else if ($recaptchaStatus && !$reCAPTCHA->isValid(post("g-recaptcha-response"))) {
      // Hata Tespit
      //var_dump($reCAPTCHA->getErrorCodes());
      echo alertError("Spam işlem tespit edildi!");
    }
    else if (post("username") == null || post("password") == null) {
      echo alertError("Lütfen boş alan bırakmayınız!");
    }
    else {
      $login = $db->prepare("SELECT * FROM Accounts WHERE realname = ?");
      $login->execute(array(post("username")));
      $readAccount = $login->fetch();
      if ($login->rowCount() > 0) {
        $password = (($readSettings["passwordType"] == 1) ? checkSHA256(post("password"), $readAccount["password"]) : ((md5(post("password")) == $readAccount["password"]) ? true : false));
        if ($password == true) {
          $siteBannedStatus = $db->prepare("SELECT * FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?)");
          $siteBannedStatus->execute(array($readAccount["id"], 1, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
          if ($siteBannedStatus->rowCount() > 0) {
            echo alertError("Engellendiğiniz için giriş yapamıyorsunuz!");
          }
          else {
            if ($readSettings["maintenanceStatus"] == 1 && ($readAccount["permission"] == 0 || $readAccount["permission"] == 6)) {
              echo alertError("Bakım modunda sadece yetkililer giriş yapabilir!");
            }
            else {
              if ($readSettings["authStatus"] == 1 && $readAccount["authStatus"] == 1) {
                $_SESSION["tfa"] = array(
                  'accountID'   => $readAccount["id"],
                  'rememberMe'  => (post("rememberMe")) ? 'true' : 'false',
                  'ipAddress'   => getIP(),
                  'expiryDate'  => createDuration(0.00347222222)
                );
                go("/dogrulama");
              }
              else {
                $loginType = 'NEW';
                if ($loginType == 'NEW') {
                  $db->beginTransaction();
                  $deleteOldSessions = $db->prepare("DELETE FROM AccountSessions WHERE accountID = ?");
                  $deleteOldSessions->execute(array($readAccount["id"]));

                  $loginToken = md5(uniqid(mt_rand(), true));
                  $insertAccountSessions = $db->prepare("INSERT INTO AccountSessions (accountID, loginToken, creationIP, expiryDate, creationDate) VALUES (?, ?, ?, ?, ?)");
                  $insertAccountSessions->execute(array($readAccount["id"], $loginToken, getIP(), createDuration(((isset($_POST["rememberMe"])) ? 365 : 0.01666666666)), date("Y-m-d H:i:s")));

                  if ($deleteOldSessions && $insertAccountSessions){
                    $db->commit(); // işlemi tamamla
                    if (post("rememberMe")) {
                      createCookie("rememberMe", $loginToken, 365, $sslStatus);
                    }
                    $_SESSION["login"] = $loginToken;
                    go("/profil");
                  }
                  else {
                    $db->rollBack(); // işlemi geri al
                    alertError("Hata!");
                  }
                }
                else {
                  $loginToken = md5(uniqid(mt_rand(), true));
                  $insertAccountSessions = $db->prepare("INSERT INTO AccountSessions (accountID, loginToken, creationIP, expiryDate, creationDate) VALUES (?, ?, ?, ?, ?)");
                  $insertAccountSessions->execute(array($readAccount["id"], $loginToken, getIP(), createDuration(((isset($_POST["rememberMe"])) ? 365 : 0.01666666666)), date("Y-m-d H:i:s")));

                  if (post("rememberMe")) {
                    createCookie("rememberMe", $loginToken, 365, $sslStatus);
                  }
                  $_SESSION["login"] = $loginToken;
                  go("/profil");
                }
              }
            }
          }
        }
        else {
          echo alertError("Yanlış şifre girdiniz!");
        }
      }
      else {
        echo alertError('<strong>'.post("username").'</strong> adında kullanıcı bulunamadı!');
      }
    }
  }
?>
  <form action="" method="post" id="loginform" style="width: 100%;margin-top: 2rem;">
    <div class="input-wrap">
      <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="18.886" height="23.853" viewBox="0 0 18.886 23.853">
          <g id="Iconly_Light_2-User" data-name="Iconly/Light/2-User" transform="translate(0.6 0.6)" opacity="0.75">
            <g id="_2-User" data-name="2-User" transform="translate(0 0)">
              <path id="Stroke-1"
                d="M9.593,12.707c4.767,0,8.843.723,8.843,3.609s-4.047,3.629-8.843,3.629c-4.769,0-8.843-.715-8.843-3.6S4.8,12.707,9.593,12.707Z"
                transform="translate(-0.75 2.707)" fill="none" stroke="#fff" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
              <path id="Stroke-3" d="M8.86,12.07a5.647,5.647,0,1,1,.04,0Z" transform="translate(-0.015 -0.776)"
                fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                fill-rule="evenodd" />
            </g>
          </g>
        </svg>
      </span>
      <input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı" value="<?php echo ((post("username")) ? post("username") : null); ?>">
    </div>
    <div class="input-wrap">
      <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20.878" height="25.137" viewBox="0 0 20.878 25.137">
          <g id="Iconly_Light_Lock" data-name="Iconly/Light/Lock" transform="translate(0.6 0.6)" opacity="0.75">
            <g id="Lock" transform="translate(0 0)">
              <path id="Stroke-1" d="M15.593,9.417V6.642A5.9,5.9,0,0,0,3.8,6.616v2.8"
                transform="translate(0.141 -0.732)" fill="none" stroke="#fff" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
              <path id="Stroke-3"
                d="M15.528,22.722H5.652a4.9,4.9,0,0,1-4.9-4.9V12.278a4.9,4.9,0,0,1,4.9-4.9h9.876a4.9,4.9,0,0,1,4.9,4.9v5.543a4.9,4.9,0,0,1-4.9,4.9Z"
                transform="translate(-0.75 1.216)" fill="none" stroke="#fff" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
              <line id="Stroke-5" y2="2.871" transform="translate(9.84 14.83)" fill="none" stroke="#fff"
                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
            </g>
          </g>
        </svg>
      </span>
      <input type="password" class="form-control" name="password" placeholder="Şifre">
    </div>

    <div class="register-bottom">
      <label class="check-container">Beni Hatırla
        <input type="checkbox" id="rememberMe" class="custom-control-input" name="rememberMe">
        <span class="checkmark"></span>
      </label>
      <a href="/sifremi-unuttum">Şifremi unuttum</a>
    </div>
    <br>
    <?php if ($recaptchaStatus): ?>
      <div class="form-group d-flex justify-content-center">
        <?php echo $reCAPTCHA->getHtml(); ?>
      </div>
    <?php endif; ?>
    <?php echo $csrf->input('login'); ?>
    <div class="register-button">
      <button type="submit" class="primary-btn normal-shadow" style="width: 100%;" name="login">GİRİŞ YAP</button>
    </div>
  </form>

  <div class="already-have">
    <p>Hey, henüz bir hesabın yok mu? Dert etme!</p>
    <a href="/kayit-ol">Tıkla ve oluştur</a>
  </div>

</div>