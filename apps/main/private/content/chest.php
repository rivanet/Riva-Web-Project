<?php
  if (!isset($_SESSION["login"])) {
    go("/giris-yap");
  }
  require_once(__ROOT__.'/apps/main/private/packages/class/extraresources/extraresources.php');
  $extraResourcesJS = new ExtraResources('js');
  $extraResourcesJS->addResource('/apps/main/public/assets/js/chest.js');
?>
  <!-- main hero end -->
  <div class="gap"></div>
            <?php if (get("target") == 'chest'): ?>
              <?php if (get("action") == 'getAll'): ?>
              <?php elseif (get("action") == 'gift'): ?>
                <li class="breadcrumb-item active" aria-current="page">Hediye Gönder</li>
              <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page">Hata!</li>
              <?php endif; ?>
            <?php else: ?>
              <li class="breadcrumb-item active" aria-current="page">Hata!</li>
            <?php endif; ?>
          </ol>
        </nav>
      </div>
 <div class="profile-page-wrapper">
    <div class="container">
      <div class="profile-card-wrapper">
        <div class="profile-card no-pad">
            <div class="card-header center">
            <div class="left">
              <h2>Sandığım (<?php echo $chestCount; ?>)</h2>
            </div>
			</div>
        <?php if (get("target") == 'chest'): ?>
          <?php if (get("action") == 'getAll'): ?>
            <?php
              $chests = $db->prepare("SELECT C.*, P.name as productName, S.name as serverName FROM Chests C INNER JOIN Products P ON C.productID = P.id INNER JOIN Servers S ON P.serverID = S.id WHERE C.accountID = ? AND C.status = ? ORDER BY C.id DESC");
              $chests->execute(array($readAccount["id"], 0));
            ?>
            <?php if ($chests->rowCount() > 0): ?>
      <div class="profile-card-wrapper">
			
              <div class="card-content">
              <div class="profile-table  table-2">
              <table>
                <thead>
                  <tr>
                    <th class="text-center" style="width: 40px;">#ID</th>
                    <th>Ürün</th>
                    <th class="text-right" style="width: 40px;">Tarih</th>
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
                              <?php echo convertTime($readChests["creationDate"], 2, true); ?>
                            </td>
                            <td class="text-right">
                              <button type="button" class="action-btn blue" data-chest="<?php echo $readChests["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Teslim Al">
<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 27.91 27.91">
                          <g id="Send" transform="translate(0.757 0.766)">
                            <path id="Path_110" data-name="Path 110"
                              d="M18.812,7.586l-8.39,8.48L.879,10.1a1.874,1.874,0,0,1,.464-3.384L24,.077a1.867,1.867,0,0,1,2.308,2.33L19.6,25.048a1.861,1.861,0,0,1-3.372.452l-5.816-9.433"
                              transform="translate(0 0)" fill="none" stroke="#379bff" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                          </g>
                        </svg>
                              </button>
                              <?php if ($readSettings["giftStatus"] == 1): ?>
                                <a class="action-btn blue" href="/sandik/hediye/<?php echo $readChests["id"]; ?>" data-toggle="tooltip" data-placement="top" title="Hediye Et">
      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 26.168 27.718">
                          <g id="Group_175" data-name="Group 175" transform="translate(0 0.5)">
                            <g id="Group_174" data-name="Group 174" transform="translate(4.221 0)">
                              <path id="Path_105" data-name="Path 105"
                                d="M16.363,9.331h-5.7a3.166,3.166,0,1,1,0-6.331C15.1,3,16.363,9.331,16.363,9.331Z"
                                transform="translate(-7.5 -3)" fill="none" stroke="#fff" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="1" />
                              <path id="Path_106" data-name="Path 106"
                                d="M18,9.331h5.7A3.166,3.166,0,1,0,23.7,3C19.266,3,18,9.331,18,9.331Z"
                                transform="translate(-9.137 -3)" fill="none" stroke="#fff" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="1" />
                            </g>
                            <g id="Rectangle_26" data-name="Rectangle 26" transform="translate(2.532 14.556)"
                              fill="none" stroke="#fff" stroke-width="1">
                              <path d="M0,0H21.1a0,0,0,0,1,0,0V8.662a4,4,0,0,1-4,4H4a4,4,0,0,1-4-4V0A0,0,0,0,1,0,0Z"
                                stroke="none" />
                              <path
                                d="M1,.5H20.1a.5.5,0,0,1,.5.5V8.662a3.5,3.5,0,0,1-3.5,3.5H4a3.5,3.5,0,0,1-3.5-3.5V1A.5.5,0,0,1,1,.5Z"
                                fill="none" />
                            </g>
                            <g id="Rectangle_27" data-name="Rectangle 27" transform="translate(0 6.115)" fill="none"
                              stroke="#fff" stroke-width="1">
                              <path d="M4,0H22.168a4,4,0,0,1,4,4V9.286a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V4A4,4,0,0,1,4,0Z"
                                stroke="none" />
                              <path
                                d="M4,.5H22.168a3.5,3.5,0,0,1,3.5,3.5V8.286a.5.5,0,0,1-.5.5H1a.5.5,0,0,1-.5-.5V4A3.5,3.5,0,0,1,4,.5Z"
                                fill="none" />
                            </g>
                          </g>
                        </svg>
                                </a>
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
              <?php echo alertError("Sandığınızda herhangi bir ürün bulunamadı!"); ?>
            <?php endif; ?>
          <?php elseif (get("action") == 'gift' && $readSettings["giftStatus"] == 1): ?>
            <?php
              $chest = $db->prepare("SELECT C.*, P.name as productName FROM Chests C INNER JOIN Products P ON C.productID = P.id WHERE C.accountID = ? AND C.id = ? AND C.status = ?");
              $chest->execute(array($readAccount["id"], get("id"), 0));
              $readChest = $chest->fetch();
            ?>
            <?php if ($chest->rowCount() > 0): ?>
              <?php
                require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
                $csrf = new CSRF('csrf-sessions', 'csrf-token');
                if (isset($_POST["sendGift"])) {
                  if (!$csrf->validate('sendGift')) {
                    echo alertError("Sistemsel bir sorun oluştu!");
                  }
                  else if (post("username") == null) {
                    echo alertError("Lütfen boş alan bırakmayınız!");
                  }
                  //else if ($readAccount["realname"] == post("username")) {
                  else if (strtolower($readAccount["realname"]) == strtolower(post("username"))) {
                    echo alertError("Kendine hediye gönderemezsiniz!");
                  }
                  else {
                    $checkAccount = $db->prepare("SELECT id FROM Accounts WHERE realname = ?");
                    $checkAccount->execute(array(post("username")));
                    $readCheckedAccount = $checkAccount->fetch();
                    if ($checkAccount->rowCount() > 0) {
                      $updateChest = $db->prepare("UPDATE Chests SET accountID = ? WHERE id = ?");
                      $updateChest->execute(array($readCheckedAccount["id"], $readChest["id"]));

                      $insertChestHistory = $db->prepare("INSERT INTO ChestsHistory (accountID, chestID, type, creationDate) VALUES (?, ?, ?, ?)");
                      $insertChestHistory->execute(array($readAccount["id"], $readChest["id"], 2, date("Y-m-d H:i:s")));
                      $insertChestHistory->execute(array($readCheckedAccount["id"], $readChest["id"], 3, date("Y-m-d H:i:s")));

                      echo alertSuccess("Hediye başarıyla ".post("username")." adlı kullanıcıya gönderilmiştir!");
                    }
                    else {
                      echo alertError("Girmiş olduğunuz oyuncu bulunamadı!");
                    }
                  }
                }
              ?>
              <div class="card">
                <div class="card-header">
                  Hediye Gönder
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="form-group row">
                      <label for="inputProduct" class="col-sm-2 col-form-label">Ürün:</label>
                      <div class="col-sm-10">
                        <input type="text" id="inputProduct" class="form-control-plaintext" value="<?php echo $readChest["productName"]; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputUsername" class="col-sm-2 col-form-label">Kullanıcı Adı:</label>
                      <div class="col-sm-10">
                        <input type="text" id="inputUsername" class="form-control" name="username" placeholder="Hediye göndereceğiniz oyuncunun kullanıcı adını yazınız.">
                        <small>Hediye göndereceğiniz oyuncunun kullanıcı adını yazınız.</small>
                      </div>
                    </div>
                    <?php echo $csrf->input('sendGift'); ?>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="submit" class="btn btn-rounded btn-success" name="sendGift" onclick="return confirm('Hediyeyi bu kişiye göndermek istediğine emin misin?')">Gönder</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <?php else: ?>
              <?php echo alertError("Sandık eşyası bulunamadı!"); ?>
            <?php endif; ?>
          <?php else: ?>
            <?php go("/404"); ?>
          <?php endif; ?>
        <?php else: ?>
          <?php go("/404"); ?>
        <?php endif; ?>
      </div>
            <?php
              $chestsHistory = $db->prepare("SELECT CH.*, P.name as productName FROM ChestsHistory CH INNER JOIN Chests C ON CH.chestID = C.id INNER JOIN Products P ON C.productID = P.id WHERE CH.accountID = ? ORDER BY CH.id DESC LIMIT 5");
              $chestsHistory->execute(array($readAccount["id"]));
            ?>
            <?php if ($chestsHistory->rowCount() > 0): ?>
<div class="profile-card no-pad">
          <div class="card-header center">
            <div class="left">
              <h2>Sandık Geçmişi </h2>
            </div>
          </div>
          <div class="card-content">
            <div class="profile-table  table-2">
              <table>
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Kullanıcı</th>
                    <th class="text-center">Ürün</th>
                    <th class="text-center">İşlem</th>
                  </tr>
                </thead>
                <tbody>
                        <?php foreach ($chestsHistory as $readChestsHistory): ?>
                          <tr>
                            <td class="text-center">
                              <img class="rounded-circle" src="https://minotar.net/avatar/<?php echo $readAccount["realname"]; ?>/40.png" alt="<?php echo $serverName." Oyuncu - ".$readAccount["realname"]; ?>">
                            </td>
                            <td>
                              <?php echo $readAccount["realname"]; ?>
                              <?php echo verifiedCircle($readAccount["permission"]); ?>
                            </td>
                            <td class="text-center"><?php echo $readChestsHistory["productName"]; ?></td>
                            <td class="text-center">
                              <?php if ($readChestsHistory["type"] == 1): ?>
<a class="action-btn no-bg" data-toggle="tooltip" data-placement="top" title="Teslim">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 27.408 27.407">
                          <g id="Send" transform="translate(0.506 0.514)">
                            <path id="Path_110" data-name="Path 110"
                              d="M18.812,7.586l-8.39,8.48L.879,10.1a1.874,1.874,0,0,1,.464-3.384L24,.077a1.867,1.867,0,0,1,2.308,2.33L19.6,25.048a1.861,1.861,0,0,1-3.372.452l-5.816-9.433"
                              transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1" fill-rule="evenodd" />
                          </g>
                        </svg>
                      </a>
                    </td>
                  </tr>
                              <?php elseif ($readChestsHistory["type"] == 2): ?>
<a  class="action-btn no-bg"  data-toggle="tooltip" data-placement="top" title="Hediye (Gönderen)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 26.168 27.718">
                          <g id="Group_175" data-name="Group 175" transform="translate(0 0.5)">
                            <g id="Group_174" data-name="Group 174" transform="translate(4.221 0)">
                              <path id="Path_105" data-name="Path 105"
                                d="M16.363,9.331h-5.7a3.166,3.166,0,1,1,0-6.331C15.1,3,16.363,9.331,16.363,9.331Z"
                                transform="translate(-7.5 -3)" fill="none" stroke="#fff" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="1" />
                              <path id="Path_106" data-name="Path 106"
                                d="M18,9.331h5.7A3.166,3.166,0,1,0,23.7,3C19.266,3,18,9.331,18,9.331Z"
                                transform="translate(-9.137 -3)" fill="none" stroke="#fff" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="1" />
                            </g>
                            <g id="Rectangle_26" data-name="Rectangle 26" transform="translate(2.532 14.556)"
                              fill="none" stroke="#fff" stroke-width="1">
                              <path d="M0,0H21.1a0,0,0,0,1,0,0V8.662a4,4,0,0,1-4,4H4a4,4,0,0,1-4-4V0A0,0,0,0,1,0,0Z"
                                stroke="none" />
                              <path
                                d="M1,.5H20.1a.5.5,0,0,1,.5.5V8.662a3.5,3.5,0,0,1-3.5,3.5H4a3.5,3.5,0,0,1-3.5-3.5V1A.5.5,0,0,1,1,.5Z"
                                fill="none" />
                            </g>
                            <g id="Rectangle_27" data-name="Rectangle 27" transform="translate(0 6.115)" fill="none"
                              stroke="#fff" stroke-width="1">
                              <path d="M4,0H22.168a4,4,0,0,1,4,4V9.286a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V4A4,4,0,0,1,4,0Z"
                                stroke="none" />
                              <path
                                d="M4,.5H22.168a3.5,3.5,0,0,1,3.5,3.5V8.286a.5.5,0,0,1-.5.5H1a.5.5,0,0,1-.5-.5V4A3.5,3.5,0,0,1,4,.5Z"
                                fill="none" />
                            </g>
                          </g>
                        </svg>
                      </a>
                              <?php elseif ($readChestsHistory["type"] == 3): ?>
                                <i class="action-btn no-bg" data-toggle="tooltip" data-placement="top" title="Hediye (Alan)"></i>
                              <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 27.408 27.407">
                          <g id="Send" transform="translate(0.506 0.514)">
                            <path id="Path_110" data-name="Path 110"
                              d="M18.812,7.586l-8.39,8.48L.879,10.1a1.874,1.874,0,0,1,.464-3.384L24,.077a1.867,1.867,0,0,1,2.308,2.33L19.6,25.048a1.861,1.861,0,0,1-3.372.452l-5.816-9.433"
                              transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1" fill-rule="evenodd" />
                          </g>
                        </svg></i>
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
              <?php echo alertError("Sandık geçmişi bulunamadı!"); ?>
            <?php endif; ?>
  <div class="gap"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
