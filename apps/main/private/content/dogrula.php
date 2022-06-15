<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


if (!isset($_SESSION["login"])) {
	go("/giris-yap");
}


$id = explode("-", get("id"))[0];

 $user = $db->prepare("UPDATE Accounts SET verify = ? WHERE id = ?");
 $user->execute(array(0, $id));


?>
<section class="section credit-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">AnaSayfa</a></li>
						<li class="breadcrumb-item active" aria-current="page">E-Posta Doğrula</li>
					</ol>
				</nav>
			</div>
			<div class="col-md-12">
				<div class="card text-white bg-success mb-3 text-center">
					<div class="card-body">
						<h5 class="card-title">E-Posta Adresin Başarıyla Doğrulandı</h5>
						<p class="card-text">Artık kullanıcı sayfalarını başarıyla görüntüleyebilirsin..</p>
						<?php echo goDelay('/', 2); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
