<?php
  $games = $db->query("SELECT * FROM Games ORDER BY id DESC");
  $siralama = $db->query("SELECT * FROM Games ORDER BY id DESC");

  if (get("action") == "getAll" && $games->rowCount() == 1) {
    go("/oyun/".$games->fetch()["slug"]);
  }
  if (get("action") == "get" && get("game")) {
    $game = $db->prepare("SELECT * FROM Games WHERE slug = ?");
    $game->execute(array(get("game")));
    $readGame = $game->fetch();
  }
?>

<div class="gap"></div>

<div class="games-wrapper">
  <div class="container">
    <div class="section-title">
      <span>Riva Network'de Yapabileceğin Çok Şey Var!</span>
      <b>Oynayabileceğin Tüm Minecraft Oyunlarımız</b>
    </div>
    <div class="games-list-wrap">
      <?php if ($games->rowCount() > 0): ?>
        <?php foreach ($games as $readGames): ?>
          <div class="game-item">
            <div class="image">
              <img class="lazyload" data-src="/apps/main/public/assets/img/games/<?php echo $readGames["imageID"].'.'.$readGames["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/server.png" alt="<?php echo $serverName." Oyun - ".$readGames["title"]; ?>">
            </div>
            <div class="detail">
              <div class="name">
                <img src="images/blue-star.svg" alt="">
                <?php echo $readGames["title"]; ?>
              </div>
              <a href="/oyun/<?php echo $readGames["slug"]; ?>" class="primary-btn normal-shadow">
                DEVAMINI OKU
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-md-12">
          <?php echo alertError("Siteye henüz oyun verisi eklenmemiş!"); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>


  <div class="gap"></div>
  <div class="infos-wrapper" id="bilgilendirme">
    <div class="container">
      <div class="section-title">
        <span>Kısa Bilgilendirme</span>
        <b>İstediğin Minecraft Oyununu Riva Network'de Oyna!</b>
      </div>

      <div class="info-item">
        <div class="text">
          <h3>Riva Network Minecraft</h3>
          <p>Minecraft Riva Network Launcher ile istediğin Minecraft oyununu Riva Network'de ücretsiz olarak
            oynayabilirsin. Riva Network Launcher ile Minecraft indir ve birçok mod desteği sayesinde herhangi mod
            kurulumu ile uğraşmadan istediğin Minecraft oyununu Riva Network'de oynayabilmeni sağlar.
          </p>
        </div>
        <div class="image">
          <img src="images/info-img1.png" alt="">
        </div>
      </div>

      <div class="info-item">
        <div class="image">
          <img src="images/info-img2.png" alt="">
        </div>
        <div class="text">
          <h3>Riva Network Minecraft</h3>
          <p>Minecraft Riva Network Launcher ile istediğin Minecraft oyununu Riva Network'de ücretsiz olarak
            oynayabilirsin. Riva Network Launcher ile Minecraft indir ve birçok mod desteği sayesinde herhangi mod
            kurulumu ile uğraşmadan istediğin Minecraft oyununu Riva Network'de oynayabilmeni sağlar.
          </p>
        </div>
      </div>

    </div>
  </div>
