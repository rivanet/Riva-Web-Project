<?php
  require_once(__ROOT__.'/apps/dashboard/private/packages/class/extraresources/extraresources.php');
  $extraResourcesJS = new ExtraResources('js');
  $extraResourcesJS->addResource('/apps/dashboard/public/assets/js/home.js');
  $extraResourcesJS->addResource('/apps/dashboard/public/assets/js/home.stats.js');
?>
<?php if ($readAdmin["permission"] == 1): ?>
  <div class="header">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-end">
          <div class="col">
            <h6 class="header-pretitle text-secondary">
              Genel Bakış
            </h6>
            <h1 class="header-title">
              İstatistikler (<?php echo date("Y"); ?>)
            </h1>
          </div>
          <div class="col-auto">
            <ul class="nav nav-tabs header-tabs">
              <li id="earnChartData" class="nav-item disabledlink" data-toggle="chart" data-target="#dashboardChart" data-update='{"data":{"datasets":[{"data":[0,0,0,0,0,0,0,0,0,0,0,0]}]}}'>
                <a href="#" class="nav-link text-center active" data-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    KAZANÇ
                  </h6>
                  <div id="earnChartValue">
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="sr-only">Yükleniliyor...</span>
                    </div>
                    <h3 class="mb-0" style="display: none;">
                      0
                      <small>
                        <i class="fa fa-try"></i>
                      </small>
                    </h3>
                  </div>
                </a>
              </li>
              <li id="userChartData" class="nav-item disabledlink" data-toggle="chart" data-target="#dashboardChart" data-update='{"data":{"datasets":[{"data":[0,0,0,0,0,0,0,0,0,0,0,0]}]}}'>
                <a href="#" class="nav-link text-center" data-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    KAYIT
                  </h6>
                  <div id="userChartValue">
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="sr-only">Yükleniliyor...</span>
                    </div>
                    <h3 class="mb-0" style="display: none;">0</h3>
                  </div>
                </a>
              </li>
              <li id="storeChartData" class="nav-item disabledlink" data-toggle="chart" data-target="#dashboardChart" data-update='{"data":{"datasets":[{"data":[0,0,0,0,0,0,0,0,0,0,0,0]}]}}'>
                <a href="#" class="nav-link text-center" data-toggle="tab">
                  <h6 class="header-pretitle text-secondary">
                    Market
                  </h6>
                  <div id="storeChartValue">
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="sr-only">Yükleniliyor...</span>
                    </div>
                    <h3 class="mb-0" style="display: none;">0</h3>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="header-footer">
        <div class="chart">
          <canvas id="dashboardChart" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>
<div class="container-fluid pt-5">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="card-title text-uppercase text-muted mb-2">
                Kayıtlı Kullanıcı
              </h6>
              <div id="userCardData">
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="sr-only">Yükleniliyor...</span>
                </div>
                <span class="h2 mb-0" style="display: none;">-</span>
                <span class="badge badge-soft-secondary mt--1" style="display: none;">0%</span>
              </div>
            </div>
            <div class="col-auto">
              <span class="h2 fe fe-users text-muted mb-0"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <?php if ($readAdmin["permission"] == 1): ?>
              <div class="col">
                <h6 class="card-title text-uppercase text-muted mb-2">
                  Bu Ayki Kazanç
                </h6>
                <div id="thisMonthEarnData">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Yükleniliyor...</span>
                  </div>
                  <span class="h2 mb-0" style="display: none;">-</span>
                  <span class="badge badge-soft-secondary mt--1" style="display: none;">0%</span>
                </div>
              </div>
              <div class="col-auto">
                <span class="h2 fe fe-dollar-sign text-muted mb-0"></span>
              </div>
            <?php endif; ?>
            <?php if ($readAdmin["permission"] == 2 || $readAdmin["permission"] == 3): ?>
              <div class="col">
                <h6 class="card-title text-uppercase text-muted mb-2">
                  Onay Bekleyen Yorumlar
                </h6>
                <div id="waitingCommentsCardData">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                  <span class="h2 mb-0" style="display: none;">-</span>
                </div>
              </div>
              <div class="col-auto">
                <span class="h2 fe fe-message-circle text-muted mb-0"></span>
              </div>
            <?php endif; ?>
            <?php if ($readAdmin["permission"] == 4): ?>
              <div class="col">
                <h6 class="card-title text-uppercase text-muted mb-2">
                  Bu Ay Yazılan Haberler
                </h6>
                <div id="thisMonthNewsCardData">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                  <span class="h2 mb-0" style="display: none;">-</span>
                </div>
              </div>
              <div class="col-auto">
                <span class="h2 fe fe-edit text-muted mb-0"></span>
              </div>
            <?php endif; ?>
            <?php if ($readAdmin["permission"] == 5): ?>
              <div class="col">
                <h6 class="card-title text-uppercase text-muted mb-2">
                  Bu Ayki Destek Mesajları
                </h6>
                <div id="thisMonthSupportCardData">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                  <span class="h2 mb-0" style="display: none;">-</span>
                </div>
              </div>
              <div class="col-auto">
                <span class="h2 fe fe-message-square text-muted mb-0"></span>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
	  
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="card-title text-uppercase text-muted mb-2">
                Yanıt Bekleyen Destekler
              </h6>
              <div id="waitingSupportCardData">
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                <span class="h2 mb-0" style="display: none;">-</span>
              </div>
            </div>
            <div class="col-auto">
              <span class="h2 fe fe-message-square text-muted mb-0"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="card-title text-uppercase text-muted mb-2">
                Çevrimiçi Oyuncu
              </h6>
              <span class="h2 mb-0" data-toggle="onlinetext" server-ip="<?php echo $serverIP; ?>">-/-</span>
            </div>
            <div class="col-auto">
              <span class="h2 fe fe-globe text-muted mb-0"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="row">
	<div class="col-md-12">
		<h2>Aktif Yetkililer</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th style="color:#fff">#</th>
					<th style="color:#fff"><b>YETKI</b></th>
					<th style="color:#fff"><b>KULLANICI ADI</b></th>
						<th style="color:#fff"><b>ISIM</b></th>
					<th style="color:#fff"><b>SON AKTIVITE</b></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	</div>
	
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h4 class="card-header-title">
                Yetkili Sohbet
              </h4>
            </div>
            <div class="col-auto">
              <a id="chatRefresh" class="small text-muted" href="#">
                <i class="fe fe-refresh-cw"></i>
              </a>
            </div>
          </div>
        </div>
        <div id="chatBox" class="card-body" style="height: 200px !important; overflow: auto;">
          <div id="spinner">
            <div class="spinner-border" role="status">
              <span class="sr-only">-/-</span>
            </div>
          </div>
          <div id="chatHistory"></div>
        </div>
        <div class="card-footer p-0">
          <input type="text" id="chatMessage" class="form-control border-0" style="padding: .75rem 1.5rem; border-radius: 0 0 .375rem .375rem;" name="message" placeholder="Mesajınızı giriniz.">
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <?php
        $creditHistory = $db->prepare("SELECT CH.*, A.realname FROM CreditHistory CH INNER JOIN Accounts A ON CH.accountID = A.id WHERE CH.type IN (?, ?) AND CH.paymentStatus = ? ORDER BY CH.id DESC LIMIT 5");
        $creditHistory->execute(array(1, 2, 1));
      ?>
      <?php if ($creditHistory->rowCount() > 0): ?>
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col">
                <h4 class="card-header-title">
                  Rivalet Yükleme Geçmişi
                </h4>
              </div>
              <div class="col-auto">
                <a class="small" href="/yonetim-paneli/magaza/kredi-yukleme-gecmisi">Tümü</a>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive mb-0">
              <table class="table table-sm table-no-wrap card-table">
                <thead>
                  <tr>
                    <th>Kullanıcı</th>
                    <th class="text-center">Miktar</th>
                    <th class="text-center">Ödeme</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($creditHistory as $readCreditHistory): ?>
                    <tr>
                      <td>
                        <a class="avatar avatar-xs d-inline-block" href="/yonetim-paneli/hesap/goruntule/<?php echo $readCreditHistory["realname"]; ?>">
                          <img src="https://minotar.net/avatar/<?php echo $readCreditHistory["realname"]; ?>/20.png" alt="Rivalet Alan Oyuncu" class="rounded-circle">
                        </a>
                        <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readCreditHistory["realname"]; ?>"><?php echo $readCreditHistory["realname"]; ?></a>
                      </td>
                      <td class="text-center">
                        <?php if ($readCreditHistory["type"] == 3 || $readCreditHistory["type"] == 5): ?>
                          <span class="text-danger">-<?php echo $readCreditHistory["price"]; ?></span>
                        <?php else: ?>
                          <span class="text-success">+<?php echo $readCreditHistory["price"]; ?></span>
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <?php if ($readCreditHistory["type"] == 1): ?>
                          <i class="fa fa-mobile" data-toggle="tooltip" data-placement="top" title="Mobil Ödeme"></i>
                        <?php elseif ($readCreditHistory["type"] == 2): ?>
                          <i class="fa fa-credit-card" data-toggle="tooltip" data-placement="top" title="Kredi Kartı Ödeme"></i>
                        <?php elseif ($readCreditHistory["type"] == 3): ?>
                          <i class="fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="Gönderim (Gönderen)"></i>
                        <?php elseif ($readCreditHistory["type"] == 4): ?>
                          <i class="fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="Gönderim (Alan)"></i>
                        <?php else: ?>
                          <i class="fa fa-paper-plane"></i>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php else: ?>
        <?php echo alertError("Rivalet yükleme geçmişi bulunamadı!"); ?>
      <?php endif; ?>
    </div>
    <div class="col-md-4">
      <?php $storeHistory = $db->query("SELECT SH.*, A.realname, P.name as productName, S.name as serverName FROM StoreHistory SH INNER JOIN Accounts A ON SH.accountID = A.id INNER JOIN Products P ON SH.productID = P.id INNER JOIN Servers S ON SH.serverID = S.id ORDER BY SH.id DESC LIMIT 5"); ?>
      <?php if ($storeHistory->rowCount() > 0): ?>
		
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col">
                <h4 class="card-header-title">
                  Market Geçmişi
                </h4>
              </div>
              <div class="col-auto">
                <a class="small" href="/yonetim-paneli/magaza/magaza-gecmisi">Tümü</a>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive mb-0">
              <table class="table table-sm table-no-wrap card-table">
                <thead>
                  <tr>
                    <th>Kullanıcı</th>
                    <th class="text-center">Ürün</th>
                    <th class="text-center">Sunucu</th>
                    <th class="text-center">Miktar</th>
                  </tr>
                </thead>
                <tbody>
					
                  <?php foreach ($storeHistory as $readStoreHistory): ?>
                    <tr>
                      <td>
                        <a class="avatar avatar-xs d-inline-block" href="/yonetim-paneli/hesap/goruntule/<?php echo $readStoreHistory["realname"]; ?>">
                          <img src="https://minotar.net/avatar/<?php echo $readStoreHistory["realname"]; ?>/20.png" alt="Marketi Kullanan Kullanıcı" class="rounded-circle">
                        </a>
                        <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readStoreHistory["realname"]; ?>"><?php echo $readStoreHistory["realname"]; ?></a>
                      </td>
                      <td class="text-center"><?php echo $readStoreHistory["productName"]; ?></td>
                      <td class="text-center"><?php echo $readStoreHistory["serverName"]; ?></td>
                      <td class="text-center"><?php echo $readStoreHistory["price"]; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
		
      <?php else: ?>
        <?php echo alertError("Market geçmişi bulunamadı!"); ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  var username        = '<?php echo $readAdmin["realname"]; ?>';
  var verifiedCircle  = '<?php echo verifiedCircle($readAdmin["permission"]); ?>';
  var creationDate    = '<?php echo date('H:i'); ?>';
</script>
<?php if (get("alert") == 001): ?>
  <script type="text/javascript">
    var alertText     = 'Bu sayfayı görüntüleyebilecek yetkiye sahip değilsiniz!';
    var alertLocation = '/yonetim-paneli';
  </script>
  <?php $extraResourcesJS->addResource('/apps/dashboard/public/assets/js/home.alert.js'); ?>
<?php endif; ?>
<?php if (get("alert") == 002): ?>
  <script type="text/javascript">
    var alertText     = 'Bu işlemi yapabilecek yetkiye sahip değilsiniz!';
    var alertLocation = '/yonetim-paneli';
  </script>
  <?php $extraResourcesJS->addResource('/apps/dashboard/public/assets/js/home.alert.js'); ?>
<?php endif; ?>
<?php if (get("alert") == 101): ?>
  <script type="text/javascript">
    var alertText     = 'Kendinizi silemezsiniz!';
    var alertLocation = '/yonetim-paneli/hesap';
  </script>
  <?php $extraResourcesJS->addResource('/apps/dashboard/public/assets/js/home.alert.js'); ?>
<?php endif; ?>

