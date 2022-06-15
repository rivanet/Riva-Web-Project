<?php
	define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
	require_once(__ROOT__."/apps/main/private/config/settings.php");
?>
<!DOCTYPE html>
<html lang="tr">
	<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
	integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" 
	crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php require_once(__ROOT__."/apps/main/private/layouts/head.php"); ?>
</head>

	<body style="<?php echo (($readSettings["preloaderStatus"] == 1) ? 'overflow: hidden;' : 'overflow: auto;'); ?>">
		<?php require_once(__ROOT__."/apps/main/private/layouts/header.php"); ?>
		<?php if (get("route") == "news"): ?>
			<main class="main" role="main">
				<div class="main-wrapper">
					<div class="container">
					<?php if (preg_match('/^[A-Za-z0-9\.\-]+$/', get("route"))): ?>
						<?php $routeFile = __ROOT__."/apps/main/private/content/".get("route").".php"; ?>
						<?php if (file_exists($routeFile)): ?>
							<?php include $routeFile; ?>
						<?php else: ?>
							<?php go("/404"); ?>
						<?php endif; ?>
					<?php else: ?>
						<?php go("/404"); ?>
					<?php endif; ?>
					<div class="side">
						<div class="side-profile">
							<div class="image">
								<img src="images/mc-pic.png" alt="">
								</div>
								<b>4Twain ( 0 RC )</b>
								<a href="#">
									<svg xmlns="http://www.w3.org/2000/svg" width="17.21" height="16.758" viewBox="0 0 17.21 16.758">
										<g id="Iconly_Light_Upload" data-name="Iconly/Light/Upload" transform="translate(16.61 0.6) rotate(90)">
										<g id="Upload" transform="translate(0 16.01) rotate(-90)">
											<path id="Stroke-1"
											d="M10.3,3.883V3.1A3.1,3.1,0,0,0,7.2,0H3.1A3.1,3.1,0,0,0,0,3.1v9.36a3.1,3.1,0,0,0,3.1,3.1H7.206a3.09,3.09,0,0,0,3.09-3.09v-.793"
											fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
											fill-rule="evenodd" />
											<line id="Stroke-3" x1="10.126" transform="translate(5.884 7.779)" fill="none" stroke="#fff"
											stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
											<path id="Stroke-5" d="M0,0,2.462,2.451,0,4.9" transform="translate(13.547 5.327)" fill="none"
											stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
											fill-rule="evenodd" />
										</g>
										</g>
									</svg>
									Çıkış Yap
								</a>
							</div>
							<div class="side-box">
								<div class="head">
								RİVA NETWORK NEDİR
								</div>
								<div class="body">
								<p>Riva® Network 9 yıldır hizmet veren Türkiye'nin en köklü Minecraft sunucusudur. Riva Network®'da Riva
									Network® Launcher sayesinde hilesiz ve bedava Minecraft oynayabilirsiniz.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		<?php else: ?>
			<main class="main" role="main">
				<?php if (preg_match('/^[A-Za-z0-9\.\-]+$/', get("route"))): ?>
					<?php $routeFile = __ROOT__."/apps/main/private/content/".get("route").".php"; ?>
					<?php if (file_exists($routeFile)): ?>
						<?php include $routeFile; ?>
					<?php else: ?>
						<?php go("/404"); ?>
					<?php endif; ?>
				<?php else: ?>
					<?php go("/404"); ?>
				<?php endif; ?>
			</main>
		<?php endif; ?>
		<?php require_once(__ROOT__."/apps/main/private/layouts/footer.php"); ?>
		<?php require_once(__ROOT__."/apps/main/private/layouts/scripts.php"); ?>
	</body>
</html>
<?php ob_end_flush(); 
?>