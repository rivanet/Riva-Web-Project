<?php
  if (isset($_SESSION["login"])) {
    go("/profil");
  }
  if ($readSettings["authStatus"] == 0) {
    go("/giris-yap");
  }
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  use Phelium\Component\reCAPTCHA;
  $recaptchaPagesStatusJSON = $readSettings["recaptchaPagesStatus"];
  $recaptchaPagesStatus = json_decode($recaptchaPagesStatusJSON, true);
  $recaptchaStatus = $readSettings["recaptchaPublicKey"] != '0' && $readSettings["recaptchaPrivateKey"] != '0' && $recaptchaPagesStatus["tfaPage"] == 1;
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
<section class="section section-recover">
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <?php if (get("id") && get("token")): ?>
          <?php
            require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
            $csrf = new CSRF('csrf-sessions', 'csrf-token');
            $checkToken = $db->prepare("SELECT * FROM AccountTFARecovers WHERE accountID = ? AND recoverToken = ? AND creationIP = ? AND expiryDate > ?");
            $checkToken->execute(array(get("id"), get("token"), getIP(), date("Y-m-d H:i:s")));
          ?>
          <?php if ($checkToken->rowCount() > 0): ?>
            <?php
              $account = $db->prepare("SELECT * FROM Accounts WHERE id = ?");
              $account->execute(array(get("id")));
              $readAccount = $account->fetch();
            ?>
            <?php if ($account->rowCount() > 0): ?>
              <?php if ($readAccount["authStatus"] == 1): ?>
                <?php
                  if (isset($_SESSION["tfa-recover"]) && $_SESSION["tfa-recover"]["expiryDate"] <= date("Y-m-d H:i:s")) {
                    unset($_SESSION["tfa-recover"]);
                  }
                  if (!isset($_SESSION["tfa-recover"]["expiryDate"])) {
                    $_SESSION["tfa-recover"]["expiryDate"] = createDuration(0.00347222222);
                  }

                  require_once(__ROOT__."/apps/main/private/packages/class/tfa/tfa.php");
                  $tfa = new GoogleAuthenticator();
                  if (!isset($_SESSION["tfa-recover"]["secretKey"])) {
                    $_SESSION["tfa-recover"]["secretKey"] = $tfa->createSecret();
                  }
                  $qrCode = $tfa->getQRCodeGoogleUrl($readAccount["realname"], $_SESSION["tfa-recover"]["secretKey"], $serverName);

                  if (isset($_POST["verifyTFARecover"])) {
                    if (!$csrf->validate('verifyTFARecover')) {
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
                    else if (post("oneCode") == null) {
                      echo alertError("Lütfen boş alan bırakmayınız!");
                    }
                    else {
                      $verifyTFA = $tfa->verifyCode($_SESSION["tfa-recover"]["secretKey"], post("oneCode"));
                      if ($verifyTFA) {
                        $deleteAccountSessions = $db->prepare("DELETE FROM AccountSessions WHERE accountID = ?");
                        $deleteAccountSessions->execute(array($readAccount["id"]));

                        $accountAuth = $db->prepare("SELECT * FROM AccountAuths WHERE accountID = ?");
                        $accountAuth->execute(array($readAccount["id"]));
                        if ($accountAuth->rowCount() > 0) {
                          $updateAccountAuths = $db->prepare("UPDATE AccountAuths SET secretKey = ? WHERE accountID = ?");
                          $updateAccountAuths->execute(array($_SESSION["tfa-recover"]["secretKey"], $readAccount["id"]));
                        }
                        else {
                          $insertAccountAuths = $db->prepare("INSERT INTO AccountAuths (accountID, secretKey) VALUES (?, ?)");
                          $insertAccountAuths->execute(array($readAccount["id"], $_SESSION["tfa-recover"]["secretKey"]));
                        }

                        $deleteAccountTFARecovers = $db->prepare("DELETE FROM AccountTFARecovers WHERE accountID = ?");
                        $deleteAccountTFARecovers->execute(array($readAccount["id"]));

                        unset($_SESSION["tfa"]);
                        unset($_SESSION["tfa-recover"]);
                        echo alertSuccess("TFA başarıyla güncellendi! Yönlendiriliyorsunuz...");
                        echo goDelay("/giris-yap", 2);
                      }
                      else {
                        echo alertError("Girmiş olduğunuz tek kullanımlık kod yanlış!");
                      }
                    }
                  }
                ?>
                <div class="card">
                  <div class="card-header">
                    İki Adımlı Doğrulamayı Sıfırla
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="form-group text-center">
                        <img src="<?php echo $qrCode; ?>" alt="Google Authenticator QR Kod">
                      </div>
                      <div class="form-group text-center">
                        <span>QR Kod'u okutamıyorsanız <strong><?php echo $_SESSION["tfa-recover"]["secretKey"]; ?></strong> anahtarı ile hesap ekleyiniz.</span>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="oneCode" placeholder="Tek kullanımlık kodu giriniz." autocomplete="off">
                      </div>
                      <?php if ($recaptchaStatus): ?>
                        <div class="form-group d-flex justify-content-center">
                          <?php echo $reCAPTCHA->getHtml(); ?>
                        </div>
                      <?php endif; ?>
                      <?php echo $csrf->input('verifyTFARecover'); ?>
                      <button type="submit" class="theme-color btn btn-primary w-100" name="verifyTFARecover">Doğrula</button>
                    </form>
                  </div>
                  <div class="card-footer text-center">
                    <a href="https://support.google.com/accounts/answer/1066447?hl=TR" rel="external">Google Authenticator'i nasıl kullanırım?</a>
                  </div>
                </div>
              <?php else: ?>
                <?php echo alertError("Bu kullanıcıya ait TFA kapalı durumda!"); ?>
              <?php endif; ?>
            <?php else: ?>
                <?php echo alertError("Kullanıcı bulunamadı!"); ?>
            <?php endif; ?>
          <?php else: ?>
            <?php echo alertError("Sıfırlama bağlantısı bozuk veya kullanım süresi sona erdi!"); ?>
          <?php endif; ?>
        <?php else: ?>
          <?php
            if (isset($_SESSION["tfa"]) && $_SESSION["tfa"]["expiryDate"] <= date("Y-m-d H:i:s")) {
              unset($_SESSION["tfa"]);
            }
            if (!isset($_SESSION["tfa"])) {
              go("/giris-yap");
            }
          ?>
          <?php if ($_SESSION["tfa"]["ipAddress"] == getIP()): ?>
            <?php
              $account = $db->prepare("SELECT * FROM Accounts WHERE id = ?");
              $account->execute(array($_SESSION["tfa"]["accountID"]));
              $readAccount = $account->fetch();
            ?>
            <?php if ($account->rowCount() > 0): ?>
              <?php if ($readAccount["authStatus"] == 1): ?>
                <?php
                  require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
                  $csrf = new CSRF('csrf-sessions', 'csrf-token');
                  if (isset($_POST["sendTFAEmail"])) {
                    if (!$csrf->validate('sendTFAEmail')) {
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
                    else if (post("email") == null) {
                      echo alertError("Lütfen boş alan bırakmayınız!");
                    }
                    else {
                      $checkAccount = $db->prepare("SELECT * FROM Accounts WHERE id = ? AND email = ?");
                      $checkAccount->execute(array($readAccount["id"], post("email")));
                      $readAccount = $checkAccount->fetch();
                      if ($checkAccount->rowCount() > 0) {
                        $recoverToken = md5(uniqid(mt_rand(), true));
                        $url = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http").'://'.$_SERVER["SERVER_NAME"].'/dogrulama-sifirla/'.$readAccount["id"].'/'.$recoverToken);
                        $search = array("%username%", "%url%");
                        $replace = array($readAccount["realname"], $url);
                        $template = $readSettings["smtpTFATemplate"];
                        $content = str_replace($search, $replace, $template);
                        require_once(__ROOT__."/apps/main/private/packages/class/phpmailer/exception.php");
                        require_once(__ROOT__."/apps/main/private/packages/class/phpmailer/phpmailer.php");
                        require_once(__ROOT__."/apps/main/private/packages/class/phpmailer/smtp.php");
                        $phpMailer = new PHPMailer(true);
                        try {
                          $phpMailer->IsSMTP();
                          $phpMailer->setLanguage('tr', __ROOT__.'/apps/main/private/packages/class/phpmailer/lang/');
                          $phpMailer->SMTPAuth = true;
                          $phpMailer->Host = $readSettings["smtpServer"];
                          $phpMailer->Port = $readSettings["smtpPort"];
                          $phpMailer->SMTPSecure = (($readSettings["smtpSecure"] == 1) ? PHPMailer::ENCRYPTION_SMTPS : (($readSettings["smtpSecure"] == 2) ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS));
                          $phpMailer->Username = $readSettings["smtpUsername"];
                          $phpMailer->Password = $readSettings["smtpPassword"];
                          $phpMailer->SetFrom($phpMailer->Username, $readSettings["serverName"]);
                          $phpMailer->AddAddress($readAccount["email"], $readAccount["realname"]);
                          $phpMailer->isHTML(true);
                          $phpMailer->CharSet = 'UTF-8';
                          $phpMailer->Subject = $readSettings["serverName"]." - İki Adımlı Doğrulama Sıfırlama";
                          $phpMailer->Body = $content;
                          $phpMailer->send();
                          $checkAccountRecovers = $db->prepare("SELECT * FROM AccountTFARecovers WHERE accountID = ?");
                          $checkAccountRecovers->execute(array($readAccount["id"]));
                          if ($checkAccountRecovers->rowCount() > 0) {
                            $updateAccountRecovers = $db->prepare("UPDATE AccountTFARecovers SET recoverToken = ?, creationIP = ?, expiryDate = ?, creationDate = ? WHERE accountID = ?");
                            $updateAccountRecovers->execute(array($recoverToken, getIP(), createDuration(0.04166666666), date("Y-m-d H:i:s"), $readAccount["id"]));
                          }
                          else {
                            $insertAccountRecovers = $db->prepare("INSERT INTO AccountTFARecovers (accountID, recoverToken, creationIP, expiryDate, creationDate) VALUES (?, ?, ?, ?, ?)");
                            $insertAccountRecovers->execute(array($readAccount["id"], $recoverToken, getIP(), createDuration(0.04166666666), date("Y-m-d H:i:s")));
                          }
                          echo alertSuccess("Email adresinize sıfırlama bağlantısı gönderildi!");
                        } catch (Exception $e) {
                          echo alertError("Sistemsel bir hata nedeni ile mail gönderilemedi: ".$e->errorMessage());
                        }
                      }
                      else {
                        echo alertError("Email adresi doğrulunamadı!");
                      }
                    }
                  }
                ?>
                <div class="card">
                  <div class="card-header">
                    İki Adımlı Doğrulamayı Sıfırla
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Adresi">
                      </div>
                      <?php if ($recaptchaStatus): ?>
                        <div class="form-group d-flex justify-content-center">
                          <?php echo $reCAPTCHA->getHtml(); ?>
                        </div>
                      <?php endif; ?>
                      <?php echo $csrf->input('sendTFAEmail'); ?>
                      <button type="submit" class="theme-color btn btn-primary w-100" name="sendTFAEmail">Gönder</button>
                    </form>
                  </div>
                  <div class="card-footer text-center">
                    <a href="/dogrulama">Doğrulamaya Geri Dön</a>
                  </div>
                </div>
              <?php else: ?>
                <?php unset($_SESSION["tfa"]); ?>
                <?php echo alertError("Bu kullanıcıya ait TFA kapalı durumda!"); ?>
              <?php endif; ?>
            <?php else: ?>
              <?php unset($_SESSION["tfa"]); ?>
              <?php echo alertError("Kullanıcı bulunamadı!"); ?>
            <?php endif; ?>
          <?php else: ?>
            <?php unset($_SESSION["tfa"]); ?>
            <?php echo alertError("IP adresi geçersiz!"); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
