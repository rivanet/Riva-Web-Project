<?php
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
  require_once(__ROOT__."/apps/main/private/config/settings.php");
  
  function getIPAdd() {
      if(getenv("HTTP_CLIENT_IP"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if(getenv("HTTP_X_FORWARDED_FOR")){
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')){
				$tmp = explode (',', $ip); $ip = trim($tmp[0]);
			}}
		else
			$ip = getenv("REMOTE_ADDR");
		return $ip;
  }
  
  if (isset($_SESSION["login"])) {
    require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
    $csrf = new CSRF('csrf-sessions', 'csrf-token');
    if (isset($_POST["chargeCredit"]) && post("paymentID") && post("price")) {
      if ($csrf->validate('chargeCredit')) {
        if (is_numeric(post("price")) &&
            post("price") > 0 &&
            (post("price") >= $readSettings["minPay"] && post("price") <= $readSettings["maxPay"]) &&
            ($readAccount["email"] != "your@email.com" && $readAccount["email"] != "guncelle@gmail.com") &&
            (post("firstName") && post("lastName") && post("phoneNumber"))
        ) {
          $checkAccountContactInfo = $db->prepare("SELECT * FROM AccountContactInfo WHERE accountID = ?");
          $checkAccountContactInfo->execute(array($readAccount["id"]));

          if ($checkAccountContactInfo->rowCount() > 0) {
            $checkAccountContactInfo = $checkAccountContactInfo->fetch();
            foreach ($checkAccountContactInfo as $key => $value) {
              if ($key != "accountID") {
                $updateAccountContactInfo = $db->prepare("UPDATE AccountContactInfo SET $key = :$key WHERE accountID = :accountID AND $key != :$key");
                $updateAccountContactInfo->execute(array(":accountID" => $readAccount["id"], ":$key" => post($key)));
              }
            }
          }
          else {
            $insertAccountContactInfo = $db->prepare("INSERT INTO AccountContactInfo (accountID, firstName, lastName, phoneNumber) VALUES (?, ?, ?, ?)");
            $insertAccountContactInfo->execute(array($readAccount["id"], post("firstName"), post("lastName"), post("phoneNumber")));
          }

          $accountContactInfo = $db->prepare("SELECT * FROM AccountContactInfo WHERE accountID = ?");
          $accountContactInfo->execute(array($readAccount["id"]));
          $readAccountContactInfo = $accountContactInfo->fetch();
          $accountFullName = sprintf("%s %s", $readAccountContactInfo["firstName"], $readAccountContactInfo["lastName"]);
          $accountFirstName = $readAccountContactInfo["firstName"];
          $accountLastName = $readAccountContactInfo["lastName"];
          $accountPhoneNumber = $readAccountContactInfo["phoneNumber"];

          $payment = $db->prepare("SELECT P.*, PS.slug as apiSlug, PS.variables FROM Payment P INNER JOIN PaymentSettings PS ON P.apiID = PS.slug WHERE PS.status = ? AND P.id = ?");
          $payment->execute(array(1, post("paymentID")));
          $readPayment = $payment->fetch();
          if ($payment->rowCount() > 0) {
            require_once(__ROOT__."/apps/main/private/packages/class/curlpost/curlpost.php");
            $siteURL = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["SERVER_NAME"]);
            $readVariables = json_decode($readPayment["variables"], true);
            if ($readPayment["apiSlug"] == "batihost") {
              $postFields = array(
                'oyuncu'          => $readAccount["id"],
                'amount'          => post("price"),
                'vipname'         => post("price").' Rivalet',
                'batihostid'      => $readVariables["batihostID"],
                'raporemail'      => $readVariables["batihostEmail"],
                'odemeolduurl'    => $siteURL.'/kredi/yukle/basarili',
                'odemeolmadiurl'  => $siteURL.'/kredi/yukle/basarisiz',
                'posturl'         => $siteURL.'/islem/batihost/'.(($readPayment["type"] == 1) ? 'mobil' : (($readPayment["type"] == 2) ? 'kredi-karti' : 'mobil'))
              );
              if ($readPayment["type"] == 1) {
                $curlURL = 'https://batigame.com/vipgateway/viprec.php';
              }
              else if ($readPayment["type"] == 2) {
                $curlURL = 'https://batihost.com/vipgateway/viprec.php';
                $postFields = array_merge($postFields, array(
                  'odemeturu' => 'kredikarti'
                ));
              }
              else {
                $curlURL = 'https://batigame.com/vipgateway/viprec.php';
              }
              $curl = new \RIVADEV\Http\CurlPost($curlURL);
              try {
                echo $curl($postFields);
              } catch (\RuntimeException $ex) {
                  die(sprintf('HTTP hatası: %s Kod: %d', $ex->getMessage(), $ex->getCode()));
              }
            }
            else if ($readPayment["apiSlug"] == "paywant") {
              $hash = base64_encode(hash_hmac('sha256', $readAccount["realname"].'|'.$readAccount["email"].'|'.$readAccount["id"].$readVariables['paywantAPIKey'], $readVariables['paywantAPISecretKey'], true));
              $curlURL = 'https://secure.paywant.com/gateway';
              $postFields = array(
                'proApi'        => true,
                'apiKey'        => $readVariables["paywantAPIKey"],
                'hash'          => $hash,
                'userID'        => $readAccount["id"],
                'returnData'    => $readAccount["realname"],
                'userEmail'     => $readAccount["email"],
                'userIPAddress' => getIPAdd(),
                'productData'   => array(
                  'name'            => post("price").' RV Rivalet',
                  'amount'          => post("price")*100,
                  "extraData"       => post("price"),
                  'paymentChannel'  => (string)$readPayment["type"],
                  'commissionType'  => (int)$readVariables["paywantCommissionType"]
                )
              );
              $curl = new \RIVADEV\Http\CurlPost($curlURL);
              try {
                $result = json_decode($curl($postFields), true);
                if ($result["status"] == true) {
					$_SESSION["PAYWANT_URL"] = $result["message"];
                   go("/odeme/paywant");
				  
				
                  //go($result["message"]);
                }
                else {
                  if ($readSettings["debugModeStatus"] == 1) {
                    print_r($result);
                  }
                  else {
                    go("/kredi/yukle");
                  }
                }
              } catch (\RuntimeException $ex) {
                  die(sprintf('HTTP hatası: %s Kod: %d', $ex->getMessage(), $ex->getCode()));
              }
            }
            else if ($readPayment["apiSlug"] == "rabisu") {
              $curlURL = 'https://odeme.rabisu.com/odeme.php';
              $postFields = array(
                'oyuncu_adi'      => $readAccount["id"],
                'fiyat'           => post("price"),
                'urun_adi'        => post("price").' Rivalet',
                'bayi_id'         => $readVariables["rabisuID"],
                'yontem'          => (($readPayment["type"] == 1) ? 'mobil' : (($readPayment["type"] == 2) ? 'kart' : 'mobil')),
                'basarili_url'    => $siteURL.'/kredi/yukle/basarili',
                'basarisiz_url'   => $siteURL.'/kredi/yukle/basarisiz',
                'post_url'        => $siteURL.'/islem/rabisu/'.(($readPayment["type"] == 1) ? 'mobil' : (($readPayment["type"] == 2) ? 'kredi-karti' : 'mobil'))
              );
              $curl = new \RIVADEV\Http\CurlPost($curlURL);
              try {
                echo $curl($postFields);
              } catch (\RuntimeException $ex) {
                  die(sprintf('HTTP hatası: %s Kod: %d', $ex->getMessage(), $ex->getCode()));
              }
            }
            else if ($readPayment["apiSlug"] == "shopier") {
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Enums/Currency.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Enums/Language.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Enums/ProductType.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Enums/WebsiteIndex.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Exceptions/NotRendererClassException.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Exceptions/RendererClassNotFoundException.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Exceptions/RequiredParameterException.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Models/BaseModel.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Models/Address.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Models/BillingAddress.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Models/Buyer.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Models/ShippingAddress.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Models/ShopierParams.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Models/ShopierResponse.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Renderers/AbstractRenderer.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Renderers/FormRenderer.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Renderers/AutoSubmitFormRenderer.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Renderers/ButtonRenderer.php");
              require_once(__ROOT__."/apps/main/private/packages/api/shopier/Shopier.php");

              $shopier = new \Shopier\Shopier($readVariables['shopierAPIKey'], $readVariables['shopierAPISecretKey']);

              // Satın alan kişi bilgileri
              $buyer = new \Shopier\Models\Buyer([
                'id'      => $readAccount["id"],
                'name'    => $accountFirstName,
                'surname' => $accountLastName,
                'email'   => $readAccount["email"],
                'phone'   => $accountPhoneNumber
              ]);

              // Fatura ve kargo adresi birlikte tanımlama
              // Ayrı ayrı da tanımlanabilir
              $address = new \Shopier\Models\Address([
                'address'   => 'Esentepe Mahallesi Eski Büyükdere Caddesi, Tekfen Tower No:209, 34343 4.Levent/Şişli',
                'city'      => 'İstanbul',
                'country'   => 'Türkiye',
                'postcode'  => '34343',
              ]);

              // shopier parametrelerini al
              $params = $shopier->getParams();

              // Geri dönüş sitesini ayarla
              $params->setWebsiteIndex(\Shopier\Enums\WebsiteIndex::SITE_1);

              // Satın alan kişi bilgisini ekle
              $params->setBuyer($buyer);

              // Fatura ve kargo adresini aynı şekilde ekle
              $params->setAddress($address);

              // Sipariş numarası ve sipariş tutarını ekle
              $extraData = $readAccount["id"].'_'.post("price");
              $params->setOrderData($extraData, post("price"));

              // Sipariş edilen ürünü ekle
              $productName = "$serverName Kredi";
              $params->setProductData($productName, \Shopier\Enums\ProductType::DOWNLOADABLE_VIRTUAL);

              try {
                $renderer = $shopier->createRenderer(\Shopier\Renderers\AutoSubmitFormRenderer::class);
                $shopier->goWith($renderer);
              } catch (\Shopier\Exceptions\RequiredParameterException $e) {
                // die('Zorunlu parametrelerden bir ve daha fazlası eksik!');
                go("/kredi/yukle");
              } catch (\Shopier\Exceptions\NotRendererClassException $e) {
                // die('$shopier->createRenderer(...) metodunda verilen class adı AbstractRenderer sınıfından türetilmemiş!');
                go("/kredi/yukle");
              } catch (\Shopier\Exceptions\RendererClassNotFoundException $e) {
                // die('$shopier->createRenderer(...) metodunda verilen class bulunamadı!');
                go("/kredi/yukle");
              }
            }
            else if ($readPayment["apiSlug"] == "keyubu") {
              $curlURL = 'https://musteri.keyubu.com/gateway/odeme.php';
              $postFields = array(
                'odemeID'   => $readVariables["keyubuID"],
                'user_ip'   => getIP(),
                'amount'    => post("price"),
                'return_id' => $readAccount["id"],
                'method'    => (($readPayment["type"] == 1) ? 2 : (($readPayment["type"] == 2) ? 1 : 2)),
                'callback'  => '/islem/keyubu/'.(($readPayment["type"] == 1) ? 'mobil' : (($readPayment["type"] == 2) ? 'kredi-karti' : 'mobil'))
              );
              $curl = new \RIVADEV\Http\CurlPost($curlURL);
              try {
                $result = json_decode($curl($postFields), true);
                if ($result["status"] == 'success') {
                  go('https://musteri.keyubu.com/gateway/odeme.php?token='.$result["token"]);
                }
                else {
                  if ($readSettings["debugModeStatus"] == 1) {
                    print_r($result);
                  }
                  else {
                    go("/kredi/yukle");
                  }
                }
              } catch (\RuntimeException $ex) {
                  die(sprintf('HTTP hatası: %s Kod: %d', $ex->getMessage(), $ex->getCode()));
              }
            }
            else if ($readPayment["apiSlug"] == "ininal") {
              go("/odeme/ininal");
            }
            else if ($readPayment["apiSlug"] == "papara") {
              go("/odeme/papara");
            }
            else if ($readPayment["apiSlug"] == "shipy") {
              $postFields = array(
                'usrIp'       => getIP(),
                'usrEmail'    => $readAccount["email"],
                'usrName'     => $accountFullName,
                'usrAddress'  => 'Esentepe Mahallesi Eski Büyükdere Caddesi, Tekfen Tower No:209, 34343 4.Levent/Şişli',
                'usrPhone'    => $accountPhoneNumber,
                'apiKey'      => $readVariables["shipyAPIKey"],
                'amount'      => post("price"),
                'returnID'    => $readAccount["id"].'_'.post("price"),
                'currency'    => 'TRY',
                'pageLang'    => 'TR',
                'mailLang'    => 'TR',
                'installment' => 0
              );
              if ($readPayment["type"] == 1) {
                $curlURL = 'https://api.shipy.dev/pay/mobile';
              }
              else if ($readPayment["type"] == 2) {
                $curlURL = 'https://api.shipy.dev/pay/credit_card';
              }
              else if ($readPayment["type"] == 3) {
                $curlURL = 'https://api.shipy.dev/pay/eft';
              }
              else {
                $curlURL = 'https://api.shipy.dev/pay/mobile';
              }
              $curl = new \RIVADEV\Http\CurlPost($curlURL);
              try {
                if ($readPayment["type"] == 1) {
                  echo $curl($postFields);
                }
                else {
                  $result = json_decode($curl($postFields), true);
                  if ($result["status"] == "success") {
                    go($result["link"]);
                  }
                  else {
                    if ($readSettings["debugModeStatus"] == 1) {
                      print_r($result);
                    }
                    else {
                      go("/kredi/yukle");
                    }
                  }
                }
              } catch (\RuntimeException $ex) {
                  die(sprintf('HTTP hatası: %s Kod: %d', $ex->getMessage(), $ex->getCode()));
              }
            }
            else if ($readPayment["apiSlug"] == "eft") {
              go("/odeme/eft");
            }
            else if ($readPayment["apiSlug"] == "paytr") {
              $paymentAmount = post("price") * 100;
              $noInstallment = 0;
              $maxInstallment = 0;
              $timeoutLimit = "30";
              $currency = "Rivalet";
              $debugStatus = 0;
              $testModeStatus = 0;
              $orderID = $readAccount["id"].'i'.post("price").'i'.rand(100000, 999999);
              $products = base64_encode(json_encode(array(
                array(substr($readAccount["realname"]." Kredi Yukleme", 0, 50), post("price"), 1),
              )));
              $paytrHash 	= $readVariables["paytrID"].getIP().$orderID.$readAccount["email"].$paymentAmount.$products.$noInstallment.$maxInstallment.$currency.$testModeStatus;
              $paytrToken = base64_encode(hash_hmac('SHA256', $paytrHash.$readVariables["paytrAPISecretKey"], $readVariables["paytrAPIKey"], true));
              $curlURL = 'https://www.paytr.com/odeme/api/get-token';
              $postFields = array(
                'merchant_id'				=> $readVariables["paytrID"],
                'merchant_oid' 			=> $orderID,
                'payment_amount'		=> $paymentAmount,
                'paytr_token'				=> $paytrToken,
                'user_basket'				=> $products,
                'no_installment'		=> $noInstallment,
                'max_installment'		=> $maxInstallment,
                'email'							=> $readAccount["email"],
                'user_name'					=> $accountFullName,
                'user_address'			=> "Esentepe Mahallesi Eski Büyükdere Caddesi, Tekfen Tower No:209, 34343 4.Levent/Şişli",
                'user_phone'				=> $accountPhoneNumber,
                'user_ip' 					=> getIP(),
                'merchant_ok_url'		=> $siteURL.'/kredi/yukle/basarili',
                'merchant_fail_url'	=> $siteURL.'/kredi/yukle/basarisiz',
                'timeout_limit'			=> $timeoutLimit,
                'currency'					=> $currency,
                'debug_on'					=> $debugStatus,
                'test_mode'					=> $testModeStatus
              );
              $curl = new \RIVADEV\Http\CurlPost($curlURL);
              try {
                $result = json_decode($curl($postFields), true);
                if ($result["status"] == 'success') {
                  $_SESSION["PAYTR_IFRAME_TOKEN"] = $result["token"];
                  go("/odeme/paytr");
                }
                else {
                  if ($readSettings["debugModeStatus"] == 1) {
                    print_r($result);
                  }
                  else {
                    go("/kredi/yukle");
                  }
                }
              } catch (\RuntimeException $ex) {
                die(sprintf('HTTP hatası: %s Kod: %d', $ex->getMessage(), $ex->getCode()));
              }
            }
            else if ($readPayment["apiSlug"] == "slimmweb") {
              go('https://musteri.slimmweb.com/pay/odeme.php?odemeID='.$readVariables["slimmwebPaymentID"].'&amount='.post("price").'&return_id='.$readAccount["id"].'_'.post("price").'_'.generateSalt(12));
            }
            else if ($readPayment["apiSlug"] == "paylith") {
              $conversationId = $readAccount["id"].'_'.post("price");
              $hashStr = [
                  'apiKey' => $readVariables["paylithAPIKey"],
                  'conversationId' => $conversationId,
                  'userId' => $readAccount["id"],
                  'userEmail' => $readAccount["email"],
                  'userIpAddress' => getIP(),
              ];
              ksort($hashStr);
              $hash = hash_hmac('sha256', implode('|', $hashStr) . $readVariables["paylithAPISecretKey"], $readVariables["paylithAPIKey"]);
              $paylithToken = hash_hmac('md5', $hash, $readVariables["paylithAPIKey"]);
              $curlURL = "https://api.paylith.com/v1/token";
              $postFields = array(
                "apiKey" => $readVariables["paylithAPIKey"],
                "conversationId" => $conversationId, // Ödeme eşleştirmesi için kullanılır.
                "productApi" => true,

                // Ödeme yapılacak ürün bilgisi
                "productData" => array(
                  "name" => post("price").' Rivalet', // Ödeme yapılacak ürünün adı
                  "amount" => post("price")*100 // Ödeme yapılacak ürünün fiyatı * 100
                ),
                "token" => $paylithToken,
                "userEmail" => $readAccount["email"], // Üye işyeri tarafındaki kullanıcıya ait e-posta adresi.
                "userId" => $readAccount["id"], // Üye işyeri tarafındakı kullanıcıya ait ID.
                "userIpAddress" => getIP(), // Üye işyeri tarafındakı kullanıcının ip adresi.
                "userPhone" => $accountPhoneNumber, // Üye işyeri tarafındakı kullanıcının telefon numarası.
                "redirectUrl" => $siteURL.'/kredi/yukle/basarili'
              );
              $curl = new \RIVADEV\Http\CurlPost($curlURL);
              try {
                $result = json_decode($curl($postFields), true);
                if ($result["status"] == "success") {
                  go($result["paymentLink"]);
                }
                else {
                  if ($readSettings["debugModeStatus"] == 1) {
                    print_r($result);
                  }
                  else {
                    go("/kredi/yukle");
                  }
                }
              } catch (\RuntimeException $ex) {
                  die(sprintf('HTTP hatası: %s Kod: %d', $ex->getMessage(), $ex->getCode()));
              }
            }
            else {
              go("/kredi/yukle");
            }
          }
          else {
            go("/kredi/yukle");
          }
        }
        else {
          go("/kredi/yukle");
        }
      }
      else {
        echo goDelay("/kredi/yukle", 3);
        die('Sistemsel bir sorun oluştu. Kredi Yükleme sayfasına yönlendiriliyorsunuz...');
      }
    }
    else {
      go("/kredi/yukle");
    }
  }
  else {
    go("/giris-yap");
  }
?>
