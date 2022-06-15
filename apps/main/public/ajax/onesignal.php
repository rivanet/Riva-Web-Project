<?php
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
  require_once(__ROOT__."/apps/main/private/config/settings.php");
  require_once(__ROOT__."/apps/main/private/packages/class/onesignal/onesignal.php");

  if ($_POST) {
    if (post("appKey") == APP_KEY) {
      if (post("type") == "credit") {
        if (isset($_POST["username"]) && isset($_POST["credit"]) && isset($_POST["earnings"])) {
          $username = post("username");
          $credit = post("credit");
          $earnings = post("earnings");
          $adminAccounts = $db->prepare("SELECT AOSI.oneSignalID FROM Accounts A INNER JOIN AccountOneSignalInfo AOSI ON A.id = AOSI.accountID WHERE A.permission = ?");
          $adminAccounts->execute(array(1));
          if ($adminAccounts->rowCount() > 0) {
            $oneSignalIDList = array();
            foreach ($adminAccounts as $readAdminAccounts) {
              array_push($oneSignalIDList, $readAdminAccounts["oneSignalID"]);
            }
            $oneSignal = new OneSignal($readSettings["oneSignalAppID"], $readSettings["oneSignalAPIKey"], $oneSignalIDList);
            $oneSignal->sendMessage('Riva Network Bildirim', $username.' adlı kullanıcı '.$credit.' ('.$earnings.' RV) Rivalet yükledi.', '/yonetim-paneli/magaza/kredi-gecmisi');
          }
        }
        else {
          die("Gerekli degerler gelmedi!");
        }
      }
      else {
        die("Gecersiz webhook tipi girildi!");
      }
    }
    else {
      die("Guvenlik saglanamadi!");
    }
  }
  else {
    die("POST verisi bulunamadi!");
  }

?>
