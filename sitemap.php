<?php
	define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
	require_once(__ROOT__.'/apps/main/private/config/settings.php');
  header("Content-type: text/xml");
	$url  = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["SERVER_NAME"]);
  $date = date('Y-m-d\TH:i:s+03:00');
?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd"
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?php echo $url; ?>/</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/magaza</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/kredi/yukle</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/kredi/gonder</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/siralama</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/destek</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/sandik</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/hediye</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/indir</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/kurallar</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/profil</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/giris-yap</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/kayit-ol</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/sifremi-unuttum</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/cikis-yap</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/bakim</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<url>
		<loc><?php echo $url; ?>/404</loc>
		<lastmod><?php echo $date; ?></lastmod>
	</url>
	<?php
    $news = $db->query("SELECT * FROM News");
  ?>
	<?php if ($news->rowCount() > 0) : ?>
		<?php foreach ($news as $readNews) : ?>
			<url>
				<loc><?php echo $url; ?>/haber/<?php echo $readNews["id"].'/'.$readNews["slug"]; ?></loc>
				<lastmod><?php echo $date; ?></lastmod>
				<image:image>
					<image:loc>https://www.rivanetwork.com.tr/apps/main/public/assets/img/news/<?php echo $readNews["imageID"]; ?>.jpg</image:loc>
					<image:title>
						<![CDATA[<?php echo $readNews["title"]; ?>]]>
					</image:title>
				</image:image>
			</url>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php
    $newsCategories = $db->query("SELECT * FROM NewsCategories");
  ?>
	<?php if ($newsCategories->rowCount() > 0) : ?>
		<?php foreach ($newsCategories as $readNewsCategories) : ?>
			<url>
				<loc><?php echo $url; ?>/kategori/<?php echo $readNewsCategories["slug"]; ?></loc>
				<lastmod><?php echo $date; ?></lastmod>
			</url>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php
    $newsTags = $db->query("SELECT * FROM NewsTags GROUP BY slug");
  ?>
	<?php if ($newsTags->rowCount() > 0) : ?>
		<?php foreach ($newsTags as $readNewsTags) : ?>
			<url>
				<loc><?php echo $url; ?>/etiket/<?php echo $readNewsTags["slug"]; ?></loc>
				<lastmod><?php echo $date; ?></lastmod>
			</url>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php
    $pages = $db->query("SELECT * FROM Pages");
  ?>
	<?php if ($pages->rowCount() > 0) : ?>
		<?php foreach ($pages as $readPages) : ?>
			<url>
				<loc><?php echo $url; ?>/sayfa/<?php echo $readPages["id"].'/'.$readPages["slug"]; ?></loc>
				<lastmod><?php echo $date; ?></lastmod>
			</url>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php
    $downloads = $db->query("SELECT * FROM Downloads");
  ?>
	<?php if ($downloads->rowCount() > 0) : ?>
		<?php foreach ($downloads as $readDownloads) : ?>
			<url>
				<loc><?php echo $url; ?>/indir/<?php echo $readDownloads["id"].'/'.$readDownloads["slug"]; ?></loc>
				<lastmod><?php echo $date; ?></lastmod>
			</url>
		<?php endforeach; ?>
	<?php endif; ?>
</urlset>
