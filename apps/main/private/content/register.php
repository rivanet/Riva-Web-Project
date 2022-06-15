<?php
  if (isset($_SESSION["login"])) {
    go("/profil");
  }
  use Phelium\Component\reCAPTCHA;
  $recaptchaPagesStatusJSON = $readSettings["recaptchaPagesStatus"];
  $recaptchaPagesStatus = json_decode($recaptchaPagesStatusJSON, true);
  $recaptchaStatus = $readSettings["recaptchaPublicKey"] != '0' && $readSettings["recaptchaPrivateKey"] != '0' && $recaptchaPagesStatus["registerPage"] == 1;
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
    <img src="images/footer-logo.svg" alt="">
    <b>RIVA NETWORK</b>
  </div>
  <?php
    require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
    $csrf = new CSRF('csrf-sessions', 'csrf-token');
    if (isset($_POST["insertAccounts"])) {
      if (!$csrf->validate('insertAccounts')) {
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
      else if (post("username") == null || post("email") == null || post("password") == null || post("passwordRe") == null) {
        echo alertError("Lütfen boş alan bırakmayınız!");
      }
      else {
        $usernameValid = $db->prepare("SELECT * FROM Accounts WHERE realname = ?");
        $usernameValid->execute(array(post("username")));

        $emailValid = $db->prepare("SELECT * FROM Accounts WHERE email = ?");
        $emailValid->execute(array(post("email")));

        $ipCount = $db->prepare("SELECT * FROM Accounts WHERE creationIP = ?");
        $ipCount->execute(array(getIP()));

        $badUsernameList = array(
          'yarrak',
          'sikis',
          'serefsiz',
          'amcik',
		  'annesiz',
          'orospu'
		  'Riva'
		  'RivaNetwork'
        );

        if (!post("acceptRules")) {
          echo alertError("Lütfen kuralları kabul ediniz!");
        }
        else if ($registerLimit != 0 && $ipCount->rowCount() >= $registerLimit) {
          echo alertError('Aynı IP adresinden en fazla <strong>'.$registerLimit.' kez</strong> kayıt olabilirsiniz!');
        }
        else if (checkUsername(post("username"))) {
          echo alertError("Girdiğiniz kullanıcı adı uygun olmayan karakter içeriyor!");
        }
        else if (strlen(post("username")) < 3) {
          echo alertError("Kullanıcı adı 3 karakterden az olamaz!");
        }
        else if (strlen(post("username")) > 16) {
          echo alertError("Kullanıcı adı 16 karakterden fazla olamaz!");
        }
        else if (checkEmail(post("email"))) {
          echo alertError("Lütfen geçerli bir e-posta adresi giriniz!");
        }
        else if ($usernameValid->rowCount() > 0) {
          echo alertError('<strong>'.post("username").'</strong> adlı oyuncu mevcut!');
        }
        else if ($emailValid->rowCount() > 0) {
          echo alertError('<strong>'.post("email").'</strong> başkası tarafından kullanılıyor!');
        }
        else if (strlen(post("password")) < 4) {
          echo alertError("Şifre 4 karakterden az olamaz!");
        }
        else if (post("password") != post("passwordRe")) {
          echo alertError("Şifreler uyuşmuyor!");
        }
        else if (checkBadPassword(post("password"))) {
          echo alertError("Basit şifreler kullanamazsınız!");
        }
        else if (checkBadUsername(post("username"), $badUsernameList)) {
          echo alertError("Yasaklı kelimeler içeren kullanıcı adlarını kullanamazsınız!");
        }
        else {
          $loginToken = md5(uniqid(mt_rand(), true));
          $password = (($readSettings["passwordType"] == 1) ? createSHA256(post("password")) : md5(post("password")));
          $insertAccounts = $db->prepare("INSERT INTO Accounts (username, realname, email, password, verify, creationIP, creationDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
          $insertAccounts->execute(array(strtolower(post("username")), post("username"), post("email"), $password, 1, getIP(), date("Y-m-d H:i:s")));
          $accountID = $db->lastInsertId();
          $insertAccountSessions = $db->prepare("INSERT INTO AccountSessions (accountID, loginToken, creationIP, expiryDate, creationDate) VALUES (?, ?, ?, ?, ?)");
          $insertAccountSessions->execute(array($accountID, $loginToken, getIP(), createDuration(0.01666666666), date("Y-m-d H:i:s")));
          $_SESSION["login"] = $loginToken;
          echo alertSuccess("Başarıyla kayıt oldunuz! Yönlendiriliyorsunuz...");
          echo goDelay("/profil", 2);
        }
      }
    }
  ?>
  <form action="" method="post" id="loginform" style="width: 75%;margin-top: 2rem;">
    
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
      <input type="email" class="form-control" name="email" placeholder="E-posta Adresi" value="<?php echo ((post("email")) ? post("email") : null); ?>">
    </div>
    <div class="flex-input-wrap">
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
        <input type="password" class="form-control" name="passwordRe" placeholder="Şifre (Onayı)">
      </div>
    </div>
    <div class="policies">
        <label class="check-container rounded">
        <a target="_blank" href="/hizmet-sartlari-ve-üyelik-sözlesmesi">Hizmet Şartları ve Üyelik Sözleşmesi</a>,
        <a target="_blank" href="/gizlilik-politikasi">Gizlilik Politikası</a>,
        <a target="_blank" href="/kurallar">Kurallar</a> ve 
        <a target="_blank" href="/kvkk">KVKK</a>'yi okudum ve kabul ediyorum.
        <input type="checkbox" class="custom-control-input" id="acceptRules" name="acceptRules" checked="checked">
        <span class="checkmark"></span>
</span>
      </label>
    </div>
    <br>
    <?php if ($recaptchaStatus): ?>
      <div class="form-group d-flex justify-content-center">
        <?php echo $reCAPTCHA->getHtml(); ?>
      </div>
    <?php endif; ?>
    <?php echo $csrf->input('insertAccounts'); ?>
    <button type="submit" class="primary-btn normal-shadow m-auto" name="insertAccounts">Kayıt Ol</button>
  </form>
  <div class="already-have">
    <p>Hey, zaten bir hesabın var mı? hemen giriş yap!</p>
    <a href="/giris-yap">Tıkla ve giriş yap</a>
  </div>
</div>
