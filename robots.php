<?php
  header("Content-Type: text/plain");
	$url  = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["SERVER_NAME"]);
?>
User-agent: *
Disallow: /yonetim-paneli/
Sitemap: <?php echo $url.'/sitemap.xml'; ?>
