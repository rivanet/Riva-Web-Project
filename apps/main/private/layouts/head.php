<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="4Twain">
<link rel="shortcut icon" type="image/x-icon" href="/apps/main/public/assets/img/extras/favicon.png">

<!-- Riva Meta -->

  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, 
  user-scalable=0'>
  <title>Riva Network</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css?v=4">
  <script src="/js/jquery.js"></script>
  <script src="/angular.js"></script>
  <input type="hidden" name="csrfmiddlewaretoken">
  <link rel="stylesheet" type="text/css" href="/js/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="/js/slick/slick-theme.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
  </script>

<?php $siteURL = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["SERVER_NAME"]); ?>
<meta name="description" content="<?php echo $readSettings["siteDescription"]; ?>" />
<meta name="keywords" content="<?php echo $readSettings["siteTags"]; ?>">
<link rel="canonical" href="<?php echo $siteURL; ?>" />
<meta property="og:locale" content="tr_TR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $siteTitle; ?>" />
<meta property="og:description" content="<?php echo $readSettings["siteDescription"]; ?>" />
<meta property="og:url" content="<?php echo $siteURL; ?>" />
<meta property="og:site_name" content="<?php echo $readSettings["serverName"]; ?>" />

<!-- MAIN -->

<!-- EXTRAS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.4.0/dist/select2-bootstrap4.min.css">

<!-- FONTS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- THEMES -->
<?php if ($readTheme["themeID"] == 0): ?>
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/custom/main.min.css?v=">
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/custom/responsive.min.css?v=">
<?php elseif ($readTheme["themeID"] == 1): ?>
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/flat/main.min.css?v=">
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/flat/responsive.min.css?v=">
<?php elseif ($readTheme["themeID"] == 2): ?>
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/epic/main.min.css?v=">
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/epic/responsive.min.css?v=">
<?php else: ?>
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/flat/main.min.css?v=">
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/themes/flat/responsive.min.css?v=">
<?php endif; ?>

<?php if (get("route") == 'lottery'): ?>
	<link rel="stylesheet" type="text/css" href="/apps/main/public/assets/css/plugins/superwheel/superwheel.min.css">
	<style type="text/css">
		.superWheel .sWheel-inner {
			background-image: url(/apps/main/public/assets/img/extras/lottery-bg.png);
			background-repeat: no-repeat;
			background-position: center;
			background-size: 120px;
		}
	</style>
<?php endif; ?>

<!-- COLORS -->
<?php if ($readTheme["themeID"] != 0): ?>
	<style type="text/css">
		<?php $readColors = json_decode($readTheme["colors"], true); ?>
		<?php foreach ($readColors as $selector => $styles): ?>
			<?php echo $selector; ?> {
				<?php foreach ($styles as $key => $value): ?>
					<?php echo $key.':'.$value.';'; ?>
				<?php endforeach; ?>
			}
		<?php endforeach; ?>
	</style>
<?php endif; ?>

<!-- CUSTOM CSS -->
<style type="text/css">
	<?php echo $readTheme["customCSS"]; ?>
	.hero-nav-2 .container {
	    max-width: 100%;
	    width: 100%;
	    margin-left: auto !important;
	    margin-right: auto !important;
	}
</style>
