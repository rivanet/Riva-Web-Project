<?php
  use Phelium\Component\reCAPTCHA;
  require_once(__ROOT__.'/apps/main/private/packages/class/extraresources/extraresources.php');
  $extraResourcesJS = new ExtraResources('js');
  $extraResourcesJS->addResource('/apps/main/public/assets/js/loader.js');
  $recaptchaPagesStatusJSON = $readSettings["recaptchaPagesStatus"];
  $recaptchaPagesStatus = json_decode($recaptchaPagesStatusJSON, true);
  $recaptchaStatus = $readSettings["recaptchaPublicKey"] != '0' && $readSettings["recaptchaPrivateKey"] != '0' && $recaptchaPagesStatus["newsPage"] == 1;
  if ($recaptchaStatus) {
    require_once(__ROOT__.'/apps/main/private/packages/class/recaptcha/recaptcha.php');
    $reCAPTCHA = new reCAPTCHA($readSettings["recaptchaPublicKey"], $readSettings["recaptchaPrivateKey"]);
    $reCAPTCHA->setRemoteIp(getIP());
    $reCAPTCHA->setLanguage("tr");
    $reCAPTCHA->setTheme(($readTheme["recaptchaThemeID"] == 1) ? "light" : (($readTheme["recaptchaThemeID"] == 2) ? "dark" : "light"));
    $extraResourcesJS->addResource($reCAPTCHA->getScriptURL(), true, true);
  }
  $news = $db->prepare("SELECT N.*, A.realname, A.permission, NC.name as categoryName, NC.slug as categorySlug FROM News N INNER JOIN Accounts A ON N.accountID = A.id INNER JOIN NewsCategories NC ON N.categoryID = NC.id WHERE N.id = ?");
  $news->execute(array(get("id")));
  $readNews = $news->fetch();
?>


  <div class="content">
    <?php if ($news->rowCount() > 0): ?>
      <?php if (!isset($_COOKIE["newsID"])): ?>
        <?php
          $updateNews = $db->prepare("UPDATE News SET views = views + 1 WHERE id = ?");
          $updateNews->execute(array($readNews["id"]));
          setcookie("newsID", $readNews["id"]);
        ?>
      <?php endif; ?>
      <?php
        $newsComments = $db->prepare("SELECT NC.*, A.realname, A.permission FROM NewsComments NC INNER JOIN Accounts A ON NC.accountID = A.id WHERE NC.newsID = ? AND NC.status = ? ORDER BY NC.id DESC");
        $newsComments->execute(array($readNews["id"], 1));
      ?>
      <div class="blog-detail-wrap">
        <div class="image">
          <div class="category-badge green">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-plus-square-fill" viewBox="0 0 16 16">
              <path
                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
            </svg>&nbsp;<?php echo $readNews["categoryName"]; ?>
          </div>
          <img class="lazyload" data-src="/apps/main/public/assets/img/news/<?php echo $readNews["imageID"].'.'.$readNews["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/news.png" alt="<?php echo $serverName." Haber - ".$readNews["title"]; ?>" alt="">
        </div>
        <div class="blog-detail-content">
          <h1><?php echo $readNews["title"]; ?></h1>
          <span class="color-green"><?php echo convertTime($readNews["creationDate"], 2, true); ?> Tarihinde <b><?php echo $readNews["categoryName"]; ?></b> kategorisinde yayınlandı.</span>
          <p><?php echo showEmoji(hashtag(hashtag($readNews["content"], "@", "/oyuncu"), "#", "/etiket")); ?></p>
          <img src="images/landing-banner.png" alt="">
        </div>

      </div>
    <?php else: ?>
      <div class="alert alert-danger">Haber Verileri Alınamadı</div>
    <?php endif; ?>
  </div>