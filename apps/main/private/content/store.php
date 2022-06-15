<?php
  $servers = $db->query("SELECT * FROM Servers");

  if (get("action") == "get") {
    if (get("server")) {
      $thisServer = $db->prepare("SELECT * FROM Servers WHERE slug = ?");
      $thisServer->execute(array(get("server")));
      $readThisServer = $thisServer->fetch();
      if ($thisServer->rowCount() > 0) {
        $categoryID = "0";
        if (get("category")) {
          $thisCategory = $db->prepare("SELECT * FROM ProductCategories WHERE serverID = ? AND slug = ?");
          $thisCategory->execute(array($readThisServer["id"], get("category")));
          $readThisCategory = $thisCategory->fetch();
          if ($thisCategory->rowCount() > 0) {
            $categoryID = $readThisCategory["id"];
          }
        }
        else {
          $_GET["category"] = "0";
          $categoryID = get("category");
        }
        $productCategories = $db->prepare("SELECT * FROM ProductCategories WHERE serverID = ? AND parentID = ?");
        $productCategories->execute(array($readThisServer["id"], $categoryID));
      }
    }

    $discountProducts = explode(",", $readSettings["storeDiscountProducts"]);
    require_once(__ROOT__.'/apps/main/private/packages/class/extraresources/extraresources.php');
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('/apps/main/public/assets/js/store.js');
  }
?>
<section class="section store-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          </ol>
        </nav>
      </div>
    </div>
    <?php if (get("action") == "getAll"): ?>
      <div class="row">
        <?php if ($servers->rowCount() > 0): ?>
          <div class="market-cetegories">
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="25.975" height="25.704" viewBox="0 0 25.975 25.704">
                <g id="Iconly_Light_Add-User" data-name="Iconly/Light/Add-User" transform="translate(0.75 0.75)">
                  <g id="Add-User">
                    <path id="Stroke-1"
                      d="M10.178,13.206c-5.086,0-9.429.769-9.429,3.849s4.317,3.876,9.429,3.876c5.087,0,9.429-.77,9.429-3.849S15.292,13.206,10.178,13.206Z"
                      transform="translate(-0.75 3.273)" fill="none" stroke="#fff" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                    <path id="Stroke-3" d="M9.352,12.837a6.022,6.022,0,1,0-.041,0Z" transform="translate(0.077 -0.75)"
                      fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      fill-rule="evenodd" />
                    <line id="Stroke-5" y2="5.305" transform="translate(21.768 7.831)" fill="none" stroke="#fff"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    <line id="Stroke-7" x1="5.411" transform="translate(19.064 10.483)" fill="none" stroke="#fff"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                  </g>
                </g>
              </svg>
              VIP
            </a>
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="31.5" height="19.5" viewBox="0 0 31.5 19.5">
                <path id="bxs-mask"
                  d="M28.5,9H7.5A4.505,4.505,0,0,0,3,13.5V21a6.006,6.006,0,0,0,6,6h2.455a5.616,5.616,0,0,0,4.471-2.237,2.665,2.665,0,0,1,4.146,0A5.616,5.616,0,0,0,24.544,27H27a6.006,6.006,0,0,0,6-6V13.5A4.505,4.505,0,0,0,28.5,9ZM11.25,19.5c-2.072,0-3.75-1.008-3.75-2.25S9.178,15,11.25,15,15,16.008,15,17.25,13.322,19.5,11.25,19.5Zm13.5,0c-2.071,0-3.75-1.008-3.75-2.25S22.679,15,24.75,15s3.75,1.008,3.75,2.25S26.821,19.5,24.75,19.5Z"
                  transform="translate(-2.25 -8.25)" fill="none" stroke="#fff" stroke-width="1.5" />
              </svg>
              Kozmetik
            </a>
            <a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20.857" height="22.47" viewBox="0 0 20.857 22.47">
                <g id="gift-outline" transform="translate(-3.75 -2.625)">
                  <path id="Path_46" data-name="Path 46" d="M18,6.2V9.021h2.823A2.823,2.823,0,1,0,18,6.2Z"
                    transform="translate(-3.822 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-miterlimit="10"
                    stroke-width="1.5" />
                  <path id="Path_47" data-name="Path 47" d="M15.77,6.2V9.021H12.947A2.823,2.823,0,1,1,15.77,6.2Z"
                    transform="translate(-1.592)" fill="none" stroke="#fff" stroke-linecap="round" stroke-miterlimit="10"
                    stroke-width="1.5" />
                  <path id="Path_48" data-name="Path 48"
                    d="M6.113,11.25H22.244a1.613,1.613,0,0,1,1.613,1.613v2.42A1.613,1.613,0,0,1,22.244,16.9H6.113A1.613,1.613,0,0,1,4.5,15.283v-2.42A1.613,1.613,0,0,1,6.113,11.25Z"
                    transform="translate(0 -2.229)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" />
                  <path id="Path_49" data-name="Path 49"
                    d="M22.881,19.125v7.259a2.42,2.42,0,0,1-2.42,2.42H9.17a2.42,2.42,0,0,1-2.42-2.42V19.125"
                    transform="translate(-0.637 -4.459)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.5" />
                  <path id="Path_50" data-name="Path 50" d="M18,11.25V26.574" transform="translate(-3.822 -2.229)" fill="none"
                    stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                </g>
              </svg>
              Hediye Kartı Bozdur
            </a>
          </div>
 <?php else: ?>
          <div class="col-md-12">
            <?php echo alertError("Siteye henüz sunucu verisi eklenmemiş!"); ?>
          </div>
        <?php endif; ?>
        <div class="market-content">
          <div class="content-head">
            <span>Bakiyenizin Durumu</span>
            <span>
              <img src="/images/yakut.png" alt="">
              <?php echo $readAccount["credit"]; ?> / Rivalet
            </span>
            <span>
              <img src="/images/altin.png" alt="">
              <?php echo $readplayers["balance"]; ?> / Coin
            </span>
            <div class="actions">
              <a href="#" class="primary-btn normal-shadow">Rivalet Yükle</a>
            </div>
          </div>
      </div>
		  
    <?php elseif (get("action") == "get" && get("server")): ?>
      <div class="row">
        <div id="modalBox"></div>
        <div class="col-md-3">
          <?php if ($servers->rowCount() > 0): ?>
            <div class="card">
              <div class="card-header">
                Sunucular
              </div>
              <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                  <?php foreach ($servers as $readServers): ?>
                    <li class="list-group-item <?php echo ($readServers["slug"] == get("server")) ? "active":null; ?>">
                      <a href="/magaza/<?php echo $readServers["slug"]; ?>">
                        <?php echo $readServers["name"]; ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          <?php else: ?>
            <?php echo alertError("Sunucu bulunamadı!"); ?>
          <?php endif; ?>
        </div>
        <div class="col-md-9">
          <?php if (get("server") && $thisServer->rowCount() > 0): ?>
            <?php if ($readSettings["topSalesStatus"] == 1): ?>
              <?php
                $topSales = $db->prepare("SELECT P.*, COUNT(*) AS productCount FROM StoreHistory SH INNER JOIN Products P ON SH.productID = P.id WHERE P.serverID = ? AND P.categoryID = ? GROUP BY P.id ORDER BY productCount DESC LIMIT 4");
                $topSales->execute(array($readThisServer["id"], $categoryID));
              ?>
              <?php if ($topSales->rowCount() > 0): ?>
                <div class="card">
                  <div class="card-header">
                    En Çok Satılan Ürünler
                  </div>
                  <div class="card-body">
                    <div class="row store-cards">
                      <?php foreach ($topSales as $readTopSales): ?>
                        <?php $discountedPriceStatus = ($readTopSales["discountedPrice"] != 0 && ($readTopSales["discountExpiryDate"] > date("Y-m-d H:i:s") || $readTopSales["discountExpiryDate"] == '1000-01-01 00:00:00')); ?>
                        <?php $storeDiscountStatus = ($readSettings["storeDiscount"] != 0 && (in_array($readTopSales["id"], $discountProducts) || $readSettings["storeDiscountProducts"] == '0') && ($readSettings["storeDiscountExpiryDate"] > date("Y-m-d H:i:s") || $readSettings["storeDiscountExpiryDate"] == '1000-01-01 00:00:00')); ?>
                        <div class="col-md-3">
                          <div class="store-card">
                            <?php if ($readTopSales["stock"] != -1): ?>
                              <div class="store-card-stock <?php echo ($readTopSales["stock"] == 0) ? "stock-out" : "have-stock"; ?>">
                                <?php if ($readTopSales["stock"] == 0): ?>
                                  Stokta Yok!
                                <?php else : ?>
                                  Sınırlı Stok!
                                <?php endif; ?>
                              </div>
                            <?php endif; ?>
                            <?php if ($discountedPriceStatus == true || $storeDiscountStatus == true): ?>
                              <?php $discountPercent = (($storeDiscountStatus == true) ? $readSettings["storeDiscount"] : round((($readTopSales["price"]-$readTopSales["discountedPrice"])*100)/($readTopSales["price"]))); ?>
                              <div class="store-card-discount">
                                <span>%<?php echo $discountPercent; ?></span>
                              </div>
                            <?php endif; ?>
                            <img class="store-card-img lazyload" data-src="/apps/main/public/assets/img/store/products/<?php echo $readTopSales["imageID"].'.'.$readTopSales["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/store.png" alt="<?php echo $serverName." Ürün - ".$readTopSales["name"]." Satın Al"; ?>">
                            <div class="row store-card-text">
                              <div class="col">
                                <span><?php echo $readTopSales["name"]; ?></span>
                              </div>
                              <div class="col-auto">
                                <?php if ($discountedPriceStatus == true || $storeDiscountStatus == true): ?>
                                  <span class="old-price"><?php echo $readTopSales["price"]; ?><i class="fa fa-try"></i></span>
                                  <small>/</small>
                                  <?php $newPrice = (($storeDiscountStatus == true) ? round(($readTopSales["price"]*(100-$readSettings["storeDiscount"]))/100) : $readTopSales["discountedPrice"]); ?>
                                  <span class="price"><?php echo $newPrice; ?><i class="fa fa-try"></i></span>
                                <?php else: ?>
                                  <span class="price"><?php echo $readTopSales["price"]; ?><i class="fa fa-try"></i></span>
                                <?php endif; ?>
                              </div>
                            </div>
                            <div class="store-card-button">
                              <?php if ($readTopSales["stock"] != -1): ?>
                                <div class="mb-2">
                                  <?php if ($readTopSales["stock"] == 0): ?>
                                    <span class="text-danger small">Stokta ürün kalmadı!</span>
                                  <?php else : ?>
                                    <span class="text-success small">Stokta <?php echo $readTopSales["stock"]; ?> adet ürün kaldı!</span>
                                  <?php endif; ?>
                                </div>
                              <?php endif; ?>
                              <?php if ($readTopSales["stock"] == 0): ?>
                                <button class="btn btn-danger w-100 stretched-link disabled">Stokta Yok!</button>
                              <?php else: ?>
                                <button class="btn btn-success w-100 stretched-link openBuyModal" product-id="<?php echo $readTopSales["id"]; ?>">Satın Al</button>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>

            <?php if ($productCategories->rowCount() > 0): ?>
              <div class="card">
                <div class="card-header">
                  Kategoriler
                </div>
                <div class="card-body">
                  <div class="row store-cards">
                    <?php foreach ($productCategories as $readProductCategories): ?>
                      <div class="col-md-3">
                        <div class="store-card">
                          <img class="store-card-img lazyload" data-src="/apps/main/public/assets/img/store/categories/<?php echo $readProductCategories["imageID"].'.'.$readProductCategories["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/store.png" alt="<?php echo $serverName." Kategori - ".$readProductCategories["name"]." Ürünlerini Görüntüle"; ?>">
                          <div class="store-card-text d-flex justify-content-center">
                            <span><?php echo $readProductCategories["name"]; ?></span>
                          </div>
                          <a class="btn btn-primary w-100 stretched-link store-card-button" href="/magaza/<?php echo $readThisServer["slug"]; ?>/<?php echo $readProductCategories["slug"]; ?>">Ürünleri Görüntüle</a>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php
              $products = $db->prepare("SELECT * FROM Products WHERE serverID = ? AND categoryID = ?");
              $products->execute(array($readThisServer["id"], $categoryID));
            ?>
            <?php if ($products->rowCount() > 0): ?>
              <div class="card">
                <div class="card-header">
                  Ürünler
                </div>
                <div class="card-body">
                  <div class="row store-cards">
                    <?php foreach ($products as $readProducts): ?>
                      <?php $discountedPriceStatus = ($readProducts["discountedPrice"] != 0 && ($readProducts["discountExpiryDate"] > date("Y-m-d H:i:s") || $readProducts["discountExpiryDate"] == '1000-01-01 00:00:00')); ?>
                      <?php $storeDiscountStatus = ($readSettings["storeDiscount"] != 0 && (in_array($readProducts["id"], $discountProducts) || $readSettings["storeDiscountProducts"] == '0') && ($readSettings["storeDiscountExpiryDate"] > date("Y-m-d H:i:s") || $readSettings["storeDiscountExpiryDate"] == '1000-01-01 00:00:00')); ?>
                      <div class="col-md-3">
                        <div class="store-card">
                          <?php if ($readProducts["stock"] != -1): ?>
                            <div class="store-card-stock <?php echo ($readProducts["stock"] == 0) ? "stock-out" : "have-stock"; ?>">
                              <?php if ($readProducts["stock"] == 0): ?>
                                Stokta Yok!
                              <?php else : ?>
                                Sınırlı Stok!
                              <?php endif; ?>
                            </div>
                          <?php endif; ?>
                          <?php if ($discountedPriceStatus == true || $storeDiscountStatus == true): ?>
                            <?php $discountPercent = (($storeDiscountStatus == true) ? $readSettings["storeDiscount"] : round((($readProducts["price"]-$readProducts["discountedPrice"])*100)/($readProducts["price"]))); ?>
                            <div class="store-card-discount">
                              <span>%<?php echo $discountPercent; ?></span>
                            </div>
                          <?php endif; ?>
                          <img class="store-card-img lazyload" data-src="/apps/main/public/assets/img/store/products/<?php echo $readProducts["imageID"].'.'.$readProducts["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/store.png" alt="<?php echo $serverName." Ürün - ".$readProducts["name"]." Satın Al"; ?>">
                          <div class="row store-card-text">
                            <div class="col">
                              <span><?php echo $readProducts["name"]; ?></span>
                            </div>
                            <div class="col-auto">
                              <?php if ($discountedPriceStatus == true || $storeDiscountStatus == true): ?>
                                <span class="old-price"><?php echo $readProducts["price"]; ?><i class="fa fa-try"></i></span>
                                <small>/</small>
                                <?php $newPrice = (($storeDiscountStatus == true) ? round(($readProducts["price"]*(100-$readSettings["storeDiscount"]))/100) : $readProducts["discountedPrice"]); ?>
                                <span class="price"><?php echo $newPrice; ?><i class="fa fa-try"></i></span>
                              <?php else: ?>
                                <span class="price"><?php echo $readProducts["price"]; ?><i class="fa fa-try"></i></span>
                              <?php endif; ?>
                            </div>
                          </div>
                          <div class="store-card-button">
                            <?php if ($readProducts["stock"] != -1): ?>
                              <div class="mb-2">
                                <?php if ($readProducts["stock"] == 0): ?>
                                  <span class="text-danger small">Stokta ürün kalmadı!</span>
                                <?php else : ?>
                                  <span class="text-success small">Stokta <?php echo $readProducts["stock"]; ?> adet ürün kaldı!</span>
                                <?php endif; ?>
                              </div>
                            <?php endif; ?>
                            <?php if ($readProducts["stock"] == 0): ?>
                              <button class="btn btn-danger w-100 stretched-link disabled">Stokta Yok!</button>
                            <?php else: ?>
                              <button class="btn btn-success w-100 stretched-link openBuyModal" product-id="<?php echo $readProducts["id"]; ?>">Satın Al</button>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <?php if ($productCategories->rowCount() == 0): ?>
                <?php echo alertError("Bu sayfaya ait ürün bulunamadı!"); ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php else: ?>
            <?php echo alertError("Bu sayfaya ait veri bulunamadı!"); ?>
          <?php endif; ?>
        </div>
      </div>
    <?php else: ?>
      <?php go("/404"); ?>
    <?php endif; ?>
  </div>
</section>
