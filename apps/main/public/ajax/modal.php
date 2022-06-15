<?php
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
  require_once(__ROOT__."/apps/main/private/config/settings.php");
?>
<?php if (get("action") == "buy"): ?>
  <?php
    $products = $db->prepare("SELECT * FROM Products WHERE id = ?");
    $products->execute(array(get("id")));
    $readProducts = $products->fetch();
    $discountProducts = explode(",", $readSettings["storeDiscountProducts"]);
  ?>
  <?php if ($products->rowCount() > 0): ?>
    <?php $discountedPriceStatus = ($readProducts["discountedPrice"] != 0 && ($readProducts["discountExpiryDate"] > date("Y-m-d H:i:s") || $readProducts["discountExpiryDate"] == '1000-01-01 00:00:00')); ?>
    <?php $storeDiscountStatus = ($readSettings["storeDiscount"] != 0 && (in_array($readProducts["id"], $discountProducts) || $readSettings["storeDiscountProducts"] == '0') && ($readSettings["storeDiscountExpiryDate"] > date("Y-m-d H:i:s") || $readSettings["storeDiscountExpiryDate"] == '1000-01-01 00:00:00')); ?>
    <?php
      if ($discountedPriceStatus == true || $storeDiscountStatus == true) {
        $productPrice = (($storeDiscountStatus == true) ? round(($readProducts["price"]*(100-$readSettings["storeDiscount"]))/100) : $readProducts["discountedPrice"]);
      }
      else {
        $productPrice = $readProducts["price"];
      }
    ?>
    <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="buyModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title" id="buyModalLabel">Market <i class="fa fa-angle-double-right"></i> <?php echo $readProducts["name"]; ?></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="title background mt-0"><span>Ürün Bilgisi</span></div>
              </div>
              <div class="col-4">
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
                  <img class="store-card-img" src="/apps/main/public/assets/img/store/products/<?php echo $readProducts["imageID"].'.'.$readProducts["imageType"]; ?>" alt="<?php echo $serverName." Ürün - ".$readProducts["name"]." Satın Al"; ?>">
                </div>
              </div>
              <div class="col-8">
                <div class="row">
                  <span class="col-sm-4 font-weight-bold">Ürün Adı:</span>
                  <span class="col-sm-8"><?php echo $readProducts["name"]; ?></span>
                </div>
                <div class="row">
                  <span class="col-sm-4 font-weight-bold">Kategori:</span>
                  <span class="col-sm-8">
                    <?php if ($readProducts["categoryID"] == 0): ?>
                      -
                    <?php else : ?>
                      <?php
                        $productCategory = $db->prepare("SELECT name FROM ProductCategories WHERE id = ?");
                        $productCategory->execute(array($readProducts["categoryID"]));
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
                <div class="row">
                  <span class="col-sm-4 font-weight-bold">Fiyat:</span>
                  <span class="col-sm-8">
                    <?php echo $productPrice; ?> Rivalet
                  </span>
                </div>
                <div class="row">
                  <span class="col-sm-4 font-weight-bold">Süre:</span>
                  <span class="col-sm-8">
                    <?php if ($readProducts["duration"] == 0): ?>
                      Sınırsız
                    <?php elseif ($readProducts["duration"] == -1): ?>
                      Tek Kullanımlık
                    <?php else : ?>
                      <?php echo $readProducts["duration"]; ?> gün
                    <?php endif; ?>
                  </span>
                </div>
                <?php if ($readProducts["stock"] != -1): ?>
                  <div class="row">
                    <span class="col-sm-4 font-weight-bold">Stok:</span>
                    <span class="col-sm-8">
                      <?php if ($readProducts["stock"] == 0): ?>
                        <span class="text-danger">Yok</span>
                      <?php else : ?>
                        <span class="text-success"><?php echo $readProducts["stock"]; ?> adet</span>
                      <?php endif; ?>
                    </span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div id="couponBox">
              <div class="row">
                <div class="col-md-12">
                  <div class="title background"><span>Ürün Açıklaması</span></div>
                  <div class="product-details">
                    <?php echo $readProducts["details"]; ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="title background"><span>Kupon Kodu</span></div>
                  <div class="input-group">
                    <input type="text" id="inputCoupon" class="form-control" name="coupon" placeholder="Kupon kodunuz varsa buraya yazabilirsiniz.">
                    <input type="hidden" id="inputProduct" name="product" value="<?php echo $readProducts["id"]; ?>">
                    <div class="input-group-append">
                      <button type="button" id="addCouponButton" class="btn btn-success">Kullan</button>
                      <button type="button" id="deleteCouponButton" class="btn btn-danger" style="display: none;">Sil</button>
                    </div>
                  </div>
                  <small id="alertCoupon"></small>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col">
                  <span class="font-weight-bold">Ödenecek Tutar:</span>
                </div>
                <div class="col-auto text-right">
                  <s id="oldPrice" class="text-danger" style="display: none;"></s>
                  <span id="newPrice" class="text-success" value="<?php echo $productPrice; ?>">
                    <?php echo $productPrice; ?> Rivalet
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">İptal</button>
            <?php if (isset($_SESSION["login"])): ?>
              <button type="button" id="buyProductButton" class="btn btn-rounded btn-success">Satın Al</button>
            <?php else: ?>
              <a href="/giris-yap" class="btn btn-rounded btn-success">Giriş Yap</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      var buyModal = $("#buyModal");
      var couponBox = $("#couponBox");
      var alertCoupon = $("#alertCoupon");
      var inputCoupon = $("#inputCoupon");
      var inputProduct = $("#inputProduct");
      var oldPrice = $("#oldPrice");
      var newPrice = $("#newPrice");
      var addCouponButton = $("#addCouponButton");
      var deleteCouponButton = $("#deleteCouponButton");
      var buyProductButton = $("#buyProductButton");

      addCouponButton.on("click", function() {
        $.ajax({
          type: "POST",
          url: "/apps/main/public/ajax/coupon.php",
          data: {couponName: inputCoupon.val(), productID: inputProduct.val()},
          success: function(result) {
            if (result == "error_coupon") {
              inputCoupon.css("border-color", "red");
              alertCoupon.attr("class", "form-text text-danger").text("Kupon bulunamadı veya bu kupon kullanılamaz durumda!").css("display", "block");
            }
            else if (result == "error_product") {
              inputCoupon.css("border-color", "red");
              alertCoupon.attr("class", "form-text text-danger").text("Bu kupon, bu üründe geçerli değildir!").css("display", "block");
            }
            else if (result == "error_use") {
              inputCoupon.css("border-color", "red");
              alertCoupon.attr("class", "form-text text-danger").text("Bu kuponu daha önce kullandınız!").css("display", "block");
            }
            else if (result == "error_piece") {
              inputCoupon.css("border-color", "red");
              alertCoupon.attr("class", "form-text text-danger").text("Bu kuponun kullanım limiti doldu!").css("display", "block");
            }
            else if (result == "error_login") {
              inputCoupon.css("border-color", "red");
              alertCoupon.attr("class", "form-text text-danger").text("Kupon kullanabilmek için giriş yapmalısınız!").css("display", "block");
            }
            else {
              var newPriceValue = Math.round(newPrice.attr("value")*((100-result)/100));
              inputCoupon.prop("readonly", true);
              inputCoupon.css("border-color", "");
              alertCoupon.attr("class", "form-text text-success").text("Kupon başarıyla eklendi!").css("display", "block");
              addCouponButton.css("display", "none");
              deleteCouponButton.attr("class", "btn btn-danger deleteCouponButton").text("Sil").css("display", "block");
              oldPrice.text(newPrice.attr("value") + " Rivalet").css("display", "block");
              newPrice.text(newPriceValue + " Rivalet");
            }
          }
        });
      });

      deleteCouponButton.on("click", function() {
        inputCoupon.prop("readonly", false);
        inputCoupon.css("border-color", "");
        alertCoupon.attr("class", null).text(null).css("display", "none");
        addCouponButton.css("display", "block");
        deleteCouponButton.css("display", "none");
        oldPrice.text(null).css("display", "none");
        newPrice.text(newPrice.attr("value") + " Rivalet");
      });

      buyProductButton.on("click", function() {
        $.ajax({
          type: "POST",
          url: "/apps/main/public/ajax/buy.php",
          data: {productID: inputProduct.val(), couponName: inputCoupon.val()},
          success: function(result) {
            if (result == "error") {
              swal.fire({
                title: "HATA!",
                text: "Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.",
                type: "error",
                confirmButtonColor: "#02b875",
                confirmButtonText: "Tamam"
              }).then(function() {
                buyModal.modal("hide");
              });
            }
            if (result == "error_login") {
              swal.fire({
                title: "HATA!",
                text: "Satın alım işlemi için giriş yapmalısınız.",
                type: "error",
                confirmButtonColor: "#02b875",
                confirmButtonText: "Tamam"
              }).then(function() {
                buyModal.modal("hide");
              });
            }
            else if (result == "unsuccessful") {
              swal.fire({
                title: "HATA!",
                text: "Yetersiz bakiye!",
                type: "error",
                confirmButtonColor: "#02b875",
                confirmButtonText: "Tamam"
              }).then(function() {
                window.location = '/kredi/yukle';
              });
            }
            else if (result == "stock_error") {
              swal.fire({
                title: "HATA!",
                text: "Bu ürünümüz stoklarda kalmamıştır!",
                type: "error",
                confirmButtonColor: "#02b875",
                confirmButtonText: "Tamam"
              }).then(function() {
                buyModal.modal("hide");
              });
            }
            else {
              swal.fire({
                title: "BAŞARILI!",
                text: "Ürün başarıyla satın alındı ve sandığa eklendi!",
                type: "success",
                confirmButtonColor: "#02b875",
                confirmButtonText: "Tamam"
              }).then(function() {
                window.location = '/sandik';
              });
            }
          }
        });
      });
    </script>
  <?php else : ?>
    <?php die(false); ?>
  <?php endif; ?>
<?php else : ?>
  <?php die(false); ?>
<?php endif; ?>
