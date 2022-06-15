<?php
  if ($readAdmin["permission"] != 1 && $readAdmin["permission"] != 2) {
    go('/yonetim-paneli/hata/001');
  }
  require_once(__ROOT__.'/apps/dashboard/private/packages/class/extraresources/extraresources.php');
  $extraResourcesJS = new ExtraResources('js');
  $extraResourcesJS->addResource('/apps/dashboard/public/assets/js/loader.js');
?>
<?php if (get("target") == 'account'): ?>
  <?php if (get("action") == 'getAll'): ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="header">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="header-title">Hesaplar</h2>
                </div>
                <div class="col-auto">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/yonetim-paneli">Riva | Yönetici Paneli</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Hesaplar</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php if ($readSettings["totalAccountCount"] > 0): ?>
            <?php
              if (get("page")) {
                if (!is_numeric(get("page"))) {
                  $_GET["page"] = 1;
                }
                $page = intval(get("page"));
              }
              else {
                $page = 1;
              }

              $visiblePageCount = 5;
              $limit = 50;

              $itemsCount = $readSettings["totalAccountCount"];
              $pageCount = ceil($itemsCount/$limit);
              if ($page > $pageCount) {
                $page = 1;
              }
              $visibleItemsCount = $page * $limit - $limit;
              $accounts = $db->query("SELECT * FROM Accounts ORDER BY id DESC LIMIT $visibleItemsCount, $limit");

              if (isset($_POST["query"])) {
                if (post("query") != null) {
                  $accounts = $db->prepare("SELECT * FROM Accounts WHERE id = :searchEqual OR realname LIKE :search OR email LIKE :search ORDER BY id DESC");
                  $accounts->execute(array(
                    "search"      => '%'.post("query").'%',
                    "searchEqual" => post("query")
                  ));
                }
              }
            ?>
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <form action="" method="post" class="d-flex align-items-center w-100">
                    <div class="col">
                      <div class="row align-items-center">
                        <div class="col-auto pr-0">
                          <span class="fe fe-search text-muted"></span>
                        </div>
                        <div class="col">
                          <input type="search" class="form-control form-control-flush search" name="query" placeholder="Arama Yap (Kullanıcı ID, Kullanıcı Adı veya E-Posta Adresi)" value="<?php echo (isset($_POST["query"])) ? post("query"): null; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <button type="submit" class="btn btn-sm btn-success">Ara</button>
                      <a class="btn btn-sm btn-white" href="/yonetim-paneli/hesap/ekle">Hesap Ekle</a>
                    </div>
                  </form>
                </div>
              </div>
              <div id="loader" class="card-body p-0 is-loading">
                <div id="spinner">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">-/-</span>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-sm table-nowrap card-table">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 40px;">#ID</th>
                        <th>Kullanıcı Adı</th>
                        <th>E-Posta<th>Rivalet</th>
                        <th>Yetki</th>
                        <th>Son Giriş</th>
                        <th>Kayıt Tarihi</th>
                        <th class="text-right">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php foreach ($accounts as $readAccounts): ?>
                        <tr>
                          <td class="text-center" style="width: 40px;">
                            <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readAccounts["id"]; ?>">
                              #<?php echo $readAccounts["id"]; ?>
                            </a>
                          </td>
                          <td>
                            <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readAccounts["id"]; ?>">
                              <?php echo $readAccounts["realname"]; ?>
                            </a>
                          </td>
                          <td>
                            <?php echo $readAccounts["email"]; ?>
                          </td>
                          <td>
                            <?php echo $readAccounts["credit"]; ?>
                          </td>
                          <td>
                            <?php echo permissionTag($readAccounts["permission"]); ?>
                          </td>
                          <td>
                            <?php if ($readAccounts["lastlogin"] == 0): ?>
                              Giriş Yapılmadı
                            <?php else: ?>
                              <?php echo convertTime(date("Y-m-d H:i:s", ($readAccounts["lastlogin"]/1000)), 2, true); ?>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if ($readAccounts["creationDate"] == "1000-01-01 00:00:00"): ?>
                              Bilinmiyor
                            <?php else: ?>
                              <?php echo convertTime($readAccounts["creationDate"], 2, true); ?>
                            <?php endif; ?>
                          </td>
                          <td class="text-right">
                            <a class="btn btn-sm btn-rounded-circle btn-success" href="/yonetim-paneli/hesap/duzenle/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Düzenle">
                              <i class="fe fe-edit-2"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-primary" href="/yonetim-paneli/hesap/goruntule/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Görüntüle">
                              <i class="fe fe-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-warning" href="/yonetim-paneli/engel/ekle/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Engelle">
                              <i class="fe fe-slash"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-secondary" href="/yonetim-paneli/magaza/esya/gonder/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Eşya Gönder">
                              <i class="fe fe-archive"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-info" href="/yonetim-paneli/magaza/kredi/gonder/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Rivalet Gönder">
                              <i class="fe fe-dollar-sign"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-danger clickdelete" href="/yonetim-paneli/hesap/sil/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Sil">
                              <i class="fe fe-trash-2"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php if (post("query") == false): ?>
              <nav class="pt-3 pb-5" aria-label="Page Navigation">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?php echo ($page == 1) ? "disabled" : null; ?>">
                    <a class="page-link" href="/yonetim-paneli/hesap/<?php echo $page-1; ?>" tabindex="-1" aria-disabled="true"><i class="fa fa-angle-left"></i></a>
                  </li>
                  <?php for ($i = $page - $visiblePageCount; $i < $page + $visiblePageCount + 1; $i++): ?>
                    <?php if ($i > 0 and $i <= $pageCount): ?>
                      <li class="page-item <?php echo (($page == $i) ? "active" : null); ?>">
                        <a class="page-link" href="/yonetim-paneli/hesap/<?php echo $i; ?>"><?php echo $i; ?></a>
                      </li>
                    <?php endif; ?>
                  <?php endfor; ?>
                  <li class="page-item <?php echo ($page == $pageCount) ? "disabled" : null; ?>">
                    <a class="page-link" href="/yonetim-paneli/hesap/<?php echo $page+1; ?>"><i class="fa fa-angle-right"></i></a>
                  </li>
                </ul>
              </nav>
            <?php endif; ?>
          <?php else: ?>
            <?php echo alertError("Bu sayfaya ait veri bulunamadı!"); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php elseif (get("action") == 'insert'): ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="header">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="header-title">Hesap Ekle</h2>
                </div>
                <div class="col-auto">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/yonetim-paneli">Riva | Yönetici Paneli</a></li>
                      <li class="breadcrumb-item"><a href="/yonetim-paneli/hesap">Hesaplar</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Hesap Ekle</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php
            require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
            $csrf = new CSRF('csrf-sessions', 'csrf-token');
            if (isset($_POST["insertAccounts"])) {
              if (!$csrf->validate('insertAccounts')) {
                echo alertError("Sistemsel bir sorun oluştu!");
              }
              else if (post("username") == null || post("email") == null) {
                echo alertError("Lütfen boş alan bırakmayınız!");
              }
              else {
                $usernameValid = $db->prepare("SELECT * FROM Accounts WHERE realname = ?");
                $usernameValid->execute(array(post("username")));

                $emailValid = $db->prepare("SELECT * FROM Accounts WHERE email = ?");
                $emailValid->execute(array(post("email")));

                if (post("credit") == null) {
                  $_POST["credit"] = 0;
                }
                if (post("permission") == null) {
                  $_POST["permission"] = 0;
                }
                if ($readAdmin["permission"] != 1) {
                  $_POST["credit"] = 0;
                  $_POST["permission"] = 0;
                }
                if ($readSettings["authStatus"] == 0) {
                  $_POST["authStatus"] = 0;
                }

                if (checkUsername(post("username"))) {
                  echo alertError("Girdiğiniz kullanıcı adı uygun olmayan karakter içeriyor!");
                }
                else if (strlen(post("username")) < 3) {
                  echo alertError("Kullanıcı adı 3 karakterden az olamaz!");
                }
                else if (strlen(post("username")) > 16) {
                  echo alertError("Kullanıcı adı 16 karakterden fazla olamaz!");
                }
                else if ($usernameValid->rowCount() > 0) {
                  echo alertError('<strong>'.post("username").'</strong> başkası tarafından kullanılıyor!');
                }
                else if (checkEmail(post("email"))) {
                  echo alertError("Lütfen geçerli bir E-Posta adresi giriniz!");
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
                else {
                  $password = (($readSettings["passwordType"] == 1) ? createSHA256(post("password")) : md5(post("password")));
                  $insertAccounts = $db->prepare("INSERT INTO Accounts (username, realname, email, password, credit, permission, authStatus, creationIP, creationDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                  $insertAccounts->execute(array(strtolower(post("username")), post("username"), post("email"), $password, post("credit"), post("permission"), post("authStatus"), getIP(), date("Y-m-d H:i:s")));
                  echo alertSuccess("Hesap başarıyla eklendi!");
                }
              }
            }
          ?>
          <div class="card">
            <div class="card-body">
              <form action="" method="post">
                <div class="form-group row">
                  <label for="inputUsername" class="col-sm-2 col-form-label">Kullanıcı Adı:</label>
                  <div class="col-sm-10">
                    <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Minecraft kullanıcı adını yazınız.">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputUsername" class="col-sm-2 col-form-label">E-Posta:</label>
                  <div class="col-sm-10">
                    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email adresini yazınız.">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputUsername" class="col-sm-2 col-form-label">Şifre:</label>
                  <div class="col-sm-10">
                    <input type="password" id="inputEmail" class="form-control" name="password" placeholder="Şifreyi yazınız.">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputUsername" class="col-sm-2 col-form-label">Şifre (Tekrar):</label>
                  <div class="col-sm-10">
                    <input type="password" id="inputEmail" class="form-control" name="passwordRe" placeholder="Şifreyi güvenlik amaçlı tekrar yazınız.">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputUsername" class="col-sm-2 col-form-label">Rivalet:</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <input type="number" id="inputPrice" class="form-control form-control-prepended" name="credit" placeholder="Rivalet miktarını yazınız." <?php echo ($readAdmin["permission"] != 1) ? 'disabled="disabled"' : null ?>>
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <span class="fa fa-try"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="selectPermission" class="col-sm-2 col-form-label">Yetki:</label>
                  <div class="col-sm-10">
                    <select id="selectPermission" class="form-control" name="permission" data-toggle="select" data-minimum-results-for-search="-1">
                      <option value="0">Oyuncu</option>
                      <?php if ($readAdmin["permission"] == 1): ?>
                        <option value="1">Yönetici</option>
                        <option value="2">Moderatör</option>
                        <option value="3">Yardımcı</option>
                        <option value="4">Yazar</option>
                        <option value="5">Destek</option>
                        <option value="6">YouTuber</option>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <?php if ($readSettings["authStatus"] == 1): ?>
                  <div class="form-group row">
                    <label for="selectAuthStatus" class="col-sm-2 col-form-label">
                      2FA:
                      <a href="https://authy.com/" rel="external">
                        <i class="fa fa-question-circle text-primary" data-toggle="tooltip" data-placement="top" title="İki Adımlı Doğrulama"></i>
                      </a>
                    </label>
                    <div class="col-sm-10">
                      <select id="selectAuthStatus" class="form-control" name="authStatus" data-toggle="select" data-minimum-results-for-search="-1">
                        <option value="0">Kapalı</option>
                        <option value="1">Açık</option>
                      </select>
                    </div>
                  </div>
                <?php endif; ?>
                <?php echo $csrf->input('insertAccounts'); ?>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="submit" class="btn btn-rounded btn-success" name="insertAccounts">Ekle</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php elseif (get("action") == 'update' && get("id")): ?>
    <?php
      $account = $db->prepare("SELECT * FROM Accounts WHERE id = ?");
      $account->execute(array(get("id")));
      $readAccount = $account->fetch();

      // Yönetici değilse ve yönetici düzenlemeye çalışırsa yetkisiz işlem mesajı göster.
      if ($readAdmin["permission"] != 1 && $readAccount["permission"] == 1) {
        go('/yonetim-paneli/hata/001');
      }
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="header">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="header-title">Hesap Düzenle</h2>
                </div>
                <div class="col-auto">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/yonetim-paneli">Riva | Yönetici Paneli</a></li>
                      <li class="breadcrumb-item"><a href="/yonetim-paneli/hesap">Hesaplar</a></li>
                      <li class="breadcrumb-item"><a href="/yonetim-paneli/hesap">Hesap Düzenle</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo ($account->rowCount() > 0) ? $readAccount["realname"] : "Bulunamadı!"; ?></li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php if ($account->rowCount() > 0): ?>
            <?php
              require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
              $csrf = new CSRF('csrf-sessions', 'csrf-token');
              if (isset($_POST["updateAccounts"])) {
                if (!$csrf->validate('updateAccounts')) {
                  echo alertError("Sistemsel bir sorun oluştu!");
                }
                else if (post("username") == null || post("email") == null) {
                  echo alertError("Lütfen boş alan bırakmayınız!");
                }
                else {
                  $usernameValid = $db->prepare("SELECT * FROM Accounts WHERE realname = ?");
                  $usernameValid->execute(array(post("username")));
                  $emailValid = $db->prepare("SELECT * FROM Accounts WHERE email = ?");
                  $emailValid->execute(array(post("email")));

                  if (post("credit") == null) {
                    $_POST["credit"] = $readAccount["credit"];
                  }
                  if (post("permission") == null) {
                    $_POST["permission"] = $readAccount["permission"];
                  }
                  if ($readAdmin["permission"] != 1) {
                    $_POST["credit"] = $readAccount["credit"];
                    $_POST["permission"] = $readAccount["permission"];
                  }

                  if (checkUsername(post("username"))) {
                    echo alertError("Girdiğiniz kullanıcı adı uygun olmayan karakter içeriyor!");
                  }
                  else if (strlen(post("username")) < 3) {
                    echo alertError("Kullanıcı adı 3 karakterden az olamaz!");
                  }
                  else if (strlen(post("username")) > 16) {
                    echo alertError("Kullanıcı adı 16 karakterden fazla olamaz!");
                  }
                  else if (post("username") != $readAccount["realname"] && $usernameValid->rowCount() > 0) {
                    echo alertError('<strong>'.post("username").'</strong> başkası tarafından kullanılıyor!');
                  }
                  else if (checkEmail(post("email"))) {
                    echo alertError("Lütfen geçerli bir e-mail adresi giriniz!");
                  }
                  else if (post("email") != $readAccount["email"] && $emailValid->rowCount() > 0) {
                    echo alertError('<strong>'.post("email").'</strong> başkası tarafından kullanılıyor!');
                  }
                  else if (strlen(post("password")) < 4 && (post("password") != null && post("passwordRe") != null)) {
                    echo alertError("Şifre 4 karakterden az olamaz!");
                  }
                  else if (post("password") != post("passwordRe") && (post("password") != null && post("passwordRe") != null)) {
                    echo alertError("Şifreler uyuşmuyor!");
                  }
                  else if (checkBadPassword(post("password")) && (post("password") != null && post("passwordRe") != null)) {
                    echo alertError("Basit şifreler kullanamazsınız!");
                  }
                  else {
                    if (post("password") != null && post("passwordRe") != null) {
                      $password = (($readSettings["passwordType"] == 1) ? createSHA256(post("password")) : md5(post("password")));
                    }
                    else {
                      $password = $readAccount["password"];
                    }
                    if ((post("username") != $readAccount["realname"]) || (post("email") != $readAccount["email"]) || (post("password") != null && post("passwordRe") != null)) {
                      $deleteAccountSessions = $db->prepare("DELETE FROM AccountSessions WHERE accountID = ?");
                      $deleteAccountSessions->execute(array(get("id")));
                    }
                    $updateAccounts = $db->prepare("UPDATE Accounts SET username = ?, realname = ?, email = ?, password = ?, credit = ?, permission = ? WHERE id = ?");
                    $updateAccounts->execute(array(strtolower(post("username")), post("username"), post("email"), $password, post("credit"), post("permission"), get("id")));
                    if ($readSettings["authStatus"] == 1) {
                      if ($readAccount["authStatus"] == 1 && post("authStatus") == 0) {
                        $deleteAccountAuths = $db->prepare("DELETE FROM AccountAuths WHERE accountID = ?");
                        $deleteAccountAuths->execute(array(get("id")));
                      }
                      $updateAccountAuthStatus = $db->prepare("UPDATE Accounts SET authStatus = ? WHERE id = ?");
                      $updateAccountAuthStatus->execute(array(post("authStatus"), get("id")));
                    }
                    echo alertSuccess("Değişiklikler başarıyla kaydedildi!");
                  }
                }
              }
            ?>
            <div class="card">
              <div class="card-body">
                <form action="" method="post">
                  <div class="form-group row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Kullanıcı Adı:</label>
                    <div class="col-sm-10">
                      <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Minecraft kullanıcı adını yazınız." value="<?php echo $readAccount["realname"]; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">E-Posta:</label>
                    <div class="col-sm-10">
                      <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email adresini yazınız." value="<?php echo $readAccount["email"]; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Şifre:</label>
                    <div class="col-sm-10">
                      <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Şifreyi yazınız.">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPasswordRe" class="col-sm-2 col-form-label">Şifre (Tekrar):</label>
                    <div class="col-sm-10">
                      <input type="password" id="inputPasswordRe" class="form-control" name="passwordRe" placeholder="Şifreyi güvenlik amaçlı tekrar yazınız.">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputCredit" class="col-sm-2 col-form-label">Rivalet:</label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <input type="number" id="inputCredit" class="form-control form-control-prepended" name="credit" placeholder="Rivalet miktarını yazınız." value="<?php echo $readAccount["credit"]; ?>" <?php echo ($readAdmin["permission"] != 1) ? 'disabled="disabled"' : null ?>>
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <span class="fa fa-try"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="selectPermission" class="col-sm-2 col-form-label">Yetki:</label>
                    <div class="col-sm-10">
                      <select id="selectPermission" class="form-control" name="permission" data-toggle="select" data-minimum-results-for-search="-1">
                        <option value="0" <?php echo ($readAccount["permission"] == 0) ? 'selected="selected"' : null; ?>>Üye</option>
                        <?php if ($readAdmin["permission"] == 1): ?>
                          <option value="1" <?php echo ($readAccount["permission"] == 1) ? 'selected="selected"' : null; ?>>Yönetici</option>
                          <option value="2" <?php echo ($readAccount["permission"] == 2) ? 'selected="selected"' : null; ?>>Moderatör</option>
                          <option value="3" <?php echo ($readAccount["permission"] == 3) ? 'selected="selected"' : null; ?>>Görevli</option>
                          <option value="4" <?php echo ($readAccount["permission"] == 4) ? 'selected="selected"' : null; ?>>Yazar</option>
                          <option value="5" <?php echo ($readAccount["permission"] == 5) ? 'selected="selected"' : null; ?>>Destek</option>
                          <option value="6" <?php echo ($readAccount["permission"] == 6) ? 'selected="selected"' : null; ?>>YouTuber</option>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <?php if ($readSettings["authStatus"] == 1): ?>
                    <div class="form-group row">
                      <label for="selectAuthStatus" class="col-sm-2 col-form-label">
                        2FA:
                        <a href="https://authy.com/" rel="external">
                          <i class="fa fa-question-circle text-primary" data-toggle="tooltip" data-placement="top" title="İki Adımlı Doğrulama"></i>
                        </a>
                      </label>
                      <div class="col-sm-10">
                        <select id="selectAuthStatus" class="form-control" name="authStatus" data-toggle="select" data-minimum-results-for-search="-1">
                          <option value="0" <?php echo ($readAccount["authStatus"] == 0) ? 'selected="selected"' : null; ?>>Kapalı</option>
                          <option value="1" <?php echo ($readAccount["authStatus"] == 1) ? 'selected="selected"' : null; ?>>Açık</option>
                        </select>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php echo $csrf->input('updateAccounts'); ?>
                  <div class="clearfix">
                    <div class="float-right">
                      <a class="btn btn-rounded-circle btn-danger clickdelete" href="/yonetim-paneli/hesap/sil/<?php echo $readAccount["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Sil">
                        <i class="fe fe-trash-2"></i>
                      </a>
                      <a class="btn btn-rounded-circle btn-primary" href="/yonetim-paneli/hesap/goruntule/<?php echo $readAccount["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Görüntüle">
                        <i class="fe fe-eye"></i>
                      </a>
                      <a class="btn btn-rounded-circle btn-warning" href="/yonetim-paneli/engel/ekle/<?php echo $readAccount["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Engelle">
                        <i class="fe fe-slash"></i>
                      </a>
                      <a class="btn btn-rounded-circle btn-secondary" href="/yonetim-paneli/magaza/esya/gonder/<?php echo $readAccount["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Eşya Gönder">
                        <i class="fe fe-archive"></i>
                      </a>
                      <a class="btn btn-rounded-circle btn-info" href="/yonetim-paneli/magaza/kredi/gonder/<?php echo $readAccount["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Rivalet Gönder">
                        <i class="fe fe-dollar-sign"></i>
                      </a>
                      <button type="submit" class="btn btn-rounded btn-success" name="updateAccounts">Değişiklikleri Kaydet</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php else: ?>
            <?php echo alertError("Bu sayfaya ait veri bulunamadı!"); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php elseif (get("action") == 'get' && get("id")): ?>
    <?php
      $account = $db->prepare("SELECT * FROM Accounts WHERE id = :user OR realname = :user");
      $account->execute(array(
        'user' => get("id")
      ));
      $readAccount = $account->fetch();
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="header">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="header-title">Hesap Görüntüle</h2>
                </div>
                <div class="col-auto">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/yonetim-paneli">Riva | Yönetici Paneli</a></li>
                      <li class="breadcrumb-item"><a href="/yonetim-paneli/hesap">Hesaplar</a></li>
                      <li class="breadcrumb-item"><a href="/yonetim-paneli/hesap">Hesap Görüntüle</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo ($account->rowCount() > 0) ? $readAccount["realname"] : "Bulunamadı!"; ?></li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if ($account->rowCount() > 0): ?>
          <div class="col-md-4">
            <div class="card">
              <div class="card-img-profile">
                <a href="/profil">
                  <?php echo minecraftHead($readSettings["avatarAPI"], $readAccount["realname"], 70); ?>
                </a>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-5">Kullanıcı Adı:</label>
                  <label class="col-sm-7">
                    <?php echo $readAccount["realname"]; ?>
                    <?php echo verifiedCircle($readAccount["permission"]); ?>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5">E-Posta:</label>
                  <label class="col-sm-7">
                    <?php echo $readAccount["email"]; ?>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5">Yetki:</label>
                  <label class="col-sm-7">
                    <?php echo permissionTag($readAccount["permission"]); ?>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5">Rivalet:</label>
                  <label class="col-sm-7">
                    <?php echo $readAccount["credit"]; ?>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5">Son Giriş:</label>
                  <label class="col-sm-7">
                    <?php if ($readAccount["lastlogin"] == 0): ?>
                      Giriş Yapılmadı
                    <?php else: ?>
                      <?php echo convertTime(date("Y-m-d H:i:s", ($readAccount["lastlogin"]/1000)), 2, true); ?>
                    <?php endif; ?>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5">Kayıt Tarihi:</label>
                  <label class="col-sm-7">
                    <?php if ($readAccount["creationDate"] == "1000-01-01 00:00:00"): ?>
                      Bilinmiyor
                    <?php else: ?>
                      <?php echo convertTime($readAccount["creationDate"], 2, true); ?>
                    <?php endif; ?>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5">IP Adresi:</label>
                  <label class="col-sm-7">
                    <?php if ($readAccount["creationIP"] == "127.0.0.1"): ?>
                      Bilinmiyor
                    <?php else: ?>
                      <?php echo $readAccount["creationIP"]; ?>
                    <?php endif; ?>
                  </label>
                </div>
                <?php if ($readSettings["authStatus"] == 1): ?>
                  <div class="form-group row">
                    <label class="col-sm-5">
                      2FA:
                      <a href="https://authy.com/" rel="external">
                        <i class="fa fa-question-circle text-primary" data-toggle="tooltip" data-placement="top" title="İki Adımlı Doğrulama"></i>
                      </a>
                    </label>
                    <label class="col-sm-7">
                      <?php echo ($readAccount["authStatus"] == 0) ? "Kapalı" : "Açık"; ?>
                    </label>
                  </div>
                <?php endif; ?>
                <?php
                  $accountSocialMedia = $db->prepare("SELECT * FROM AccountSocialMedia WHERE accountID = ?");
                  $accountSocialMedia->execute(array($readAccount["id"]));
                  $readAccountSocialMedia = $accountSocialMedia->fetch();
                ?>
                <div class="form-group row">
                  <label class="col-sm-5">Skype:</label>
                  <label class="col-sm-7">
                    <?php if ($accountSocialMedia->rowCount() > 0): ?>
                      <?php echo (($readAccountSocialMedia["skype"] != '0') ? $readAccountSocialMedia["skype"] : "-"); ?>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5">Discord:</label>
                  <label class="col-sm-7">
                    <?php if ($accountSocialMedia->rowCount() > 0): ?>
                      <?php echo (($readAccountSocialMedia["discord"] != '0') ? $readAccountSocialMedia["discord"] : "-"); ?>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </label>
                </div>
                <?php
                  $siteBannedAccountStatus = $db->prepare("SELECT * FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?) ORDER BY expiryDate DESC LIMIT 1");
                  $siteBannedAccountStatus->execute(array($readAccount["id"], 1, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
                  $readSiteBannedAccountStatus = $siteBannedAccountStatus->fetch();
                ?>
                <?php if ($siteBannedAccountStatus->rowCount() > 0): ?>
                  <div class="form-group row">
                    <label class="col-sm-5">Site Engel:</label>
                    <label class="col-sm-7">
                      <?php echo ($readSiteBannedAccountStatus["expiryDate"] == '1000-01-01 00:00:00') ? 'Süresiz' : getDuration($readSiteBannedAccountStatus["expiryDate"]).' gün'; ?>
                    </label>
                  </div>
                <?php endif; ?>
                <?php
                  $supportBannedAccountStatus = $db->prepare("SELECT * FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?) ORDER BY expiryDate DESC LIMIT 1");
                  $supportBannedAccountStatus->execute(array($readAccount["id"], 2, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
                  $readSupportBannedAccountStatus = $supportBannedAccountStatus->fetch();
                ?>
                <?php if ($supportBannedAccountStatus->rowCount() > 0): ?>
                  <div class="form-group row">
                    <label class="col-sm-5">Destek Engel:</label>
                    <label class="col-sm-7">
                      <?php echo ($readSupportBannedAccountStatus["expiryDate"] == '1000-01-01 00:00:00') ? 'Süresiz' : getDuration($readSupportBannedAccountStatus["expiryDate"]).' gün'; ?>
                    </label>
                  </div>
                <?php endif; ?>
                <?php
                  $commentBannedAccountStatus = $db->prepare("SELECT * FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?) ORDER BY expiryDate DESC LIMIT 1");
                  $commentBannedAccountStatus->execute(array($readAccount["id"], 3, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
                  $readCommentBannedAccountStatus = $commentBannedAccountStatus->fetch();
                ?>
                <?php if ($commentBannedAccountStatus->rowCount() > 0): ?>
                  <div class="form-group row">
                    <label class="col-sm-5">Yorum Engel:</label>
                    <label class="col-sm-7">
                      <?php echo ($readCommentBannedAccountStatus["expiryDate"] == '1000-01-01 00:00:00') ? 'Süresiz' : getDuration($readCommentBannedAccountStatus["expiryDate"]).' gün'; ?>
                    </label>
                  </div>
                <?php endif; ?>
                <div class="row justify-content-between">
                  <div class="col-md-12 mb-3">
                    <a class="btn btn-success w-100" href="/yonetim-paneli/hesap/duzenle/<?php echo $readAccount["id"]; ?>">Düzenle</a>
                  </div>
                  <div class="col-md-12 mb-3">
                    <a class="btn btn-secondary w-100" href="/yonetim-paneli/magaza/esya/gonder/<?php echo $readAccount["id"]; ?>">Eşya Gönder</a>
                  </div>
                  <div class="col-md-12 mb-3">
                    <a class="btn btn-info w-100" href="/yonetim-paneli/magaza/kredi/gonder/<?php echo $readAccount["id"]; ?>">Rivalet Gönder</a>
                  </div>
                  <div class="col-md-6 btn-account-ban">
                    <a class="btn btn-warning w-100" href="/yonetim-paneli/engel/ekle/<?php echo $readAccount["id"]; ?>">Engelle</a>
                  </div>
                  <div class="col-md-6 btn-account-delete">
                    <a class="btn btn-danger clickdelete w-100" href="/yonetim-paneli/hesap/sil/<?php echo $readAccount["id"]; ?>">Sil</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <?php
              $statServers = $db->query("SELECT serverName, serverSlug FROM Leaderboards");
              $statServers->execute();
            ?>
            <?php if ($statServers->rowCount() > 0): ?>
              <div class="card">
                <div class="card-body p-0">
                  <nav>
                    <div class="nav nav-tabs nav-fill">
                      <?php foreach ($statServers as $readStatServers): ?>
                        <?php
                          if (!get("siralama")) {
                            $_GET["siralama"] = $readStatServers["serverSlug"];
                          }
                        ?>
                        <a class="nav-item nav-link <?php echo (get("siralama") == $readStatServers["serverSlug"]) ? "active" : null; ?>" id="nav-<?php echo $readStatServers["serverSlug"]; ?>-tab" href="?siralama=<?php echo $readStatServers["serverSlug"]; ?>">
                          <?php echo $readStatServers["serverName"]; ?>
                        </a>
                      <?php endforeach; ?>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <?php
                      $statServer = $db->query("SELECT * FROM Leaderboards");
                      $statServer->execute();
                    ?>
                    <?php foreach ($statServer as $readStatServer): ?>
                      <?php
                        $usernameColumn = $readStatServer["usernameColumn"];
                        $mysqlTable = $readStatServer["mysqlTable"];
                        $sorter = $readStatServer["sorter"];
                        $tableTitles = $readStatServer["tableTitles"];
                        $tableData = $readStatServer["tableData"];
                        $tableTitlesArray = explode(",", $tableTitles);
                        $tableDataArray = explode(",", $tableData);

                        if ($readStatServer["mysqlServer"] == '0') {
                          $accountOrder = $db->prepare("SELECT $usernameColumn,$tableData FROM $mysqlTable WHERE $usernameColumn = ? ORDER BY $sorter DESC");
                          $accountOrder->execute(array($readAccount["realname"]));
                        }
                        else {
                          try {
                            $newDB = new PDO("mysql:host=".$readStatServer["mysqlServer"]."; port=".$readStatServer["mysqlPort"]."; dbname=".$readStatServer["mysqlDatabase"]."; charset=utf8", $readStatServer["mysqlUsername"], $readStatServer["mysqlPassword"]);
                          }
                          catch (PDOException $e) {
                            die("<strong>MySQL bağlantı hatası:</strong> ".utf8_encode($e->getMessage()));
                          }
                          $accountOrder = $newDB->prepare("SELECT $usernameColumn,$tableData FROM $mysqlTable WHERE $usernameColumn = ? ORDER BY $sorter DESC");
                          $accountOrder->execute(array($readAccount["realname"]));
                        }
                      ?>
                      <div class="tab-pane fade <?php echo (get("siralama") == $readStatServer["serverSlug"]) ? "show active" : null; ?>" id="nav-<?php echo $readStatServer["serverSlug"] ?>">
                        <?php if ($accountOrder->rowCount() > 0): ?>
                          <div class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" style="width: 40px;">Sıra</th>
                                  <th class="text-center" style="width: 20px;">#</th>
                                  <th>Kullanıcı Adı</th>
                                  <?php
                                    foreach ($tableTitlesArray as $readTableTitles) {
                                      echo '<th class="text-center">'.$readTableTitles.'</th>';
                                    }
                                  ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($accountOrder as $readAccountOrder): ?>
                                  <tr>
                                    <td class="text-center" style="width: 40px;">
                                      <?php
                                        if ($readStatServer["mysqlServer"] == '0') {
                                          $userPosition = $db->prepare("SET @position = 0");
                                          $userPosition->execute();
                                          $userPosition = $db->prepare("SELECT (@position:=@position+1) AS position,$usernameColumn FROM $mysqlTable ORDER BY $sorter DESC");
                                          $userPosition->execute();
                                        }
                                        else {
                                          $userPosition = $newDB->prepare("SET @position = 0");
                                          $userPosition->execute();
                                          $userPosition = $newDB->prepare("SELECT (@position:=@position+1) AS position,$usernameColumn FROM $mysqlTable ORDER BY $sorter DESC");
                                          $userPosition->execute();
                                        }
                                      ?>
                                      <?php foreach ($userPosition as $readUserPosition): ?>
                                        <?php if ($readUserPosition[$usernameColumn] == $readAccount["realname"]): ?>
                                          <?php if ($readUserPosition["position"] == 1): ?>
                                            <strong class="text-success">1</strong>
                                          <?php elseif ($readUserPosition["position"] == 2): ?>
                                            <strong class="text-warning">2</strong>
                                          <?php elseif ($readUserPosition["position"] == 3): ?>
                                            <strong class="text-danger">3</strong>
                                          <?php else: ?>
                                            <?php echo $readUserPosition["position"]; ?>
                                          <?php endif; ?>
                                          <?php break; ?>
                                        <?php endif; ?>
                                      <?php endforeach; ?>
                                    </td>
                                    <td class="text-center" style="width: 20px;">
                                      <?php echo minecraftHead($readSettings["avatarAPI"], $readAccount["realname"], 20); ?>
                                    </td>
                                    <td>
                                      <?php echo $readAccount["realname"]; ?>
                                      <?php echo verifiedCircle($readAccount["permission"]); ?>
                                    </td>
                                    <?php foreach ($tableDataArray as $readTableData): ?>
                                      <td class="text-center"><?php echo $readAccountOrder[$readTableData]; ?></td>
                                    <?php endforeach; ?>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        <?php else: ?>
                          <div class="p-4"><?php echo alertError("Bu sunucuda kullanıcıya ait sıralama kaydı bulunmamaktadır!", false); ?></div>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php
              $chests = $db->prepare("SELECT C.*, P.name as productName, S.name as serverName FROM Chests C INNER JOIN Products P ON C.productID = P.id INNER JOIN Servers S ON P.serverID = S.id WHERE C.accountID = ? AND C.status = ? ORDER BY C.id DESC");
              $chests->execute(array($readAccount["id"], 0));
            ?>
            <div class="card">
              <div class="card-header">
                Sandık (<?php echo $chests->rowCount(); ?>)
              </div>
              <div class="card-body p-0">
                <?php if ($chests->rowCount() > 0): ?>
                  <div class="table-responsive" <?php echo ($chests->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                    <table class="table table-sm table-nowrap card-table">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 40px;">#ID</th>
                          <th>Ürün</th>
                          <th>Sunucu</th>
                          <th>Tarih</th>
                          <th class="text-center">İşlem</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($chests as $readChests): ?>
                          <tr>
                            <td class="text-center" style="width: 40px;">
                              #<?php echo $readChests["id"]; ?>
                            </td>
                            <td>
                              <?php echo $readChests["productName"]; ?>
                            </td>
                            <td>
                              <?php echo $readChests["serverName"]; ?>
                            </td>
                            <td>
                              <?php echo convertTime($readChests["creationDate"], 2, true); ?>
                            </td>
                            <td class="text-center">
                              <a class="btn btn-sm btn-rounded-circle btn-danger clickdelete" href="/yonetim-paneli/sandik/sil/<?php echo $readChests["id"]; ?>/<?php echo $readAccount["id"]; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                <i class="fe fe-trash-2"></i>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                <?php else: ?>
                  <div class="p-4"><?php echo alertError("Bu kullanıcıya ait sandık eşyası bulunmamaktadır!", false); ?></div>
                <?php endif; ?>
              </div>
            </div>

            <div class="card">
              <div class="card-body p-0">
                <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-profile-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-support-tab" data-toggle="tab" href="#nav-support" role="tab" aria-controls="nav-support" aria-selected="true">Destek Mesajları</a>
                    <a class="nav-item nav-link" id="nav-credit-history-tab" data-toggle="tab" href="#nav-credit-history" role="tab" aria-controls="nav-credit-history" aria-selected="false">Rivalet Geçmişi</a>
                    <a class="nav-item nav-link" id="nav-store-history-tab" data-toggle="tab" href="#nav-store-history" role="tab" aria-controls="nav-store-history" aria-selected="false">Market Geçmişi</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-support" role="tabpanel" aria-labelledby="nav-support-tab">
                    <?php
                      $supports = $db->prepare("SELECT S.*, SC.name as categoryName, Se.name as serverName FROM Supports S INNER JOIN SupportCategories SC ON S.categoryID = SC.id INNER JOIN Servers Se ON S.serverID = Se.id WHERE S.accountID = ? ORDER BY S.updateDate DESC LIMIT 50");
                      $supports->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($supports->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($supports->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-sm table-nowrap card-table">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 40px;">ID</th>
                              <th>Başlık</th>
                              <th>Kategori</th>
                              <th>Son Güncelleme</th>
                              <th class="text-center">Durum</th>
                              <th class="text-center">İşlem</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($supports as $readSupports): ?>
                              <tr>
                                <td class="text-center" style="width: 40px;">
                                  <a href="/yonetim-paneli/destek/goruntule/<?php echo $readSupports["id"]; ?>/">
                                    #<?php echo $readSupports["id"]; ?>
                                  </a>
                                </td>
                                <td>
                                  <a href="/yonetim-paneli/destek/goruntule/<?php echo $readSupports["id"]; ?>/">
                                    <?php echo $readSupports["title"]; ?>
                                  </a>
                                </td>
                                <td>
                                  <?php echo $readSupports["categoryName"]; ?>
                                </td>
                                <td>
                                  <?php echo convertTime($readSupports["updateDate"]); ?>
                                </td>
                                <td class="text-center">
                                  <?php if ($readSupports["statusID"] == 1): ?>
                                    <span class="badge badge-pill badge-danger">Cevaplanmadı</span>
                                  <?php elseif ($readSupports["statusID"] == 2): ?>
                                    <span class="badge badge-pill badge-success">Cevaplandı</span>
                                  <?php elseif ($readSupports["statusID"] == 3): ?>
                                    <span class="badge badge-pill badge-warning">Kullanıcı Yanıtı</span>
                                  <?php elseif ($readSupports["statusID"] == 4): ?>
                                    <span class="badge badge-pill badge-danger">Kapatıldı</span>
                                  <?php else: ?>
                                    <span class="badge badge-pill badge-danger">HATA!</span>
                                  <?php endif; ?>
                                </td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-rounded-circle btn-primary" href="/yonetim-paneli/destek/goruntule/<?php echo $readSupports["id"]; ?>/" data-toggle="tooltip" data-placement="top" title="Mesajı Oku">
                                    <i class="fa fa-eye"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Bu kullanıcıya ait destek mesajı bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-credit-history" role="tabpanel" aria-labelledby="nav-credit-history-tab">
                    <?php
                      $creditHistory = $db->prepare("SELECT * FROM CreditHistory CH WHERE accountID = ? AND paymentStatus = ? ORDER BY id DESC LIMIT 50");
                      $creditHistory->execute(array($readAccount["id"], 1));
                    ?>
                    <?php if ($creditHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($creditHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-sm table-nowrap card-table">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th class="text-center">Miktar</th>
                              <th class="text-center">Ödeme</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($creditHistory as $readCreditHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readCreditHistory["id"]; ?></td>
                                <td class="text-center"><?php echo ($readCreditHistory["type"] == 3 || $readCreditHistory["type"] == 5) ? '<span class="text-danger">-'.$readCreditHistory["price"].'</span>' : '<span class="text-success">+'.$readCreditHistory["price"].'</span>'; ?></td>
                                <td class="text-center">
                                  <?php if ($readCreditHistory["type"] == 1): ?>
                                    <i class="fa fa-mobile" data-toggle="tooltip" data-placement="top" title="Mobil Ödeme"></i>
                                  <?php elseif ($readCreditHistory["type"] == 2): ?>
                                    <i class="fa fa-credit-card" data-toggle="tooltip" data-placement="top" title="Kredi Kartı Ödeme"></i>
                                  <?php elseif ($readCreditHistory["type"] == 3): ?>
                                    <i class="fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="Gönderim (Gönderen)"></i>
                                  <?php elseif ($readCreditHistory["type"] == 4): ?>
                                    <i class="fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="Gönderim (Alan)"></i>
                                  <?php elseif ($readCreditHistory["type"] == 5): ?>
                                    <i class="fa fa-ticket" data-toggle="tooltip" data-placement="top" title="Çarkıfelek (Bilet)"></i>
                                  <?php elseif ($readCreditHistory["type"] == 6): ?>
                                    <i class="fa fa-ticket" data-toggle="tooltip" data-placement="top" title="Çarkıfelek (Kazanç)"></i>
                                  <?php else: ?>
                                    <i class="fa fa-paper-plane"></i>
                                  <?php endif; ?>
                                </td>
                                <td><?php echo convertTime($readCreditHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Bu kullanıcıya ait Rivalet geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-store-history" role="tabpanel" aria-labelledby="nav-store-history-tab">
                    <?php
                      $storeHistory = $db->prepare("SELECT SH.*, P.name as productName, S.name as serverName FROM StoreHistory SH INNER JOIN Products P ON SH.productID = P.id INNER JOIN Servers S ON SH.serverID = S.id WHERE SH.accountID = ? ORDER BY SH.id DESC LIMIT 50");
                      $storeHistory->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($storeHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($storeHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-sm table-nowrap card-table">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Ürün</th>
                              <th>Sunucu</th>
                              <th>Tutar</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($storeHistory as $readStoreHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readStoreHistory["id"]; ?></td>
                                <td><?php echo $readStoreHistory["productName"]; ?></td>
                                <td><?php echo $readStoreHistory["serverName"]; ?></td>
                                <td>
                                  <?php if ($readStoreHistory["price"] > 0): ?>
                                    <?php echo $readStoreHistory["price"]; ?> Rivalet
                                  <?php else: ?>
                                    Ücretsiz
                                  <?php endif; ?>
                                </td>
                                <td><?php echo convertTime($readStoreHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Bu kullanıcıya ait market geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body p-0">
                <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-profile-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-lottery-history-tab" data-toggle="tab" href="#nav-lottery-history" role="tab" aria-controls="nav-lottery-history" aria-selected="false">Çarkıfelek Geçmişi</a>
                    <a class="nav-item nav-link" id="nav-gift-history-tab" data-toggle="tab" href="#nav-gift-history" role="tab" aria-controls="nav-gift-history" aria-selected="false">Hediye Geçmişi</a>
                    <a class="nav-item nav-link" id="nav-chest-history-tab" data-toggle="tab" href="#nav-chest-history" role="tab" aria-controls="nav-chest-history" aria-selected="false">Sandık Geçmişi</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-lottery-history" role="tabpanel" aria-labelledby="nav-lottery-history-tab">
                    <?php
                      $lotteryHistory = $db->prepare("SELECT LH.*, L.title as lotteryTitle, LA.title, LA.awardType, LA.award FROM LotteryHistory LH INNER JOIN LotteryAwards LA ON LH.lotteryAwardID = LA.id INNER JOIN Lotteries L ON LA.lotteryID = L.id WHERE LH.accountID = ? AND LA.awardType != ? ORDER by LH.id DESC LIMIT 50");
                      $lotteryHistory->execute(array($readAccount["id"], 3));
                    ?>
                    <?php if ($lotteryHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($lotteryHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-sm table-nowrap card-table">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Çarkıfelek</th>
                              <th>Ödül</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($lotteryHistory as $readLotteryHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readLotteryHistory["id"]; ?></td>
                                <td>
                                  <?php echo $readLotteryHistory["lotteryTitle"]; ?>
                                </td>
                                <td>
                                  <?php echo $readLotteryHistory["title"]; ?>
                                </td>
                                <td><?php echo convertTime($readLotteryHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Bu kullanıcıya ait çarkıfelek geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-gift-history" role="tabpanel" aria-labelledby="nav-gift-history-tab">
                    <?php
                      $giftHistory = $db->prepare("SELECT PGH.*, PG.name, PG.giftType, PG.gift FROM ProductGiftsHistory PGH INNER JOIN ProductGifts PG ON PGH.giftID = PG.id WHERE PGH.accountID = ? ORDER by PGH.id DESC LIMIT 50");
                      $giftHistory->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($giftHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($giftHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-sm table-nowrap card-table">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Kod</th>
                              <th>Hediye</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($giftHistory as $readGiftHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readGiftHistory["id"]; ?></td>
                                <td>
                                  <?php echo $readGiftHistory["name"]; ?>
                                </td>
                                <td>
                                  <?php if ($readGiftHistory["giftType"] == 1): ?>
                                    <?php
                                      $product = $db->prepare("SELECT name FROM Products WHERE id = ?");
                                      $product->execute(array($readGiftHistory["gift"]));
                                      $readProduct = $product->fetch();
                                      echo $readProduct["name"];
                                    ?>
                                  <?php else: ?>
                                    <?php echo $readGiftHistory["gift"]; ?> Rivalet
                                  <?php endif; ?>
                                </td>
                                <td><?php echo convertTime($readGiftHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Bu kullanıcıya ait hediye geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-chest-history" role="tabpanel" aria-labelledby="nav-chest-history-tab">
                    <?php
                      $chestsHistory = $db->prepare("SELECT CH.*, P.name as productName, S.name as serverName FROM ChestsHistory CH INNER JOIN Chests C ON CH.chestID = C.id INNER JOIN Products P ON C.productID = P.id INNER JOIN Servers S ON P.serverID = S.id WHERE CH.accountID = ? ORDER BY CH.id DESC LIMIT 50");
                      $chestsHistory->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($chestsHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($chestsHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-sm table-nowrap card-table">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Ürün</th>
                              <th>Sunucu</th>
                              <th class="text-center">İşlem</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($chestsHistory as $readChestsHistory): ?>
                              <tr>
                                <td class="text-center">
                                  #<?php echo $readChestsHistory["id"]; ?>
                                </td>
                                <td><?php echo $readChestsHistory["productName"]; ?></td>
                                <td><?php echo $readChestsHistory["serverName"]; ?></td>
                                <td class="text-center">
                                  <?php if ($readChestsHistory["type"] == 1): ?>
                                    <i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Teslim"></i>
                                  <?php elseif ($readChestsHistory["type"] == 2): ?>
                                    <i class="fa fa-gift" data-toggle="tooltip" data-placement="top" title="Hediye (Gönderen)"></i>
                                  <?php elseif ($readChestsHistory["type"] == 3): ?>
                                    <i class="fa fa-gift" data-toggle="tooltip" data-placement="top" title="Hediye (Alan)"></i>
                                  <?php else: ?>
                                    <i class="fa fa-check"></i>
                                  <?php endif; ?>
                                </td>
                                <td><?php echo convertTime($readChestsHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Bu kullanıcıya ait sandık geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="col-md-12"><?php echo alertError("Bu sayfaya ait veri bulunamadı!") ?></div>
        <?php endif; ?>
      </div>
    </div>
  <?php elseif (get("action") == 'delete' && get("id")): ?>
    <?php
      if ($readAdmin["id"] == get("id")) {
        go('/yonetim-paneli/hata/101');
      }
      else {
        if ($readAdmin["permission"] != 1) {
          go('/yonetim-paneli/hata/001');
        }
        else {
          $deleteAccount = $db->prepare("DELETE FROM Accounts WHERE id = ?");
          $deleteAccount->execute(array(get("id")));
          go("/yonetim-paneli/hesap");
        }
      }
    ?>
  <?php else: ?>
    <?php go('/404'); ?>
  <?php endif; ?>
<?php elseif (get("target") == 'authorized'): ?>
  <?php if (get("action") == 'getAll'): ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="header">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="header-title">Yetkili Hesaplar</h2>
                </div>
                <div class="col-auto">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/yonetim-paneli">Riva | Yönetici Paneli</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Yetkili Hesaplar</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php
            $accounts = $db->prepare("SELECT * FROM Accounts WHERE permission IN (?, ?, ?, ?, ?, ?)");
            $accounts->execute(array(1, 2, 3, 4, 5, 6));
          ?>
          <?php if ($accounts->rowCount() > 0): ?>
            <div class="card" data-toggle="lists" data-lists-values='["accountID", "accountRealname", "accountEmail", "accountCredit", "accountPermission", "accountLastLogin", "accountCreationDate"]'>
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col">
                    <div class="row align-items-center">
                      <div class="col-auto pr-0">
                        <span class="fe fe-search text-muted"></span>
                      </div>
                      <div class="col">
                        <input type="search" class="form-control form-control-flush search" name="search" placeholder="Arama Yap">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="loader" class="card-body p-0 is-loading">
                <div id="spinner">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">-/-</span>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-sm table-nowrap card-table">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 40px;">
                          <a href="#" class="text-muted sort" data-sort="accountID">
                            #ID
                          </a>
                        </th>
                        <th>
                          <a href="#" class="text-muted sort" data-sort="accountRealname">
                            Kullanıcı Adı
                          </a>
                        </th>
                        <th>
                          <a href="#" class="text-muted sort" data-sort="accountEmail">
                          E-Posta
                          </a>
                        </th>
                        <th>
                          <a href="#" class="text-muted sort" data-sort="accountCredit">
                            Rivalet
                          </a>
                        </th>
                        <th>
                          <a href="#" class="text-muted sort" data-sort="accountPermission">
                            Yetki
                          </a>
                        </th>
                        <th>
                          <a href="#" class="text-muted sort" data-sort="accountLastLogin">
                            Son Giriş
                          </a>
                        </th>
                        <th>
                          <a href="#" class="text-muted sort" data-sort="accountCreationDate">
                            Tarih
                          </a>
                        </th>
                        <th class="text-right">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php foreach ($accounts as $readAccounts): ?>
                        <tr>
                          <td class="accountID text-center" style="width: 40px;">
                            <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readAccounts["id"]; ?>">
                              #<?php echo $readAccounts["id"]; ?>
                            </a>
                          </td>
                          <td class="accountRealname">
                            <a href="/yonetim-paneli/hesap/goruntule/<?php echo $readAccounts["id"]; ?>">
                              <?php echo $readAccounts["realname"]; ?>
                            </a>
                          </td>
                          <td class="accountEmail">
                            <?php echo $readAccounts["email"]; ?>
                          </td>
                          <td class="accountCredit">
                            <?php echo $readAccounts["credit"]; ?>
                          </td>
                          <td class="accountPermission">
                            <?php echo permissionTag($readAccounts["permission"]); ?>
                          </td>
                          <td class="accountLastLogin">
                            <?php if ($readAccounts["lastlogin"] == 0): ?>
                              Giriş Yapılmadı
                            <?php else: ?>
                              <?php echo convertTime(date("Y-m-d H:i:s", ($readAccounts["lastlogin"]/1000)), 2, true); ?>
                            <?php endif; ?>
                          </td>
                          <td class="accountCreationDate">
                            <?php echo convertTime($readAccounts["creationDate"], 2, true); ?>
                          </td>
                          <td class="text-right">
                            <a class="btn btn-sm btn-rounded-circle btn-success" href="/yonetim-paneli/hesap/duzenle/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Düzenle">
                              <i class="fe fe-edit-2"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-primary" href="/yonetim-paneli/hesap/goruntule/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Görüntüle">
                              <i class="fe fe-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-warning" href="/yonetim-paneli/engel/ekle/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Engelle">
                              <i class="fe fe-slash"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-secondary" href="/yonetim-paneli/magaza/esya/gonder/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Eşya Gönder">
                              <i class="fe fe-archive"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-info" href="/yonetim-paneli/magaza/kredi/gonder/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Rivalet Gönder">
                              <i class="fe fe-dollar-sign"></i>
                            </a>
                            <a class="btn btn-sm btn-rounded-circle btn-danger clickdelete" href="/yonetim-paneli/hesap/sil/<?php echo $readAccounts["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Sil">
                              <i class="fe fe-trash-2"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php else: ?>
            <?php echo alertError("Bu sayfaya ait veri bulunamadı!"); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php elseif (get("action") == 'delete' && get("id")): ?>
    <?php
      if ($readAdmin["id"] == get("id")) {
        go('/yonetim-paneli/hata/101');
      }
      else {
        if ($readAdmin["permission"] != 1) {
          go('/yonetim-paneli/hata/001');
        }
        else {
          $deleteAccount = $db->prepare("DELETE FROM Accounts WHERE id = ?");
          $deleteAccount->execute(array(get("id")));
          go("/yonetim-paneli/hesap/yetkili");
        }
      }
    ?>
  <?php else: ?>
    <?php go('/404'); ?>
  <?php endif; ?>
<?php else: ?>
  <?php go('/404'); ?>
<?php endif; ?>
