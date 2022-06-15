<style>
:root {
    --bg: #121a23;
}
footer .container .footer-col .socials a {
    margin: auto;
}
.footer-ul-label
{
  position: relative;
  display: flex;
  gap: 48px;
}
.footer-ul-label .footer-li-label
{
  position: relative;
  list-style: 80px;
  width: 80px;
  height: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: 0.5s;
}
.footer-ul-label .footer-li-label:hover
{
  z-index: 10000;
  transform: scale(0.75);
}
.footer-ul-label .footer-li-label::before
{
  content: '';
  position: absolute;
  inset: 30px;
  box-shadow: 0 0 0 10px var(--clr),
  0 0 0 20px var(--bg),
  0 0 0 22px var(--clr);
  transition: 0.5s;
}
.footer-ul-label .footer-li-label:hover:before
{
inset: 0px;
}
.footer-ul-label .footer-li-label::after
{
  content: '';
  position: absolute;
  inset: 0;
  background: var(--bg);
  transform: rotate(45deg);
}
.footer-ul-label .footer-li-label a
{
  position: relative;
  text-decoration: none;
  color:var(--clr);
  z-index: 10;
  font-size: 2em;
  transition: 0.5s;
}
.footer-ul-label .footer-li-label:hover a
{
  font-size: 3em;
  filter: drop-shadow(0 0 20px var(--clr)) drop-shadow(0 0 40px var(--clr)) drop-shadow(0 0 60px var(--clr));
}
</style>
<div class="container-fluid p-0">
  <div class="register-banner">
    <div class="overlay">
      <div class="container">
        <div class="text">
          <h3>
            Sınırsız Eğlenceye Hazır mısın? <br>
            <span>Hemen ücretsiz kayıt ol ve tadını çıkar.</span>
          </h3>
        </div>
        <div class="buttons">
          <a class="animation-btn animation-btn-blue scrollbar-animation" href=""><span>KAYIT OL</span></a>
          <a class="animation-btn animation-btn-green scrollbar-animation" href=""><span>DAHA FAZLA BİLGİ</span></a>
        </div>
      </div>
    </div>
  </div>
</div>

  <footer>
    <div class="container">
      <div class="footer-col">
        <div class="logo">
          <img src="/images/footer-logo.svg" alt="">
        </div>
        <b>&copy; 2021 riva network®</b>
      </div>
      <div class="footer-col">
        <div class="title">Yasal</div>
        <div class="links">
          <a href="/hizmet-sartlari-ve-üyelik-sözlesmesi">Hizmet Şartları Ve <br>
            Üyelik Sözleşmesi</a>
          <a href="/gizlilik-politikasi">Gizlilik Politikası</a>
          <a href="/kvkk">K.V.K.K.</a>
        </div>
      </div>
      <div class="footer-col">
        <div class="title">Yararlı Linkler</div>
        <div class="links">
          <a href="https://minecraft.fandom.com/tr/wiki/Minecraft_Wiki">Minecraft Wiki</a>
          <a href="#">Riva Community</a>
          <a href="#">Yetkili ekibe katılmak <br>ister misin?</a>
        </div>
      </div>
      <div class="footer-col">
        <div class="title">Destek</div>
        <div class="links">
          <a href="/sikca-sorulan-sorular">Sıkça Sorulan Sorular</a>
          <a href="/yardim-merkezi">Yardım Merkezi</a>
          <a href="/icerik-üretici-politikasi">İçerik Üretici Politikası</a>
          <a href="/kurallar">Kurallar</a>
        </div>
      </div>
      <div class="footer-col">
        <div class="title">Kısayollar</div>
        <div class="links">
          <a href="/magaza">Market</a>
          <a href="/siralama">Sıralamalar</a>
          <a href="/hediye">Hediye Kodu</a>
          <a href="/kayit-ol">Kayıt Ol</a>
        </div>
      </div>
        <div class="buttons">
          <a class="animation-btn animation-btn-blue scrollbar-animation" href=""><span>RivaLauncher</span></a>
      </div>
    </div>
     <div class="footer-col" style="width: 600px !important;margin-top: 150px;margin-left:  auto;margin-right: auto;">
        <div class="socials">
         <ul class="footer-ul-label">
		<li class="footer-li-label" style="--clr:#1877f2;">
<?php if (($readSettings["footerFacebook"] != '0') || ($readSettings["footerTwitter"] != '0') || ($readSettings["footerInstagram"] != '0') || ($readSettings["footerYoutube"] != '0') || ($readSettings["footerDiscord"] != '0')): ?>
              <?php if ($readSettings["footerFacebook"] != '0'): ?>
			<a href="<?php echo $readSettings["footerFacebook"]; ?>" rel="external"><i class="fa-brands fa-facebook-f"></i></a>
		</li>
	    <li class="footer-li-label" style="--clr:#c43f3f;">
		<?php endif; ?>
        <?php if ($readSettings["footerYoutube"] != '0'): ?>
			<a href="<?php echo $readSettings["footerYoutube"]; ?>" rel="external"><i class="fa-brands fa-youtube"></i></a>
		</li>
		<li class="footer-li-label" style="--clr:#1da1f2;">
        <?php endif; ?>
        <?php if ($readSettings["footerTwitter"] != '0'): ?>
			<a href="<?php echo $readSettings["footerTwitter"]; ?>" rel="external"><i class="fa-brands fa-twitter"></i></a>
		</li>
        <?php endif; ?>
        <?php if ($readSettings["footerInstagram"] != '0'): ?>
		<li class="footer-li-label" style="--clr:#c32aa3;">
			<a href="<?php echo $readSettings["footerInstagram"]; ?>" rel="external"><i class="fa-brands fa-instagram"></i></a>
		</li>
		<?php endif; ?>
        <?php if ($readSettings["footerDiscord"] != '0'): ?>
		<li class="footer-li-label" style="--clr:#0a54b4;">
		<a href="<?php echo $readSettings["footerFacebook"]; ?>" rel="external"><i class="fa-brands fa-discord"></i></a>
		</li>
			</ul>
        </div>
        <?php endif; ?>
        <?php else: ?>
		<?php endif; ?>
  </footer>
  <script src="/js/slick/slick.min.js"></script>
  <script src="/js/main.js"></script>
  <script>

    $('.news-slider').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 1500,
      dots: true,
    });


  </script>
