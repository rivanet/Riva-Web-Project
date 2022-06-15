<?php
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
  require_once(__ROOT__."/apps/main/private/config/settings.php");
  require_once(__ROOT__."/apps/main/private/packages/class/webhook/webhook.php");

  if ($_POST) {
    if (post("appKey") == APP_KEY) {
      if (post("type") == "credit") {
        if (isset($_POST["username"]) && isset($_POST["credit"]) && isset($_POST["earnings"])) {
          $username = post("username");
          $credit = post("credit");
          $earnings = post("earnings");
          $search = array("%username%", "%credit%", "%money%");
          $replace = array($username, $credit, $earnings);
          $webhookMessage = $readSettings["webhookCreditMessage"];
          $webhookEmbed = $readSettings["webhookCreditEmbed"];
          $postFields = (array(
            'content'     => ($webhookMessage != '0') ? str_replace($search, $replace, $webhookMessage) : null,
            'avatar_url'  => 'https://minotar.net/avatar/'.$username.'/256.png',
            'tts'         => false,
            'embeds'      => array(
              array(
                'type'        => 'rich',
                'title'       => $readSettings["webhookCreditTitle"],
                'color'       => hexdec($readSettings["webhookCreditColor"]),
                'description' => str_replace($search, $replace, $webhookEmbed),
                'image'       => array(
                  'url' => ($readSettings["webhookCreditImage"] != '0') ? $readSettings["webhookCreditImage"] : null
                ),
                'footer'      =>
                ($readSettings["webhookCreditAdStatus"] == 1) ? array(
                  'text'      => 'Powered by RIVADEV',
                  'icon_url'  => 'https://www.hizliresim.com/2yre1cb'
                ) : array()
              )
            )
          ));
          $curl = new \RIVADEV\Http\Webhook($readSettings["webhookCreditURL"]);
          $curl(json_encode($postFields, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
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
