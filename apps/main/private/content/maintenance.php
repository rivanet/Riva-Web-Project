<?php
  header('HTTP/1.1 503 Service Temporarily Unavailable');
  header('Status: 503 Service Temporarily Unavailable');
  header('Retry-After: 300');
?>
<section class="section error-404-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>BAKIM!</h1>
        <p>Web sitemiz şu anda bakımda lütfen daha sonra tekrar deneyiniz!</p>
        <?php if (isset($_SESSION["login"])): ?>
          <?php if ($readAccount["permission"] == 1 || $readAccount["permission"] == 2 || $readAccount["permission"] == 3 || $readAccount["permission"] == 4 || $readAccount["permission"] == 5): ?>
            <a class="btn btn-rounded btn-success" href="/yonetim-paneli">Yönetim Paneli</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
