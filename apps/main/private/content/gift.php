<?php
  if (!isset($_SESSION["login"])) {
    go("/giris-yap");
  }
  if (get("action") == 'use' && get("id")) {
    $productGift = $db->prepare("SELECT * FROM ProductGifts WHERE name = ?");
    $productGift->execute(array(get("id")));
    $readProductGift = $productGift->fetch();
  }
?>
<style>
    iframe {
        padding: 0 0 0 0;
        height: 100px;
        width: 380px;
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
            <?php if (get("target") == 'gift'): ?>
              <?php if (get("action") == 'coupon'): ?>
              <?php elseif (get("action") == 'use'): ?>
                <li class="breadcrumb-item"><a href="/hediye">Hediye</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo (($productGift->rowCount() > 0) ? $readProductGift["name"] : 'Bulunamadı'); ?></li>
              <?php else: ?>
                <?php go("/404"); ?>
              <?php endif; ?>
            <?php else: ?>
              <?php go("/404"); ?>
            <?php endif; ?>
          </ol>
        </nav>
      </div>
  <div class="register-wrapper">
    <div class="logo">
      <img src="images/footer-logo.svg" alt="Riva Network">
      <b>RIVA NETWORK</b>
    </div>
        <?php if (get("target") == 'gift'): ?>
          <?php if (get("action") == 'coupon'): ?>
            <?php
              require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
              $csrf = new CSRF('csrf-sessions', 'csrf-token');
              if (isset($_POST["useGiftCoupon"])) {
                $productGift = $db->prepare("SELECT * FROM ProductGifts WHERE name = ?");
                $productGift->execute(array(post("giftName")));
                $readProductGift = $productGift->fetch();
                $productGiftsHistory = $db->prepare("SELECT * FROM ProductGiftsHistory WHERE giftID = ?");
                $productGiftsHistory->execute(array($readProductGift["id"]));
                $myProductGiftsHistory = $db->prepare("SELECT * FROM ProductGiftsHistory WHERE accountID = ? AND giftID = ?");
                $myProductGiftsHistory->execute(array($readAccount["id"], $readProductGift["id"]));
                if (!$csrf->validate('useGiftCoupon')) {
                  echo alertError("Sistemsel bir sorun oluştu!");
                }
                else if (post("giftName") == null ) {
                  echo alertError("Lütfen boş alan bırakmayınız!");
                }
                else if ($productGift->rowCount() == 0) {
                  echo alertError("Hediye kuponu bulunamadı!");
                }
                else if ($myProductGiftsHistory->rowCount() > 0) {
                  echo alertError("Bu hediye kuponunu daha önce kullandınız!");
                }
                else if ($readProductGift["expiryDate"] < date("Y-m-d H:i:s") && $readProductGift["expiryDate"] != '1000-01-01 00:00:00') {
                  echo alertError("Bu hediye kuponunun kullanım süresi geçmiştir!");
                }
                else if ($readProductGift["piece"] <= $productGiftsHistory->rowCount() && $readProductGift["piece"] != 0) {
                  echo alertError("Bu hediye kuponunun kullanım limiti dolmuştur!");
                }
                else {
                  go('/hediye/'.$readProductGift["name"]);
                }
              }
            ?>
              <div class="info-text">
			 <b>Hediye Kodu Bozdur</b>
      <p>Hediye kodları genellikle "RV-" ile başlar.
        Kodun içindeki 0 (sıfır) ve O (o harfi)
        kullanımlarının karışmadığını kontrol
        etmeyi unutma.</p>
                <form action="" method="post">
                  <div class="form-group row">
                    <div class="input-wrap no-icon">
                      <input type="text" id="inputGiftName" class="form-control" name="giftName" placeholder="RV-XXXX-XXXX-XXXX">
                    </div>
                  </div>
                  <?php echo $csrf->input('useGiftCoupon'); ?>
   				 <div class="register-button">
                     <button type="submit" class="primary-btn normal-shadow" style="width: 100%;" name="useGiftCoupon">KULLAN</button>
   					 <div class="go-to-market">
      <a href="/magaza"><svg xmlns="http://www.w3.org/2000/svg" width="16.895" height="15.791" viewBox="0 0 16.895 15.791">
          <g id="Group_44" data-name="Group 44" transform="translate(1 1.414)">
            <g id="Icon_feather-arrow-right" data-name="Icon feather-arrow-right" transform="translate(8)">
              <path id="Path_31" data-name="Path 31" d="M24.481,7.5,18,13.981l6.481,6.481"
                transform="translate(-18 -7.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" />
            </g>
            <g id="Icon_feather-arrow-right-2" data-name="Icon feather-arrow-right">
              <path id="Path_31-2" data-name="Path 31" d="M24.481,7.5,18,13.981l6.481,6.481"
                transform="translate(-18 -7.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" />
            </g>
          </g>
        </svg>
        &nbsp;MARKETE DÖN</a>
    </div>
  </div>
</form>
 </div>
</div>
          <?php elseif (get("action") == 'use' && get("id")): ?>
            <?php
              require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
              $csrf = new CSRF('csrf-sessions', 'csrf-token');
              if (isset($_POST["getGift"])) {
                $productGiftsHistory = $db->prepare("SELECT * FROM ProductGiftsHistory WHERE giftID = ?");
                $productGiftsHistory->execute(array($readProductGift["id"]));
                $myProductGiftsHistory = $db->prepare("SELECT * FROM ProductGiftsHistory WHERE accountID = ? AND giftID = ?");
                $myProductGiftsHistory->execute(array($readAccount["id"], $readProductGift["id"]));
                if (!$csrf->validate('getGift')) {
                  echo alertError("Sistemsel bir sorun oluştu!");
                }
                else if (get("id") == null ) {
                  echo alertError("Lütfen boş alan bırakmayınız!");
                }
                else if ($productGift->rowCount() == 0) {
                  echo alertError("Hediye kuponu bulunamadı!");
                }
                else if ($myProductGiftsHistory->rowCount() > 0) {
                  echo alertError("Bu hediye kuponunu daha önce kullandınız!");
                }
                else if ($readProductGift["expiryDate"] < date("Y-m-d H:i:s") && $readProductGift["expiryDate"] != '1000-01-01 00:00:00') {
                  echo alertError("Bu hediye kuponunun kullanım süresi geçmiştir!");
                }
                else if ($readProductGift["piece"] <= $productGiftsHistory->rowCount() && $readProductGift["piece"] != 0) {
                  echo alertError("Bu hediye kuponunun kullanım limiti dolmuştur!");
                }
                else {
                  if ($readProductGift["giftType"] == 1) {
                    $insertChests = $db->prepare("INSERT INTO Chests (accountID, productID, status, creationDate) VALUES (?, ?, ?, ?)");
                    $insertChests->execute(array($readAccount["id"], $readProductGift["gift"], 0, date("Y-m-d H:i:s")));
                  }
                  else {
                    $updateAccount =$db->prepare("UPDATE Accounts SET credit = ? WHERE id = ?");
                    $updateAccount->execute(array($readAccount["credit"]+$readProductGift["gift"], $readAccount["id"]));
                    $insertCreditHistory = $db->prepare("INSERT INTO CreditHistory (accountID, paymentID, paymentStatus, type, price, earnings, creationDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $insertCreditHistory->execute(array($readAccount["id"], 0, 1, 4, $readProductGift["gift"], 0, date("Y-m-d H:i:s")));
                  }

                  $insertProductGiftsHistory = $db->prepare("INSERT INTO ProductGiftsHistory (accountID, giftID, creationDate) VALUES (?, ?, ?)");
                  $insertProductGiftsHistory->execute(array($readAccount["id"], $readProductGift["id"], date("Y-m-d H:i:s")));
                  echo alertSuccess("Hediye başarıyla sandığınıza eklenmiştir!");
                }
              }
            ?>
            <?php if ($productGift->rowCount() > 0): ?>
              <div class="card">
                <div class="card-header">
                  Hediye Kuponu Bozdur
                </div>
                <div class="card-body">
                  <div class="row">
                    <?php if ($readProductGift["giftType"] == 1): ?>
                      <?php
                        $product = $db->prepare("SELECT P.*, S.ip as serverIP, S.name as serverName FROM Products P INNER JOIN Servers S ON P.serverID = S.id WHERE P.id = ?");
                        $product->execute(array($readProductGift["gift"]));
                        $readProduct = $product->fetch();
                      ?>
                      <div class="col-md-12">
                        <div class="title background mt-0"><span>Ürün Bilgisi</span></div>
                      </div>
                      <div class="col-4">
                        <div class="store-card">
                          <img class="store-card-img" src="/apps/main/public/assets/img/store/products/<?php echo $readProduct["imageID"].'.'.$readProduct["imageType"]; ?>" alt="<?php echo $serverName." Ürün - ".$readProduct["name"]." Satın Al"; ?>">
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="row mb-1">
                          <span class="col-sm-4 font-weight-bold">Ürün Adı:</span>
                          <span class="col-sm-8"><?php echo $readProduct["name"]; ?></span>
                        </div>
                        <div class="row mb-1">
                          <span class="col-sm-4 font-weight-bold">Kategori:</span>
                          <span class="col-sm-8">
                            <?php if ($readProduct["categoryID"] == 0): ?>
                              -
                            <?php else : ?>
                              <?php
                                $productCategory = $db->prepare("SELECT name FROM ProductCategories WHERE id = ?");
                                $productCategory->execute(array($readProduct["categoryID"]));
                                $readProductCategory = $productCategory->fetch();
                              ?>
                              <?php if ($productCategory->rowCount() > 0): ?>
                                <?php echo $readProductCategory["name"]; ?>
                              <?php else : ?>
                                -
                              <?php endif; ?>
                            <?php endif; ?>
                          </span>
                        </div>
                        <div class="row mb-1">
                          <span class="col-sm-4 font-weight-bold">Fiyat:</span>
                          <span class="col-sm-8 text-success">
                            Ücretsiz
                          </span>
                        </div>
                        <div class="row mb-1">
                          <span class="col-sm-4 font-weight-bold">Süre:</span>
                          <span class="col-sm-8">
                            <?php if ($readProduct["duration"] == 0): ?>
                              Sınırsız
                            <?php elseif ($readProduct["duration"] == -1): ?>
                              Tek Kullanımlık
                            <?php else : ?>
                              <?php echo $readProduct["duration"]; ?> gün
                            <?php endif; ?>
                          </span>
                        </div>
                        <div class="mt-4">
                          <form action="" method="post">
                            <?php echo $csrf->input('getGift'); ?>
                            <button type="submit" class="btn btn-success w-100" name="getGift">Kabul Et ve Ürünü Al</button>
                          </form>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="col-md-12">
                        <form action="" method="post">
                          <div class="form-group">
                            <p>"Hediyeyi Al" butonuna bastığınızda hesabınıza <strong><?php echo $readProductGift["gift"]; ?> Rivalet</strong> hediye edilecektir.</p>
                          </div>
                          <?php echo $csrf->input('getGift'); ?>
                          <div class="clearfix">
                            <div class="float-right">
                              <button type="submit" class="btn btn-success btn-rounded w-100" name="getGift">Hediyeyi Al</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <?php echo alertError("Hediye kuponu bulunamadı!"); ?>
            <?php endif; ?>
          <?php else: ?>
            <?php go("/404"); ?>
          <?php endif; ?>
        <?php else: ?>
          <?php go('/404'); ?>
        <?php endif; ?>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <?php
              $productGiftsHistory = $db->prepare("SELECT PGH.*, PG.name as giftName FROM ProductGiftsHistory PGH INNER JOIN ProductGifts PG ON PGH.giftID = PG.id WHERE PGH.accountID = ? ORDER by PGH.id DESC LIMIT 5");
              $productGiftsHistory->execute(array($readAccount["id"]));
            ?>
            <?php if ($productGiftsHistory->rowCount() > 0): ?>
              <div class="card mb-3">
                <div class="card-header">
                  <div class="row">
                    <div class="col">
                      <span>Hediye Geçmişi</span>
                    </div>
                    <div class="col-auto">
                      <a class="text-white" href="/profil">Tümü</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Kullanıcı Adı</th>
                          <th class="text-center">Kod</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($productGiftsHistory as $productGiftsHistory): ?>
                          <tr>
                            <td class="text-center">
                              <img class="rounded-circle" src="https://minotar.net/avatar/<?php echo $readAccount["realname"]; ?>/20.png" alt="<?php echo $serverName." Oyuncu - ".$readAccount["realname"]; ?>">
                            </td>
                            <td>
                              <?php echo $readAccount["realname"]; ?>
                              <?php echo verifiedCircle($readAccount["permission"]); ?>
                            </td>
                            <td class="text-center"><?php echo $productGiftsHistory["giftName"]; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php else : ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
