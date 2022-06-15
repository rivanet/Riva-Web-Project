<?php
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
  require_once(__ROOT__."/apps/main/private/config/settings.php");
  if (isset($_SESSION["login"])) {
    if (post("chestID") != null) {
      $chest = $db->prepare("SELECT id, productID FROM Chests WHERE id = ? AND accountID = ? AND isLocked = ? AND status = ?");
      $chest->execute(array(post("chestID"), $readAccount["id"], 0, 0));
      $readChest = $chest->fetch();
      if ($chest->rowCount() > 0) {
        $product = $db->prepare("SELECT P.*, S.ip as serverIP, S.consoleID, S.consolePort, S.consolePassword, S.name as serverName FROM Products P INNER JOIN Servers S ON P.serverID = S.id WHERE P.id = ?");
        $product->execute(array($readChest["productID"]));
        $readProduct = $product->fetch();

        if ($product->rowCount() > 0) {
          $consoleIP = $readProduct["serverIP"];
          $consoleID = $readProduct["consoleID"];
          $consolePort = $readProduct["consolePort"];
          $consolePassword = $readProduct["consolePassword"];
          $consoleTimeout = 3;

          if ($consoleID == 1) {
            require_once(__ROOT__."/apps/main/private/packages/class/websend/websend.php");
            $console = new Websend($consoleIP, $consolePort);
            $console->password = $consolePassword;
          }
          else if ($consoleID == 2) {
            require_once(__ROOT__."/apps/main/private/packages/class/rcon/rcon.php");
            $console = new Rcon($consoleIP, $consolePort, $consolePassword, $consoleTimeout);
          }
          else if ($consoleID == 3) {
            require_once(__ROOT__."/apps/dashboard/private/packages/class/websender/websender.php");
            $console = new Websender($consoleIP, $consolePassword, $consolePort);
          }
          else {
            require_once(__ROOT__."/apps/main/private/packages/class/websend/websend.php");
            $console = new Websend($consoleIP, $consolePort);
            $console->password = $consolePassword;
          }

          $lockTheChest = $db->prepare("UPDATE Chests SET isLocked = ? WHERE id = ? AND accountID = ?");
          $lockTheChest->execute(array(1, $readChest["id"], $readAccount["id"]));

          if (@$console->connect()) {
            $updateChest = $db->prepare("UPDATE Chests SET isLocked = ?, status = ? WHERE id = ? AND accountID = ? AND status = ?");
            $updateChest->execute(array(0, 1, $readChest["id"], $readAccount["id"], 0));

            $insertChestHistory = $db->prepare("INSERT INTO ChestsHistory (accountID, chestID, type, creationDate) VALUES (?, ?, ?, ?)");
            $insertChestHistory->execute(array($readAccount["id"], $readChest["id"], 1, date("Y-m-d H:i:s")));

            $productCommands = $db->prepare("SELECT PC.command FROM ProductCommands PC INNER JOIN Products P ON PC.productID = P.id WHERE PC.productID = ?");
            $productCommands->execute(array($readProduct["id"]));
            foreach ($productCommands as $readProductCommands) {
              $console->sendCommand(str_replace("%username%", $readAccount["realname"], $readProductCommands["command"]));
            }
            $console->disconnect();
            die("successful");
          }
          else {
            $unlockTheChest = $db->prepare("UPDATE Chests SET isLocked = ? WHERE id = ? AND accountID = ?");
            $unlockTheChest->execute(array(0, $readChest["id"], $readAccount["id"]));
            die("error_connection");
          }
        }
        else {
          die("error");
        }
      }
      else {
        die("error");
      }
    }
    else {
      die("error");
    }
  }
  else {
    die("error_login");
  }
?>
