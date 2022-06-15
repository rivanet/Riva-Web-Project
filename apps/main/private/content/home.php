<?php
if (get("page")) {
	if (!is_numeric(get("page"))) {
		$_GET["page"] = 1;
	}
	$page = intval(get("page"));
}
else {
	$page = 1;
}
if (get("category")) {
	$itemsCount = $db->prepare("SELECT N.id from News N INNER JOIN NewsCategories NC ON N.categoryID = NC.id WHERE NC.slug = ?");
	$itemsCount->execute(array(get("category")));
	$itemsCount = $itemsCount->rowCount();
	$requestURL = '/kategori/'.get("category");
}
else if (get("tag")) {
	$itemsCount = $db->prepare("SELECT N.id from News N INNER JOIN NewsTags NT ON N.id = NT.newsID WHERE NT.slug = ?");
	$itemsCount->execute(array(get("tag")));
	$itemsCount = $itemsCount->rowCount();
	$requestURL = '/etiket/'.get("tag");
}
else {
	$itemsCount = $db->query("SELECT id from News");
	$itemsCount = $itemsCount->rowCount();
	$requestURL = '/haberler';
}
$pageCount = ceil($itemsCount/$newsLimit);
if ($page > $pageCount) {
	$page = 1;
}
$visibleItemsCount = $page * $newsLimit - $newsLimit;
$visiblePageCount = 5;
?>
<style type="text/css">
	<?php if ($readTheme["sliderStyle"] == '2'): ?>
		.news-section {
			margin-top: 2rem !important;
		}
		.carousel-inner, .carousel-item img {
			<?php if ($readTheme["serverOnlineInfoStatus"] == '0'): ?>
				border-radius: 1rem;
			<?php else: ?>
				border-radius: 1rem 1rem 0 0;
			<?php endif; ?>
		}
		<?php if ($readTheme["serverOnlineInfoStatus"] == '1'): ?>
			.server-online-info {
				border-radius: 0 0 1rem 1rem;
			}
		<?php endif; ?>
	<?php endif; ?>
</style>
<?php if (!get("category") && !get("tag") && $page == 1): ?>
<?php if ($readTheme["sliderStatus"] == '1'): ?>
	<?php $slider = $db->query("SELECT * FROM Slider"); ?>
	<?php if ($slider->rowCount() > 0): ?>
		<div class="<?php echo ($readTheme["sliderStyle"] == '2') ? 'container mt-4 mt-md-5' : null; ?> d-none">
			<div id="carouselSlider" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php for ($i=0; $i < $slider->rowCount(); $i++): ?>
						<li <?php echo ($i == 0) ? 'class="active"' : null; ?> data-target="#carouselSlider" data-slide-to="<?php echo $i; ?>"></li>
					<?php endfor; ?>
				</ol>
				<div class="carousel-inner">
					<?php foreach ($slider as $i => $readSlider): ?>
						<div class="carousel-item <?php echo ($i == 0) ? "active" : null; ?>">
							<a href="<?php echo $readSlider["url"]; ?>">
								<img class="d-block w-100 lazyload" data-src="/apps/main/public/assets/img/slider/<?php echo $readSlider["imageID"].'.'.$readSlider["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/slider.png" alt="<?php echo $serverName." Slider - Afiş"; ?>">
								<div class="carousel-caption d-md-block">
									<h1><?php echo $readSlider["title"]; ?></h1>
									<p><?php echo $readSlider["content"]; ?></p>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<a class="carousel-control-prev" href="#carouselSlider" role="button" data-slide="prev">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
					<span class="sr-only">Geri</span>
				</a>
				<a class="carousel-control-next" href="#carouselSlider" role="button" data-slide="next">
					<span class="fa fa-angle-right" aria-hidden="true"></span>
					<span class="sr-only">İleri</span>
				</a>
			</div>
			<?php if ($readTheme["serverOnlineInfoStatus"] == '1'): ?>
				<div class="server-online-info" data-toggle="onlinebox">Sunucumuzda <strong data-toggle="onlinetext" server-ip="<?php echo $serverIP; ?>">-/-</strong> oyuncu var</div>
			<?php endif; ?>
		</div>
	<?php else: ?>
		<section class="section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<?php echo alertError("Slider verisi bulunamadı!"); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<div class="news-wrapper">
	<div class="container">
		<div class="title">HABERLER</div>
		<div class="news-slider">
			<?php $slider = $db->query("SELECT * FROM Slider"); ?>
			<?php if ($slider->rowCount() > 0): ?>
				<?php foreach ($slider as $i => $readSlider): ?>
					<div class="slide">
						<img class="lazyload" data-src="/apps/main/public/assets/img/slider/<?php echo $readSlider["imageID"].'.'.$readSlider["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/slider.png" alt="<?php echo $serverName." Slider - Afiş"; ?>">
						<div class="slide-overlay">
							<h3><?php echo $readSlider["title"]; ?></h3>
							<p><?php echo $readSlider["content"]; ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="col-md-12"><?php echo alertError("Slider verisi bulunamadı!"); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="container">
	<div class="register-banner rounded">
		<div class="overlay">
			<div class="container">
				<div class="text">
					<h3>Sınırsız Eğlenceye Hazır mısın?<br><span>Hemen ücretsiz kayıt ol ve tadını çıkar.</span></h3>
				</div>
				<div class="buttons">
					<a class="animation-btn animation-btn-blue scrollbar-animation" href=""><span>KAYIT OL</span></a>
					<a class="animation-btn animation-btn-green scrollbar-animation" href=""><span>DAHA FAZLA BİLGİ</span></a>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="main-wrapper">
	<div class="container">
		<div class="content">
			<?php
			if (get("category")) {
				$news = $db->prepare("SELECT N.*, NC.name as categoryName, NC.slug as categorySlug, NC.color as categoryColor from News N INNER JOIN NewsCategories NC ON N.categoryID = NC.id INNER JOIN Accounts A ON N.accountID = A.id WHERE NC.slug = ? ORDER BY N.id DESC LIMIT $visibleItemsCount, $newsLimit");
				$news->execute(array(get("category")));
			}
			else if (get("tag")) {
				$news = $db->prepare("SELECT N.*, NC.name as categoryName, NC.slug as categorySlug, NC.color as categoryColor from News N INNER JOIN NewsCategories NC ON N.categoryID = NC.id INNER JOIN NewsTags NT ON N.id = NT.newsID INNER JOIN Accounts A ON N.accountID = A.id WHERE NT.slug = ? ORDER BY N.id DESC LIMIT $visibleItemsCount, $newsLimit");
				$news->execute(array(get("tag")));
			}
			else {
				$news = $db->query("SELECT N.*, NC.name as categoryName, NC.slug as categorySlug, NC.color as categoryColor from News N INNER JOIN NewsCategories NC ON N.categoryID = NC.id INNER JOIN Accounts A ON N.accountID = A.id ORDER BY N.id DESC LIMIT $visibleItemsCount, $newsLimit");
				$news->execute();
			}
			?>
			<?php if ($news->rowCount() > 0): ?>
				<?php foreach ($news as $readNews): ?>
					<?php
					$newsComments = $db->prepare("SELECT * FROM NewsComments WHERE newsID = ? AND status = ? ORDER BY id DESC");
					$newsComments->execute(array($readNews["id"], 1));
					?>
					<?php
					$newsCardCol = 'col-md-4';
					$newsLetterLimit = 240;
					if ($readTheme["sidebarStatus"] == 0 && $readTheme["newsCardStyle"] == 1) {
						$newsCardCol = 'col-md-4';
						$newsLetterLimit = 240;
					}
					if ($readTheme["sidebarStatus"] == 0 && $readTheme["newsCardStyle"] == 2
						|| $readTheme["sidebarStatus"] == 1 && $readTheme["newsCardStyle"] == 1) {
						$newsCardCol = 'col-md-6';
					$newsLetterLimit = 300;
				}
				if ($readTheme["sidebarStatus"] == 1 && $readTheme["newsCardStyle"] == 2) {
					$newsCardCol = 'col-md-12';
					$newsLetterLimit = 300;
				}
				?>
				<div class="blog-post">
					<div class="image">
						<img class="lazyload" data-src="/apps/main/public/assets/img/news/<?php echo $readNews["imageID"].'.'.$readNews["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/news.png" alt="<?php echo $serverName." Haber - ".$readNews["title"]; ?>">
					</div>
					<div class="text">
						<h3><?php echo $readNews["title"]; ?></h3>
						<span class="color-blue"><?php echo convertTime($readNews["creationDate"], 0); ?> <b style="color: <?php echo $readNews["categoryColor"]." !important"; ?>;"><?php echo $readNews["categoryName"]; ?></b> kategorisinde yayınlandı.</span>
						<p><?php echo showEmoji(limitedContent(strip_tags($readNews["content"]), $newsLetterLimit)); ?></p>
						<div class="button">
							<?php if($readNews["categorySlug"] == 'guncelleme'): ?>
								<a class="primary-btn green" href="/haber/<?php echo $readNews["id"]; ?>/<?php echo $readNews["slug"]; ?>"><span>Devamını Görüntüle</span></a>
							<?php elseif ($readNews["categorySlug"] == 'duyuru'): ?>
								<a class="primary-btn" href="/haber/<?php echo $readNews["id"]; ?>/<?php echo $readNews["slug"]; ?>"><span>Devamını Görüntüle</span></a>
							<?php else: ?>
								<a style="color: white !important;box-shadow: 0px 0px 72px <?php echo $readNews["categoryColor"] ?>;background-image: url(../images/btn-pattern.svg),linear-gradient(180deg, #fff0, #0000008c);background-color: <?php echo $readNews["categoryColor"] ?>;" class="primary-btn <?php echo $readNews["categoryName"]; ?>btn" href="/haber/<?php echo $readNews["id"]; ?>/<?php echo $readNews["slug"]; ?>">Devamını Görüntüle</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<style type="text/css">
					.<?php echo $readNews["categoryName"]; ?>btn::after{
						background-image: linear-gradient(180deg, #0000007a, #000000b8);
						background-color: <?php echo $readNews["categoryColor"] ?>;
					}
				</style>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="col-md-12">
				<?php echo alertError("Haber bulunamadı!"); ?>
			</div>
		<?php endif; ?>
		<div class="paginate">
			<a href="<?php echo $requestURL.'/'.($page-1); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="16.895" height="15.791" viewBox="0 0 16.895 15.791">
					<g id="Group_44" data-name="Group 44" transform="translate(1 1.414)">
						<g id="Icon_feather-arrow-right" data-name="Icon feather-arrow-right" transform="translate(8)">
							<path id="Path_31" data-name="Path 31" d="M24.481,7.5,18,13.981l6.481,6.481"
							transform="translate(-18 -7.5)" fill="none" stroke="#fff" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" />
						</g>
						<g id="Icon_feather-arrow-right-2" data-name="Icon feather-arrow-right">
							<path id="Path_31-2" data-name="Path 31" d="M24.481,7.5,18,13.981l6.481,6.481"
							transform="translate(-18 -7.5)" fill="none" stroke="#fff" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" />
						</g>
					</g>
				</svg>
				&nbsp;ÖNCEKİ
			</a>
			<a href="<?php echo $requestURL.'/'.($page+1); ?>">
				SONRAKİ&nbsp;
				<svg xmlns="http://www.w3.org/2000/svg" width="16.895" height="15.791" viewBox="0 0 16.895 15.791">
					<g id="Group_413" data-name="Group 413" transform="translate(-1259.099 -2805.604)">
						<g id="Icon_feather-arrow-right" data-name="Icon feather-arrow-right"
						transform="translate(1242.513 2799.519)">
						<path id="Path_31" data-name="Path 31" d="M18,7.5l6.481,6.481L18,20.462" transform="translate(0)"
						fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
					</g>
					<g id="Icon_feather-arrow-right-2" data-name="Icon feather-arrow-right"
					transform="translate(1250.513 2799.519)">
					<path id="Path_31-2" data-name="Path 31" d="M18,7.5l6.481,6.481L18,20.462" transform="translate(0)"
					fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
				</g>
			</g>
		</svg>
	</a>
</div>
</div>
<div class="side">
	<div class="discord-join">
		<div class="head">
			<img src="images/Discord-Logo+Wordmark-Color.svg" alt="">
		</div>
		<div class="body">
			<p><b data-toggle="discordonline" data-discord-id="<?php echo $readTheme["discordServerID"]; ?>">0</b> Çevrimiçi Üye</p>
			<a data-toggle="discordInvite" data-discord-id="<?php echo $readTheme["discordServerID"]; ?>" href="" target="_blank">Katıl</a>
		</div>
	</div>
	<div class="side-box">
		<div class="head">
			Riva Network®️ Nedir?
		</div>
		<div class="body">
			<p>Riva Network®️, sayısız oyun moduna sahip, oynaması ücretsiz bir Minecraft sunucusudur. RivaNetwork'de yeni arkadaşlıklar kurabilir, kendi ekibini oluşturabilir ve Riva Launcher ile normal Minecraft deneyiminin üstünde gününü bir solukta bitirebileceğin mükemmel bir oyun deneyimi yaşayabilirsin.</p>
		</div>
	</div>
</div>
</div>
</div>

<section class="section news-section d-none">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if (get("category")): ?>
					<?php
					$newsCategory = $db->prepare("SELECT name FROM NewsCategories WHERE slug = ?");
					$newsCategory->execute(array(get("category")));
					$readNewsCategory = $newsCategory->fetch();
					?>
					<li class="breadcrumb-item"><a href="/">Haberler</a></li>
					<li class="breadcrumb-item"><a href="/">Kategori</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo (($newsCategory->rowCount() > 0) ? $readNewsCategory["name"] : 'Bulunamadı!'); ?></li>
				<?php elseif (get("tag")): ?>
					<?php
					$newsTag = $db->prepare("SELECT name FROM NewsTags WHERE slug = ?");
					$newsTag->execute(array(get("tag")));
					$readNewsTag = $newsTag->fetch();
					?>
					<li class="breadcrumb-item"><a href="/">Haberler</a></li>
					<li class="breadcrumb-item"><a href="/">Etiket</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo (($newsTag->rowCount() > 0) ? $readNewsTag["name"] : 'Bulunamadı!'); ?></li>
				<?php else: ?>
				<?php endif; ?>
			</ol>
		</nav>
	</div>
</div>
<div class="row">
	<div class="<?php echo ($readTheme["sidebarStatus"] == 0) ? 'col-md-12' : 'col-md-8'; ?>">
		<div class="row">
			<?php
			if (get("category")) {
				$news = $db->prepare("SELECT N.*, NC.name as categoryName, NC.slug as categorySlug, NC.color as categoryColor from News N INNER JOIN NewsCategories NC ON N.categoryID = NC.id INNER JOIN Accounts A ON N.accountID = A.id WHERE NC.slug = ? ORDER BY N.id DESC LIMIT $visibleItemsCount, $newsLimit");
				$news->execute(array(get("category")));
			}
			else if (get("tag")) {
				$news = $db->prepare("SELECT N.*, NC.name as categoryName, NC.slug as categorySlug, NC.color as categoryColor from News N INNER JOIN NewsCategories NC ON N.categoryID = NC.id INNER JOIN NewsTags NT ON N.id = NT.newsID INNER JOIN Accounts A ON N.accountID = A.id WHERE NT.slug = ? ORDER BY N.id DESC LIMIT $visibleItemsCount, $newsLimit");
				$news->execute(array(get("tag")));
			}
			else {
				$news = $db->query("SELECT N.*, NC.name as categoryName, NC.slug as categorySlug, NC.color as categoryColor from News N INNER JOIN NewsCategories NC ON N.categoryID = NC.id INNER JOIN Accounts A ON N.accountID = A.id ORDER BY N.id DESC LIMIT $visibleItemsCount, $newsLimit");
				$news->execute();
			}
			?>
			<?php if ($news->rowCount() > 0): ?>
				<?php foreach ($news as $readNews): ?>
					<?php
					$newsComments = $db->prepare("SELECT * FROM NewsComments WHERE newsID = ? AND status = ? ORDER BY id DESC");
					$newsComments->execute(array($readNews["id"], 1));
					?>
					<?php
					$newsCardCol = 'col-md-4';
					$newsLetterLimit = 240;
					if ($readTheme["sidebarStatus"] == 0 && $readTheme["newsCardStyle"] == 1) {
						$newsCardCol = 'col-md-4';
						$newsLetterLimit = 240;
					}
					if ($readTheme["sidebarStatus"] == 0 && $readTheme["newsCardStyle"] == 2
						|| $readTheme["sidebarStatus"] == 1 && $readTheme["newsCardStyle"] == 1) {
						$newsCardCol = 'col-md-6';
					$newsLetterLimit = 420;
				}
				if ($readTheme["sidebarStatus"] == 1 && $readTheme["newsCardStyle"] == 2) {
					$newsCardCol = 'col-md-12';
					$newsLetterLimit = 600;
				}
				?>
				<div class="<?php echo $newsCardCol; ?>">
					<article class="news">
						<div class="card">
							<div class="img-container">
								<a class="img-card" href="/haber/<?php echo $readNews["id"]; ?>/<?php echo $readNews["slug"]; ?>">
									<img class="card-img-top lazyload" data-src="/apps/main/public/assets/img/news/<?php echo $readNews["imageID"].'.'.$readNews["imageType"]; ?>" src="/apps/main/public/assets/img/loaders/news.png" alt="<?php echo $serverName." Haber - ".$readNews["title"]; ?>">
								</a>
								<div class="img-card-tl">
									<a href="/kategori/<?php echo $readNews["categorySlug"]; ?>">
										<span style="background-color: <?php echo $readNews["categoryColor"]." !important"; ?>;" class="theme-color badge badge-pill badge-primary"><?php echo $readNews["categoryName"]; ?></span>
									</a>
								</div>
								<div class="img-card-tr">
									<a href="/haber/<?php echo $readNews["id"]; ?>/<?php echo $readNews["slug"]; ?>">
										<span class="theme-color badge badge-pill badge-primary"><?php echo convertTime($readNews["creationDate"], 1); ?></span>
									</a>
								</div>
								<div class="img-card-bottom">
									<h5 class="mb-0">
										<a class="text-white" href="/haber/<?php echo $readNews["id"]; ?>/<?php echo $readNews["slug"]; ?>">
											<?php echo $readNews["title"]; ?>
										</a>
									</h5>
								</div>
							</div>
							<div class="card-body">
								<p class="card-text" <?php echo ($newsCardCol == 'col-md-12') ? 'style="height: auto !important; max-height: 168px !important;"' : null ?>>
									<?php echo showEmoji(limitedContent(strip_tags($readNews["content"]), $newsLetterLimit)); ?>
								</p>
								<a style="background-color: <?php echo $readNews["categoryColor"]." !important"; ?>; border-color: <?php echo $readNews["categoryColor"]." !important"; ?>;" class="theme-color btn btn-primary w-100" href="/haber/<?php echo $readNews["id"]; ?>/<?php echo $readNews["slug"]; ?>">Devamını Görüntüle</a>
							</div>
						</div>
					</article>
				</div>
			<?php endforeach; ?>
			<div class="col-md-12 d-flex justify-content-center <?php echo ($readTheme["sidebarStatus"] == 1) ? 'mb-4' : null; ?>">
				<nav class="pages" aria-label="Sayfalar">
					<ul class="pagination">
						<li class="page-item <?php echo ($page == 1) ? "disabled" : null; ?>">
							<a class="page-link" href="<?php echo $requestURL.'/'.($page-1); ?>" tabindex="-1">
								<i class="fa fa-angle-double-left"></i>
							</a>
						</li>
						<?php for ($i = $page - $visiblePageCount; $i < $page + $visiblePageCount + 1; $i++): ?>
							<?php if ($i > 0 and $i <= $pageCount): ?>
								<li class="page-item <?php echo (($page == $i) ? "active" : null); ?>">
									<a class="page-link" href="<?php echo $requestURL.'/'.$i; ?>"><?php echo $i; ?></a>
								</li>
							<?php endif; ?>
						<?php endfor; ?>
						<li class="page-item <?php echo ($page == $pageCount) ? "disabled" : null; ?>">
							<a class="page-link" href="<?php echo $requestURL.'/'.($page+1); ?>">
								<i class="fa fa-angle-double-right"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		<?php else : ?>
			<div class="col-md-12">
				<?php echo alertError("Haber bulunamadı!"); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php if ($readTheme["sidebarStatus"] == 1): ?>
	<div class="col-md-4">
		<?php $storeHistory = $db->query("SELECT P.name as productName, S.name as serverName, A.realname, A.permission FROM StoreHistory SH INNER JOIN Products P ON SH.productID = P.id INNER JOIN Servers S ON SH.serverID = S.id INNER JOIN Accounts A ON SH.accountID = A.id ORDER BY SH.id DESC LIMIT 5"); ?>
		<?php if ($storeHistory->rowCount() > 0): ?>
			<div class="card mb-3">
				<div class="card-header">
					<span>Son Mağaza Alışverişleri</span>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Kullanıcı</th>
									<th class="text-center">Sunucu</th>
									<th class="text-center">Ürün</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($storeHistory as $readStoreHistory): ?>
									<tr>
										<td class="text-center">
											<?php echo minecraftHead($readSettings["avatarAPI"], $readStoreHistory["realname"], 20); ?>
										</td>
										<td>
											<?php echo $readStoreHistory["realname"]; ?>
											<?php echo verifiedCircle($readStoreHistory["permission"]); ?>
										</td>
										<td class="text-center"><?php echo $readStoreHistory["serverName"]; ?></td>
										<td class="text-center"><?php echo $readStoreHistory["productName"]; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php else : ?>
			<?php echo alertError("Mağaza geçmişi bulunamadı!"); ?>
		<?php endif; ?>

		<?php
		$creditHistory = $db->prepare("SELECT CH.type, CH.price, A.realname, A.permission FROM CreditHistory CH INNER JOIN Accounts A ON CH.accountID = A.id WHERE CH.type IN (?, ?) AND CH.paymentStatus = ? ORDER BY CH.id DESC LIMIT 5");
		$creditHistory->execute(array(1, 2, 1));
		?>
		<?php if ($creditHistory->rowCount() > 0): ?>
			<div class="card mb-3">
				<div class="card-header">
					<span>Son Kredi Yükleyenler</span>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Kullanıcı</th>
									<th class="text-center">Miktar</th>
									<th class="text-center">Ödeme</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($creditHistory as $readCreditHistory): ?>
									<tr>
										<td class="text-center">
											<?php echo minecraftHead($readSettings["avatarAPI"], $readCreditHistory["realname"], 20); ?>
										</td>
										<td>
											<?php echo $readCreditHistory["realname"]; ?>
											<?php echo verifiedCircle($readCreditHistory["permission"]); ?>
										</td>
										<td class="text-center"><?php echo ($readCreditHistory["type"] == 3 || $readCreditHistory["type"] == 5) ? '<span class="text-danger">-'.$readCreditHistory["price"].'</span>' : '<span class="text-success">+'.$readCreditHistory["price"].'</span>'; ?></td>
										<td class="text-center">
											<?php if ($readCreditHistory["type"] == 1): ?>
												<i class="fa fa-mobile" data-toggle="tooltip" data-placement="top" title="Mobil Ödeme"></i>
											<?php elseif ($readCreditHistory["type"] == 2): ?>
												<i class="fa fa-credit-card" data-toggle="tooltip" data-placement="top" title="Kredi Kartı Ödeme"></i>
											<?php elseif ($readCreditHistory["type"] == 3): ?>
												<i class="fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="Gönderim (Gönderen)"></i>
											<?php elseif ($readCreditHistory["type"] == 4): ?>
												<i class="fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="Gönderim (Alan)"></i>
											<?php elseif ($readCreditHistory["type"] == 5): ?>
												<i class="fa fa-ticket" data-toggle="tooltip" data-placement="top" title="Çarkıfelek (Bilet)"></i>
											<?php elseif ($readCreditHistory["type"] == 6): ?>
												<i class="fa fa-ticket" data-toggle="tooltip" data-placement="top" title="Çarkıfelek (Kazanç)"></i>
											<?php else: ?>
												<i class="fa fa-paper-plane"></i>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php else : ?>
			<?php echo alertError("Kredi geçmişi bulunamadı!"); ?>
		<?php endif; ?>

		<?php
		$topCreditHistory = $db->prepare("SELECT SUM(CH.price) as totalPrice, COUNT(CH.id) as totalProcess, A.realname, A.permission FROM CreditHistory CH INNER JOIN Accounts A ON CH.accountID = A.id WHERE CH.type IN (?, ?) AND CH.paymentStatus = ? AND CH.creationDate LIKE ? GROUP BY CH.accountID HAVING totalProcess > 0 ORDER BY totalPrice DESC LIMIT 5");
		$topCreditHistory->execute(array(1, 2, 1, '%'.date("Y-m").'%'));
		?>
		<?php if ($topCreditHistory->rowCount() > 0): ?>
			<div class="card mb-3">
				<div class="card-header">
					<div class="row">
						<div class="col">
							<span>En Çok Kredi Yükleyenler</span>
						</div>
						<div class="col-auto">
							<span>(Bu Ay)</span>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Kullanıcı</th>
									<th class="text-center">Toplam</th>
									<th class="text-center">Adet</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($topCreditHistory as $topCreditHistoryRead): ?>
									<tr>
										<td class="text-center">
											<?php echo minecraftHead($readSettings["avatarAPI"], $topCreditHistoryRead["realname"], 20); ?>
										</td>
										<td>
											<?php echo $topCreditHistoryRead["realname"]; ?>
											<?php echo verifiedCircle($topCreditHistoryRead["permission"]); ?>
										</td>
										<td class="text-center"><?php echo $topCreditHistoryRead["totalPrice"]; ?></td>
										<td class="text-center"><?php echo $topCreditHistoryRead["totalProcess"]; ?> kez</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if ($readTheme["discordServerID"] != '0'): ?>
			<iframe class="lazyload" data-src="https://discordapp.com/widget?id=<?php echo $readTheme["discordServerID"]; ?>&theme=<?php echo ($readTheme["discordThemeID"] == 1) ? "light" : (($readTheme["discordThemeID"] == 2) ? "dark" : "light"); ?>" width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
		<?php endif; ?>
	</div>
<?php endif; ?>
</div>
</div>
</section>
