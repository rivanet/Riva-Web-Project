<?php if (get("slug") == 'kvkk'): ?>
	<?php
		$customPage = $db->prepare("SELECT * FROM CustomPages WHERE slug = ?");
		$customPage->execute(array(get("slug")));
		$readCustomPage = $customPage->fetch();
		$content = $readCustomPage["content"];
		$content = str_replace("%updated_at%", date("d/m/Y", strtotime($readCustomPage["date"])), $content);
	?>
<div class="section">
  <div class="container">
    <div class="support-details-2">
      <h1><?php echo $readCustomPage["title"]; ?></h1>
		<?php echo $content; ?>
    </div>
  </div>
</div>
<?php elseif (get("slug") == 'gizlilik-politikasi'): ?>
	<?php
		$customPage = $db->prepare("SELECT * FROM CustomPages WHERE slug = ?");
		$customPage->execute(array(get("slug")));
		$readCustomPage = $customPage->fetch();
$content = $readCustomPage["content"];
		$content = str_replace("%updated_at%", date("d/m/Y", strtotime($readCustomPage["date"])), $content);
	?>
<div class="section">
  <div class="container">
    <div class="support-details-2">
      <h1><?php echo $readCustomPage["title"]; ?></h1>
		<?php echo $content; ?>
    </div>
  </div>
</div>
<?php elseif (get("slug") == 'hizmet-sartlari-ve-üyelik-sözlesmesi'): ?>
	<?php
		$customPage = $db->prepare("SELECT * FROM CustomPages WHERE slug = ?");
		$customPage->execute(array(get("slug")));
		$readCustomPage = $customPage->fetch();
$content = $readCustomPage["content"];
		$content = str_replace("%updated_at%", date("d/m/Y", strtotime($readCustomPage["date"])), $content);
	?>
<div class="section">
  <div class="container">
    <div class="support-details-2">
      <h1><?php echo $readCustomPage["title"]; ?></h1>
		<?php echo $content; ?>
    </div>
  </div>
</div>
<?php elseif (get("slug") == 'icerik-üretici-politikasi'): ?>
	<?php
		$customPage = $db->prepare("SELECT * FROM CustomPages WHERE slug = ?");
		$customPage->execute(array(get("slug")));
		$readCustomPage = $customPage->fetch();
$content = $readCustomPage["content"];
		$content = str_replace("%updated_at%", date("d/m/Y", strtotime($readCustomPage["date"])), $content);
	?>
<div class="section">
  <div class="container">
    <div class="support-details-2">
      <h1><?php echo $readCustomPage["title"]; ?></h1>
		<?php echo $content; ?>
    </div>
  </div>
</div>
<?php endif; ?>