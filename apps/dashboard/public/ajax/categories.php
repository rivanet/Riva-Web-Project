<?php
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
  require_once(__ROOT__."/apps/dashboard/private/config/settings.php");
  if ($readAdmin["permission"] != 1) {
    go('/yonetim-paneli/hata/001');
  }
?>
<?php if (post("serverID") != null): ?>
  <?php
    $productCategories = $db->prepare("SELECT * FROM ProductCategories WHERE serverID = ?");
    $productCategories->execute(array(post("serverID")));
  ?>
  <option value="0">Kategorisiz</option>
  <?php foreach ($productCategories as $readProductCategories): ?>
    <option value="<?php echo $readProductCategories["id"]; ?>"><?php echo $readProductCategories["name"]; ?></option>
  <?php endforeach; ?>
<?php endif; ?>
