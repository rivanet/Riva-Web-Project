<?php
  if (!get("server")) {
    $firstServer = $db->query("SELECT serverSlug FROM Leaderboards ORDER BY id DESC LIMIT 1");
    $readFirstServer = $firstServer->fetch();
    if ($firstServer->rowCount() > 0) {
      go("/siralama/".$readFirstServer["serverSlug"]);
    }
  }

  require_once(__ROOT__.'/apps/main/private/packages/class/extraresources/extraresources.php');
  $extraResourcesJS = new ExtraResources('js');
  $extraResourcesJS->addResource('/apps/main/public/assets/js/loader.js');
  $extraResourcesJS->addResource('/apps/main/public/assets/js/leaderboards.js');

  $leaderboards = $db->prepare("SELECT * FROM Leaderboards WHERE serverSlug = ?");
  $leaderboards->execute(array(get("server")));
  $readLeaderboards = $leaderboards->fetch();
?>

<div class="games-wrapper">
  <div class="container">
    <div class="section-title">
      <span>Sıralamaları burdan gör</span>
      <b>Sıralamasını Görmek İstediğin Oyunu Seç</b>
    </div>
    <div class="games-list-wrap">
      <?php $leaderboardServers = $db->query("SELECT serverName, serverSlug FROM Leaderboards ORDER BY id DESC"); ?>
      <?php if ($leaderboardServers->rowCount() > 0): ?>
        <?php foreach ($leaderboardServers as $readLeaderboardServers): ?>
          <div class="game-item">
            <div class="detail">
              <div class="name">
                <img src="images/blue-star.svg" alt="">
                <?php echo $readLeaderboardServers["serverName"]; ?>
              </div>
              <a href="/siralama/<?php echo $readLeaderboardServers["serverSlug"]; ?>" class="primary-btn normal-shadow">
                Sırala
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <?php echo alertError("Sunucu bulunamadı!"); ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="standings-wrapper">
  <div class="container">

    <div class="standings-general">
      <div class="standings-content">
      <?php if ($leaderboards->rowCount() > 0): ?>
        <?php
          $mysqlTable       = $readLeaderboards["mysqlTable"];
          $sorter           = $readLeaderboards["sorter"];
          $dataLimit        = $readLeaderboards["dataLimit"];
          $usernameColumn   = $readLeaderboards["usernameColumn"];

          $tableData          = $readLeaderboards["tableData"];
          $tableTitles        = $readLeaderboards["tableTitles"];
          $tableTitlesArray   = explode(",", $tableTitles);
          $tableDataArray     = explode(",", $tableData);

          if ($readLeaderboards["mysqlServer"] == '0') {
            $leaderboard = $db->prepare("SET @position = 0");
            $leaderboard->execute();
            $leaderboard = $db->prepare("SELECT (@position:=@position+1) AS position, $usernameColumn, $tableData FROM $mysqlTable ORDER BY $sorter DESC LIMIT $dataLimit");
            $leaderboard->execute();
          }
          else {
            try {
              $newDB = new PDO("mysql:host=".$readLeaderboards["mysqlServer"]."; port=".$readLeaderboards["mysqlPort"]."; dbname=".$readLeaderboards["mysqlDatabase"]."; charset=utf8", $readLeaderboards["mysqlUsername"], $readLeaderboards["mysqlPassword"]);
            }
            catch (PDOException $e) {
              die("<strong>MySQL bağlantı hatası:</strong> ".utf8_encode($e->getMessage()));
            }
            $leaderboard = $newDB->prepare("SET @position = 0");
            $leaderboard->execute();
            $leaderboard = $newDB->prepare("SELECT (@position:=@position+1) AS position, $usernameColumn, $tableData FROM $mysqlTable ORDER BY $sorter DESC LIMIT $dataLimit");
            $leaderboard->execute();
          }
        ?>
        <?php if ($leaderboard->rowCount() > 0): ?>
          <table>
            <thead>
              <tr>
                <th class="text-center" style="width: 40px;">Sıra</th>
                <th class="text-center" style="width: 20px;">#</th>
                <th>Kullanıcı Adı</th>
                <?php foreach ($tableTitlesArray as $readTableTitles): ?>
                  <th class="text-center"><?php echo $readTableTitles; ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($leaderboard as $readLeaderboard): ?>
                <tr <?php echo (isset($_SESSION["login"]) && ($readLeaderboard[$usernameColumn] == $readAccount["realname"])) ? 'class="active"':null; ?>>
                  <td class="text-center" style="width: 40px;">
                    <?php if ($readLeaderboard["position"] == 1): ?>
                      <strong class="text-success">1</strong>
                    <?php elseif ($readLeaderboard["position"] == 2): ?>
                      <strong class="text-warning">2</strong>
                    <?php elseif ($readLeaderboard["position"] == 3): ?>
                      <strong class="text-danger">3</strong>
                    <?php else: ?>
                      <?php echo $readLeaderboard["position"]; ?>
                    <?php endif; ?>
                  </td>
                  <td class="text-center" style="width: 20px;">
                    <?php echo minecraftHead($readSettings["avatarAPI"], $readLeaderboard[$usernameColumn], 45); ?> 
                  </td>
                  <td>
                    <a rel="external" href="/oyuncu/<?php echo $readLeaderboard[$usernameColumn]; ?>"><?php echo $readLeaderboard[$usernameColumn]; ?><a href="/oyuncu/<?php echo $readLeaderboard[$usernameColumn]; ?>" class="see-profile">Profil</a></a>
                  </td>
                  <?php foreach ($tableDataArray as $readTableData): ?>
                    <td class="text-center"><?php echo $readLeaderboard[$readTableData]; ?></td>
                  <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <?php echo alertError("Bu sunucuya ait sıralama verisi bulunamadı!"); ?>
        <?php endif; ?>
      <?php else: ?>
        <?php echo alertError("Bu sunucuya ait sıralama verisi bulunamadı!"); ?>
      <?php endif; ?>
      </div>
      <div class="standings-side">
        <div class="monthly-standings">
          <div class="head">
            <svg xmlns="http://www.w3.org/2000/svg" width="30.841" height="37.552" viewBox="0 0 30.841 37.552">
              <g id="badge" opacity="0.2">
                <path id="Path_117" data-name="Path 117"
                  d="M26.954,2.25,29.09,6.272l4.568.555L30.306,9.849l.671,4.468L26.954,11.8l-4.022,2.514L23.6,9.848,20.25,6.828l4.693-.555Z"
                  transform="translate(-2.817 -2.241)" fill="#fff" />
                <path id="Path_118" data-name="Path 118"
                  d="M29.381,17.334l-2.6-.667A9.377,9.377,0,1,1,20.042,5.229l.669-2.6A12.054,12.054,0,0,0,9.648,23.289V39.794l8.045-5.363,8.045,5.363V23.312a12.017,12.017,0,0,0,3.643-5.978Zm-6.325,17.45-5.363-3.576L12.33,34.784V25.112a11.966,11.966,0,0,0,10.727.008Z"
                  transform="translate(-5.623 -2.243)" fill="#fff" />
              </g>
            </svg>
            <p>
              <b>Night, Monster, Love</b> <br>
              Aylık sıralama ödülleri
            </p>
          </div>
          <div class="content">
            <div class="player">
              <p>1. OYUNCU</p>
              <span>2700 RC</span>
            </div>
            <div class="player">
              <p>1. OYUNCU</p>
              <span>2700 RC</span>
            </div>
            <div class="player">
              <p>1. OYUNCU</p>
              <span>2700 RC</span>
            </div>
            <div class="player">
              <p>1. OYUNCU</p>
              <span>2700 RC</span>
            </div>
            <div class="player">
              <p>1. OYUNCU</p>
              <span>2700 RC</span>
            </div>
          </div>
        </div>
        <div class="side-info-box">
          <b>BedWars Hakkında Daha Fazlası</b>
          <a href="#"> BedWars Bilgilendirme Sayfası</a>
        </div>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
  var leaderboardsID = <?php echo $readLeaderboards["id"]; ?>;
</script>
