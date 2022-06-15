<?php
  if (isset($_SESSION["login"]) && strtolower($readAccount["realname"]) == strtolower(get("id"))) {
    go('/profil');
  }
?>

<?php if (isset($_GET["id"])): ?>
      <?php
        $player = $db->prepare("SELECT * FROM Accounts WHERE realname = ? ORDER BY id DESC LIMIT 1");
        $player->execute(array(get("id")));
        $readPlayer = $player->fetch();
      ?>
      <?php if ($player->rowCount() > 0): ?>
        <div class="container">
          <div class="user-acc">
            <div class="pic-wrap">
              <div class="pic">
                <img src="https://minotar.net/avatar/<?php $readPlayer["realname"]; ?>/150.png" alt="">
              </div>
            </div>
            <div class="profile-details">
              <span><?php echo $readPlayer["realname"]; ?></span>
              <div class="rank-wrap">
                <div class="rank">
                  <span><?php echo permissionName($readPlayer["permission"]); ?></span>
                </div>
                <div class="rank">
                  <img src="images/valorantgold.png" alt="">
                  <div class="rank-tooltip">
                    <p><span>Seviye:</span> Altın 3</p>
                    <p><span>Tecrübe Puanı:</span> 0 TP</p>
                    <p><span>Sonraki Seviye:</span> 0 TP</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="status">
              <span class="green">Çevrimiçi</span>
            </div>
          </div>
        </div>

        <div class="profile-page-wrapper">
          <div class="container">
            <div class="profile-card no-pad">
              <div class="card-header center">
                <div class="left">
                  <h2>OYUN BİLGİLERİ</h2>
                </div>
              </div>

              <div class="user-games-list">
                <div class="user-game">
                  <div class="title">SPEED BUILDERS</div>
                  <div class="image"><img src="images/speedbuilders.jpg" alt=""></div>
                  <div class="g-row">
                    <b>Kazanma</b>
                    <span>4.623</span>
                  </div>
                  <div class="g-row">
                    <b>Puan</b>
                    <span>499.192</span>
                  </div>
                </div>
                <div class="user-game">
                  <div class="title">SPEED BUILDERS</div>
                  <div class="image"><img src="images/speedbuilders.jpg" alt=""></div>
                  <div class="g-row">
                    <b>Kazanma</b>
                    <span>4.623</span>
                  </div>
                  <div class="g-row">
                    <b>Puan</b>
                    <span>499.192</span>
                  </div>
                </div>
                <div class="user-game">
                  <div class="title">SPEED BUILDERS</div>
                  <div class="image"><img src="images/speedbuilders.jpg" alt=""></div>
                  <div class="g-row">
                    <b>Kazanma</b>
                    <span>4.623</span>
                  </div>
                  <div class="g-row">
                    <b>Puan</b>
                    <span>499.192</span>
                  </div>
                </div>
                <div class="user-game">
                  <div class="title">SPEED BUILDERS</div>
                  <div class="image"><img src="images/speedbuilders.jpg" alt=""></div>
                  <div class="g-row">
                    <b>Kazanma</b>
                    <span>4.623</span>
                  </div>
                  <div class="g-row">
                    <b>Puan</b>
                    <span>499.192</span>
                  </div>
                </div>
              </div>


            </div>
            <div class="profile-sidebar no-bg right-side mt-30">
              <div class="g-side-box">
                <div class="head">
                  GENEL BİLGİLER
                </div>
                <div class="body">
                  <div class="g-side-row">
                    <b>Kayıt Tarihi</b>
                    <span>
                      <?php if ($readPlayer["creationDate"] == "1000-01-01 00:00:00"): ?>
                        Bilinmiyor
                      <?php else: ?>
                        <?php echo convertTime($readPlayer["creationDate"], 2, true); ?>
                      <?php endif; ?>
                    </span>
                  </div>
                  <div class="g-side-row">
                    <b>Son Giriş</b>
                    <span>
                      <?php if ($readPlayer["lastlogin"] == 0): ?>
                        Giriş Yapılmadı
                      <?php else: ?>
                        <?php echo convertTime(date("Y-m-d H:i:s", ($readPlayer["lastlogin"]/1000)), 2, true); ?>
                      <?php endif; ?>
                    </span>
                  </div>
                  <div class="g-side-row">
                    <b>Coinler</b>
                    <span><?php echo $readPlayer["credit"]; ?></span>
                  </div>
                </div>
              </div>

              <div class="g-side-box">
                <div class="head purple">
                  SOSYAL BİLGİLER
                </div>
                <div class="body">
                <?php
                  $accountSocialMedia = $db->prepare("SELECT * FROM AccountSocialMedia WHERE accountID = ?");
                  $accountSocialMedia->execute(array($readPlayer["id"]));
                  $readAccountSocialMedia = $accountSocialMedia->fetch();
                ?>
                  <div class="g-side-row">
                    <b><img src="images/discord-social.svg" width="25px" alt=""> Discord</b>
                    <span>
                    <?php if ($accountSocialMedia->rowCount() > 0): ?>
                      <?php echo (($readAccountSocialMedia["discord"] != '0') ? $readAccountSocialMedia["discord"] : "-"); ?>
                    <?php else: ?>
                      -
                    <?php endif; ?></span>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      <?php else: ?>
        <?php echo alertError("Veritabanında bu kullanıcıyı bulamadık!"); ?>
      <?php endif; ?>
  <?php else: ?>
    <?php go("/404"); ?>
  <?php endif; ?>
