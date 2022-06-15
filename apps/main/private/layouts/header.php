<?php
  if (isset($_POST["searchAccount"]) && post("search") != null) {
    go('/oyuncu/'.convertURL(post("search")));
  }
  if (isset($_SESSION["login"])) {
    $chestCount = $db->prepare("SELECT C.id FROM Chests C INNER JOIN Products P ON C.productID = P.id INNER JOIN Servers S ON P.serverID = S.id WHERE C.accountID = ? AND C.status = ?");
    $chestCount->execute(array($readAccount["id"], 0));
    $chestCount = $chestCount->rowCount();
  }

?>
<style type="text/css">
  <?php if ($readTheme["headerTheme"] == 2 || $readTheme["headerTheme"] == 3): ?>
    @media all and (min-width: 992px) {
      .navbar-dark .navbar-nav .nav-item {
        margin: .375rem .125rem;
      }
    }
  <?php endif; ?>
  .m-auto{
    margin: auto !important;
  }
  .justify-content-center {
      -ms-flex-pack: center!important;
      justify-content: center!important;
  }
  .d-flex {
      display: -ms-flexbox!important;
      display: flex!important;
  }
  iframe {
      padding: 0 0 0 0;
  }
  .mobile-menu.show {
      overflow-y: scroll;
  }
  button {
    border: none !important;
  }
  .primary-btn::after {
    width: 100%;
  }
</style>
<?php if ($readTheme["broadcastStatus"] == 1): ?>
  <?php $broadcast = $db->query("SELECT * FROM Broadcast ORDER BY id DESC"); ?>
  <?php if ($broadcast->rowCount() > 0): ?>
    <ul class="broadcast">
      <?php foreach ($broadcast as $readBroadcast): ?>
        <li class="broadcast-item">
          <a class="broadcast-link" href="<?php echo $readBroadcast["url"]; ?>"><?php echo $readBroadcast["title"]; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
<?php endif; ?>
  <style type="text/css">
    .modal-backdrop {
        width: 100% !important;
        height: 100% !important;
    }

    .d-none{
      display: none !important;
    }

    .slick-list.draggable {
        border-radius: 26px;
    }

    body {
        font-family: 'Nunito', sans-serif;
        height: 100%;
        background: #10171F;
    }

    .hero-nav-2 {
        margin-top: -126px;
        padding-right: 250px;
        padding-left: 250px;
    }
    .modal-content .close {
        color: #6387b0 !important;
        text-shadow: none;
        line-height: .675;
        cursor: pointer;
        outline: 0;
        opacity: .75;
        background: #212e3e !important;
        font-size: 32px;
        outline: none !important;
        border: none !important;
    }
    .modal-header{
      border-color: #212e3e !important;
    }
    .modal-open{overflow:hidden}.modal-open .modal{text-align: center;overflow-x:hidden;overflow-y:auto}.modal{position:fixed;top:0;left:0;z-index:1050;display:none;width:100%;height:100%;overflow:hidden;outline:0}.modal-dialog{position:relative;width:auto;margin:.5rem;pointer-events:none}.modal.fade .modal-dialog{transition:-webkit-transform .3s ease-out;transition:transform .3s ease-out;transition:transform .3s ease-out,-webkit-transform .3s ease-out;-webkit-transform:translate(0,-50px);transform:translate(0,-50px)}@media (prefers-reduced-motion:reduce){.modal.fade .modal-dialog{transition:none}}.modal.show .modal-dialog{-webkit-transform:none;transform:none}.modal.modal-static .modal-dialog{-webkit-transform:scale(1.02);transform:scale(1.02)}.modal-dialog-scrollable{display:-ms-flexbox;display:flex;max-height:calc(100% - 1rem)}.modal-dialog-scrollable .modal-content{max-height:calc(100vh - 1rem);overflow:hidden}.modal-dialog-scrollable .modal-footer,.modal-dialog-scrollable .modal-header{-ms-flex-negative:0;flex-shrink:0}.modal-dialog-scrollable .modal-body{overflow-y:auto}.modal-dialog-centered{display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;min-height:calc(100% - 1rem)}.modal-dialog-centered::before{display:block;height:calc(100vh - 1rem);height:-webkit-min-content;height:-moz-min-content;height:min-content;content:""}.modal-dialog-centered.modal-dialog-scrollable{-ms-flex-direction:column;flex-direction:column;-ms-flex-pack:center;justify-content:center;height:100%}.modal-dialog-centered.modal-dialog-scrollable .modal-content{max-height:none}.modal-dialog-centered.modal-dialog-scrollable::before{content:none}.modal-content{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;width:100%;pointer-events:auto;background-color: #10171f;background-clip:padding-box;border:1px solid rgba(0,0,0,.2);border-radius:.3rem;outline:0}.modal-backdrop{position:fixed;top:0;left:0;z-index:1040;width:100vw;height:100vh;background-color:#000}.modal-backdrop.fade{opacity:0}.modal-backdrop.show{opacity:.5}.modal-header{display:-ms-flexbox;display:flex;-ms-flex-align:start;align-items:flex-start;-ms-flex-pack:justify;justify-content:space-between;padding:1rem 1rem;border-bottom:1px solid #dee2e6;border-top-left-radius:calc(.3rem - 1px);border-top-right-radius:calc(.3rem - 1px)}.modal-header .close{padding:1rem 1rem;margin:-1rem -1rem -1rem auto}.modal-title{margin-bottom:0;line-height:1.5}.modal-body{position:relative;-ms-flex:1 1 auto;flex:1 1 auto;padding:1rem}.modal-footer{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-align:center;align-items:center;-ms-flex-pack:end;justify-content:flex-end;padding:.75rem;border-top:1px solid #dee2e6;border-bottom-right-radius:calc(.3rem - 1px);border-bottom-left-radius:calc(.3rem - 1px)}.modal-footer>*{margin:.25rem}.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}@media (min-width:576px){.modal-dialog{max-width:500px;margin:1.75rem auto}.modal-dialog-scrollable{max-height:calc(100% - 3.5rem)}.modal-dialog-scrollable .modal-content{max-height:calc(100vh - 3.5rem)}.modal-dialog-centered{min-height:calc(100% - 3.5rem)}.modal-dialog-centered::before{height:calc(100vh - 3.5rem);height:-webkit-min-content;height:-moz-min-content;height:min-content}.modal-sm{max-width:300px}}@media (min-width:992px){.modal-lg,.modal-xl{max-width:800px}}@media (min-width:1200px){.modal-xl{max-width:1140px}}
  </style>
  <!-- main hero start -->
  <div class="header-hero-wrapper">
    <div class="header-hero">
      <div class="hero-overlay">
        <div class="hero-logo-wrap">
          <div class="hero-logo">
            RIVA NETWORK
          </div>
        </div>
        <div class="hamburger-btn">
          <button class="burger" onclick="this.classList.toggle('active');"><span></span></button>
        </div>
      </div>
    </div>
    <div class="hero-nav-2">
      <div class="container">
        <nav>
          <ul>
            <li class="nav-link">
              <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="27.802" height="29.342" viewBox="0 0 27.802 29.342">
                  <path id="Path_1" data-name="Path 1"
                    d="M9.216,25.986V21.74a1.974,1.974,0,0,1,1.971-1.964h4a1.974,1.974,0,0,1,1.984,1.964h0V26a1.7,1.7,0,0,0,1.665,1.688h2.664a4.784,4.784,0,0,0,4.808-4.76h0V10.85A3.377,3.377,0,0,0,24.97,8.213L15.861.949a4.4,4.4,0,0,0-5.46,0L1.332,8.226A3.351,3.351,0,0,0,0,10.863V22.927a4.784,4.784,0,0,0,4.808,4.76H7.471a1.709,1.709,0,0,0,1.718-1.7h0"
                    transform="translate(0.75 0.905)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                </svg>
                Anasayfa
              </a>
            </li>
            <li class="nav-link">
              <a href="/oyun">
                <svg xmlns="http://www.w3.org/2000/svg" width="24.095" height="24.095" viewBox="0 0 24.095 24.095">
                  <g id="Iconly_Light_Game" data-name="Iconly/Light/Game" transform="translate(0.75 0.75)">
                    <g id="Game">
                      <line id="Stroke-1" y2="4.231" transform="translate(7.737 11.652)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <line id="Stroke-2" x1="4.317" transform="translate(5.579 13.768)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <line id="Stroke-3" x1="0.121" transform="translate(14.979 11.781)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <line id="Stroke-4" x1="0.121" transform="translate(17.028 15.819)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <path id="Stroke-5"
                        d="M6.072,0h0A1.53,1.53,0,0,0,7.618,1.515H8.811A2.375,2.375,0,0,1,11.2,3.855v.763"
                        transform="translate(0.788 0)" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                      <path id="Stroke-7"
                        d="M16.3,21.985q-5.093.086-10,0A6.033,6.033,0,0,1,0,15.827V10.574A6.033,6.033,0,0,1,6.3,4.415q4.942-.084,10,0a6.032,6.032,0,0,1,6.295,6.159v5.253A6.032,6.032,0,0,1,16.3,21.985Z"
                        transform="translate(0 0.567)" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                    </g>
                  </g>
                </svg>
                Oyunlar
              </a>
            </li>
            <li class="nav-link">
              <a href="/siralama">
                <svg xmlns="http://www.w3.org/2000/svg" width="24.095" height="24.095" viewBox="0 0 24.095 24.095">
                  <g id="Iconly_Light_Game" data-name="Iconly/Light/Game" transform="translate(0.75 0.75)">
                    <g id="Game">
                      <line id="Stroke-1" y2="4.231" transform="translate(7.737 11.652)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <line id="Stroke-2" x1="4.317" transform="translate(5.579 13.768)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <line id="Stroke-3" x1="0.121" transform="translate(14.979 11.781)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <line id="Stroke-4" x1="0.121" transform="translate(17.028 15.819)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <path id="Stroke-5"
                        d="M6.072,0h0A1.53,1.53,0,0,0,7.618,1.515H8.811A2.375,2.375,0,0,1,11.2,3.855v.763"
                        transform="translate(0.788 0)" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                      <path id="Stroke-7"
                        d="M16.3,21.985q-5.093.086-10,0A6.033,6.033,0,0,1,0,15.827V10.574A6.033,6.033,0,0,1,6.3,4.415q4.942-.084,10,0a6.032,6.032,0,0,1,6.295,6.159v5.253A6.032,6.032,0,0,1,16.3,21.985Z"
                        transform="translate(0 0.567)" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                    </g>
                  </g>
                </svg>
                Sıralama
              </a>
            </li>
            <li>
              <div class="riva-logo">
                <a href="/">
                  <img src="/images/footer-logo.svg" alt="">
                </a>
              </div>
            </li>
            <li class="nav-link">
              <a href="/magaza">
                <svg xmlns="http://www.w3.org/2000/svg" width="21.936" height="23.216" viewBox="0 0 21.936 23.216">
                  <g id="Iconly_Light_Bag" data-name="Iconly/Light/Bag" transform="translate(0.749 0.75)">
                    <g id="Bag">
                      <path id="Path_33955"
                        d="M15.728,21.9H6.3C2.833,21.9.175,20.653.93,15.618l.879-6.825C2.274,6.28,3.877,5.318,5.284,5.318h11.5c1.427,0,2.937,1.034,3.474,3.475l.879,6.825C21.777,20.085,19.192,21.9,15.728,21.9Z"
                        transform="translate(-0.801 -0.189)" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                      <path id="Path_33956"
                        d="M15.274,5.659A4.881,4.881,0,0,0,10.394.778h0a4.881,4.881,0,0,0-4.9,4.881h0"
                        transform="translate(-0.193 -0.778)" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                      <line id="Line_192" x1="0.052" transform="translate(13.5 9.969)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                      <line id="Line_193" x1="0.052" transform="translate(6.913 9.969)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    </g>
                  </g>
                </svg>
                Market
              </a>
            </li>
            <li class="nav-link">
              <a href="/destek"><svg xmlns="http://www.w3.org/2000/svg" width="23.979" height="23.979"
                  viewBox="0 0 23.979 23.979">
                  <g id="Iconly_Light_Chat" data-name="Iconly/Light/Chat" transform="translate(1.3 1.1)">
                    <g id="Chat">
                      <path id="Stroke-4"
                        d="M18.419,18.418A10.8,10.8,0,0,1,6.243,20.58a4.368,4.368,0,0,0-1.533-.429c-1.281.008-2.875,1.249-3.7.422s.414-2.424.414-3.712A4.31,4.31,0,0,0,1,15.335a10.792,10.792,0,1,1,17.42,3.083Z"
                        transform="translate(0 0)" fill="none" stroke="#fffbfb" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2.2" fill-rule="evenodd" />
                      <line id="Stroke-11" x2="0.01" transform="translate(15.04 11.235)" fill="none" stroke="#fffbfb"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" />
                      <line id="Stroke-13" x2="0.01" transform="translate(10.715 11.235)" fill="none" stroke="#fffbfb"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" />
                      <line id="Stroke-15" x2="0.01" transform="translate(6.389 11.235)" fill="none" stroke="#fffbfb"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" />
                    </g>
                  </g>
                </svg>
                Destek
              </a>
            </li>
            <li class="nav-link <?php if (isset($_SESSION["login"])): ?>has-dropdown<?php endif;?>">
              <?php if (isset($_SESSION["login"])): ?>
                <a href="#">
                  <?php echo $readAccount["realname"]; ?>
                  &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="15.791" height="8.895" viewBox="0 0 15.791 8.895">
                    <g id="Icon_feather-arrow-right" data-name="Icon feather-arrow-right"
                      transform="translate(1.414 7.895) rotate(-90)">
                      <path id="Path_31" data-name="Path 31" d="M24.481,7.5,18,13.981l6.481,6.481"
                        transform="translate(-18 -7.5)" fill="none" stroke="#fff" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" />
                    </g>
                  </svg>
                </a>
                <div class="profile-dropdown">
                  <a href="/profil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.042" height="22.817" viewBox="0 0 18.042 22.817">
                      <g id="Iconly_Light_Add-User" data-name="Iconly/Light/Add-User" transform="translate(0.6 0.6)">
                        <g id="Add-User">
                          <path id="Stroke-1"
                            d="M9.171,13.206c-4.542,0-8.421.686-8.421,3.437s3.855,3.462,8.421,3.462c4.543,0,8.421-.688,8.421-3.437S13.738,13.206,9.171,13.206Z"
                            transform="translate(-0.75 1.512)" fill="none" stroke="#fff" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                          <path id="Stroke-3" d="M8.706,11.545a5.378,5.378,0,1,0-.037,0Z"
                            transform="translate(-0.285 -0.75)" fill="none" stroke="#fff" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                        </g>
                      </g>
                    </svg>Profil
                  </a>
                  <a href="/kredi/yukle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20.339" height="18.872" viewBox="0 0 20.339 18.872">
                      <g id="Iconly_Light_Wallet" data-name="Iconly/Light/Wallet" transform="translate(-1.9 -2.4)">
                        <g id="Wallet" transform="translate(2.5 3)">
                          <path id="Stroke-1" d="M19.139,11.4H15.091a2.691,2.691,0,1,1,0-5.383h4.048" fill="none"
                            stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                            fill-rule="evenodd" />
                          <line id="Stroke-3" x1="0.312" transform="translate(15.237 8.643)" fill="none" stroke="#fff"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                          <path id="Stroke-5"
                            d="M5.248,0h8.643a5.248,5.248,0,0,1,5.248,5.248v7.177a5.248,5.248,0,0,1-5.248,5.248H5.248A5.248,5.248,0,0,1,0,12.425V5.248A5.248,5.248,0,0,1,5.248,0Z"
                            fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                            fill-rule="evenodd" />
                          <line id="Stroke-7" x2="5.399" transform="translate(4.536 4.538)" fill="none" stroke="#fff"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                        </g>
                      </g>
                    </svg>
                    Rivalet <?php echo $readAccount["credit"]; ?>
                    <span>+</span>
                  </a>
                  <a href="/sandik">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19.139" height="19.047" viewBox="0 0 19.139 19.047">
                      <g id="box" transform="translate(0 -0.173)">
                        <path id="Path_38" data-name="Path 38"
                          d="M9.792,1.412a.6.6,0,0,0-.445,0L2.208,4.267,9.569,7.211,16.93,4.267Zm8.151,3.74-7.775,3.11v9.476l7.775-3.11V5.153ZM8.971,17.739V8.261L1.2,5.152v9.477ZM8.9.3a1.794,1.794,0,0,1,1.333,0l8.527,3.412a.6.6,0,0,1,.375.555V14.629a1.2,1.2,0,0,1-.752,1.11L9.792,19.177a.6.6,0,0,1-.445,0L.753,15.739A1.2,1.2,0,0,1,0,14.629V4.267a.6.6,0,0,1,.376-.555Z"
                          fill="#fff" fill-rule="evenodd" />
                      </g>
                    </svg>
                    Sandık (<?php echo $chestCount; ?>)
                  </a>
                  <a href="/hediye">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17.31" height="18.653" viewBox="0 0 17.31 18.653">
                      <g id="gift-outline" transform="translate(-3.9 -2.775)">
                        <path id="Path_39" data-name="Path 39" d="M18,5.725v2.35h2.35A2.35,2.35,0,1,0,18,5.725Z"
                          transform="translate(-5.445 0)" fill="none" stroke="#fff" stroke-linecap="round"
                          stroke-miterlimit="10" stroke-width="1.2" />
                        <path id="Path_40" data-name="Path 40" d="M14.823,5.725v2.35h-2.35a2.35,2.35,0,1,1,2.35-2.35Z"
                          transform="translate(-2.268 0)" fill="none" stroke="#fff" stroke-linecap="round"
                          stroke-miterlimit="10" stroke-width="1.2" />
                        <path id="Path_41" data-name="Path 41"
                          d="M5.843,11.25H19.268a1.343,1.343,0,0,1,1.343,1.343v2.014a1.343,1.343,0,0,1-1.343,1.343H5.843A1.343,1.343,0,0,1,4.5,14.606V12.593A1.343,1.343,0,0,1,5.843,11.25Z"
                          transform="translate(0 -3.176)" fill="none" stroke="#fff" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="1.2" />
                        <path id="Path_42" data-name="Path 42"
                          d="M20.175,19.125v6.041a2.014,2.014,0,0,1-2.014,2.014h-9.4A2.014,2.014,0,0,1,6.75,25.166V19.125"
                          transform="translate(-0.907 -6.352)" fill="none" stroke="#fff" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="1.2" />
                        <path id="Path_43" data-name="Path 43" d="M18,11.25V24" transform="translate(-5.445 -3.176)"
                          fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                      </g>
                    </svg>
                    Hediye Kuponu
                  </a>
                  <?php if ($readAccount["permission"] == 1 || $readAccount["permission"] == 2 || $readAccount["permission"] == 3 || $readAccount["permission"] == 4 || $readAccount["permission"] == 5): ?>
                    <a href="/yonetim-paneli">
                      <i class="fa fa-dashboard" style="margin-right: 10px;"></i> 
                      Riva Yönetim Paneli
                    </a>
                  <?php endif; ?>
                  <a href="/cikis-yap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20.238" height="19.7" viewBox="0 0 20.238 19.7">
                      <g id="Iconly_Light_Upload" data-name="Iconly/Light/Upload"
                        transform="translate(19.638 0.6) rotate(90)">
                        <g id="Upload" transform="translate(0 19.038) rotate(-90)">
                          <path id="Stroke-1"
                            d="M12.244,4.618V3.685A3.685,3.685,0,0,0,8.559,0H3.684A3.685,3.685,0,0,0,0,3.685v11.13A3.685,3.685,0,0,0,3.684,18.5H8.569a3.675,3.675,0,0,0,3.675-3.674v-.943"
                            fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                            fill-rule="evenodd" />
                          <line id="Stroke-3" x1="12.041" transform="translate(6.997 9.25)" fill="none" stroke="#fff"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                          <path id="Stroke-5" d="M0,0,2.928,2.915,0,5.831" transform="translate(16.109 6.335)" fill="none"
                            stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                            fill-rule="evenodd" />
                        </g>
                      </g>
                    </svg>
                    Çıkış Yap
                  </a>
                </div>
              <?php else: ?>
                <a>
                  <span onclick="window.location='/kayit-ol';" style="cursor: pointer;margin-right: 5px;">Kayıt ol</span> / <span onclick="window.location='/giris-yap';" style="cursor: pointer;margin-left: 5px;">Giriş Yap</span>
                </a>
              <?php endif; ?>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

              <!-- Giriş Modal -->
              <div class="modal fade" id="girismodal" tabindex="-1" role="dialog" aria-labelledby="girismodalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content text-center">
                    <div class="modal-header" style="background: #10171f;color: gray;">
                      <button style="color: #1adbff;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="background: #10171f;">
                      <div class="riva-logo">
                        <a href="/" class="m-auto">
                          <img src="/images/footer-logo.svg" alt="">
                        </a><br><br><br><br>
                      </div>
                      <div class="buttons">
                        <a class="animation-btn animation-btn-green scrollbar-animation" href="/giris-yap" style="display: block !important; margin: auto !important;"><span>GİRİŞ YAP</span></a><br><br>
                        <a class="animation-btn animation-btn-blue scrollbar-animation" href="/kayit-ol" style="display: block !important; margin: auto !important;"><span>ÜYE OL</span></a>
                      </div>
                    </div>
                    <div class="modal-footer text-center pt-3" style="background: #10171f; border-color: #10171f; color: #7b9dc1;">
                      <br><p style="font-size: 17px;font-weight: 200;"><span style="font-weight: bold !important;color:White;">Riva Network'e katıl hayatını yaşa hemen kayıt ol ve eğlenceye katıl!</span></p>
                    </div>
                  </div>
                </div>
              </div>


  <div class="mobile-menu-bg"></div>
  <div class="mobile-menu">
    <button class="close-menu">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg"
        viewBox="0 0 16 16">
        <path
          d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
      </svg>
    </button>
    <div class="riva-logo">
      <a href="/">
        <img src="images/footer-logo.svg" alt="">
      </a>
    </div>
    <ul>
      <li class="nav-link active">
        <a href="/">
          <svg xmlns="http://www.w3.org/2000/svg" width="27.802" height="29.342" viewBox="0 0 27.802 29.342">
            <path id="Path_1" data-name="Path 1"
              d="M9.216,25.986V21.74a1.974,1.974,0,0,1,1.971-1.964h4a1.974,1.974,0,0,1,1.984,1.964h0V26a1.7,1.7,0,0,0,1.665,1.688h2.664a4.784,4.784,0,0,0,4.808-4.76h0V10.85A3.377,3.377,0,0,0,24.97,8.213L15.861.949a4.4,4.4,0,0,0-5.46,0L1.332,8.226A3.351,3.351,0,0,0,0,10.863V22.927a4.784,4.784,0,0,0,4.808,4.76H7.471a1.709,1.709,0,0,0,1.718-1.7h0"
              transform="translate(0.75 0.905)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="1.5" fill-rule="evenodd" />
          </svg>
          Anasayfa
        </a>
      </li>
      <li class="nav-link">
        <a href="/oyun">
          <svg xmlns="http://www.w3.org/2000/svg" width="24.095" height="24.095" viewBox="0 0 24.095 24.095">
            <g id="Iconly_Light_Game" data-name="Iconly/Light/Game" transform="translate(0.75 0.75)">
              <g id="Game">
                <line id="Stroke-1" y2="4.231" transform="translate(7.737 11.652)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <line id="Stroke-2" x1="4.317" transform="translate(5.579 13.768)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <line id="Stroke-3" x1="0.121" transform="translate(14.979 11.781)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <line id="Stroke-4" x1="0.121" transform="translate(17.028 15.819)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <path id="Stroke-5" d="M6.072,0h0A1.53,1.53,0,0,0,7.618,1.515H8.811A2.375,2.375,0,0,1,11.2,3.855v.763"
                  transform="translate(0.788 0)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                <path id="Stroke-7"
                  d="M16.3,21.985q-5.093.086-10,0A6.033,6.033,0,0,1,0,15.827V10.574A6.033,6.033,0,0,1,6.3,4.415q4.942-.084,10,0a6.032,6.032,0,0,1,6.295,6.159v5.253A6.032,6.032,0,0,1,16.3,21.985Z"
                  transform="translate(0 0.567)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
              </g>
            </g>
          </svg>
          Oyunlar
        </a>
      </li>
      <li class="nav-link">
        <a href="/siralama">
          <svg xmlns="http://www.w3.org/2000/svg" width="24.095" height="24.095" viewBox="0 0 24.095 24.095">
            <g id="Iconly_Light_Game" data-name="Iconly/Light/Game" transform="translate(0.75 0.75)">
              <g id="Game">
                <line id="Stroke-1" y2="4.231" transform="translate(7.737 11.652)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <line id="Stroke-2" x1="4.317" transform="translate(5.579 13.768)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <line id="Stroke-3" x1="0.121" transform="translate(14.979 11.781)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <line id="Stroke-4" x1="0.121" transform="translate(17.028 15.819)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <path id="Stroke-5" d="M6.072,0h0A1.53,1.53,0,0,0,7.618,1.515H8.811A2.375,2.375,0,0,1,11.2,3.855v.763"
                  transform="translate(0.788 0)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                <path id="Stroke-7"
                  d="M16.3,21.985q-5.093.086-10,0A6.033,6.033,0,0,1,0,15.827V10.574A6.033,6.033,0,0,1,6.3,4.415q4.942-.084,10,0a6.032,6.032,0,0,1,6.295,6.159v5.253A6.032,6.032,0,0,1,16.3,21.985Z"
                  transform="translate(0 0.567)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
              </g>
            </g>
          </svg>
          Sıralama
        </a>
      </li>
      <li class="nav-link">
        <a href="/magaza">
          <svg xmlns="http://www.w3.org/2000/svg" width="21.936" height="23.216" viewBox="0 0 21.936 23.216">
            <g id="Iconly_Light_Bag" data-name="Iconly/Light/Bag" transform="translate(0.749 0.75)">
              <g id="Bag">
                <path id="Path_33955"
                  d="M15.728,21.9H6.3C2.833,21.9.175,20.653.93,15.618l.879-6.825C2.274,6.28,3.877,5.318,5.284,5.318h11.5c1.427,0,2.937,1.034,3.474,3.475l.879,6.825C21.777,20.085,19.192,21.9,15.728,21.9Z"
                  transform="translate(-0.801 -0.189)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                <path id="Path_33956" d="M15.274,5.659A4.881,4.881,0,0,0,10.394.778h0a4.881,4.881,0,0,0-4.9,4.881h0"
                  transform="translate(-0.193 -0.778)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                <line id="Line_192" x1="0.052" transform="translate(13.5 9.969)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <line id="Line_193" x1="0.052" transform="translate(6.913 9.969)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
              </g>
            </g>
          </svg>
          Market
        </a>
      </li>
      <li class="nav-link">
        <a href="/destek"><svg xmlns="http://www.w3.org/2000/svg" width="23.979" height="23.979" viewBox="0 0 23.979 23.979">
            <g id="Iconly_Light_Chat" data-name="Iconly/Light/Chat" transform="translate(1.3 1.1)">
              <g id="Chat">
                <path id="Stroke-4"
                  d="M18.419,18.418A10.8,10.8,0,0,1,6.243,20.58a4.368,4.368,0,0,0-1.533-.429c-1.281.008-2.875,1.249-3.7.422s.414-2.424.414-3.712A4.31,4.31,0,0,0,1,15.335a10.792,10.792,0,1,1,17.42,3.083Z"
                  transform="translate(0 0)" fill="none" stroke="#fffbfb" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2.2" fill-rule="evenodd" />
                <line id="Stroke-11" x2="0.01" transform="translate(15.04 11.235)" fill="none" stroke="#fffbfb"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" />
                <line id="Stroke-13" x2="0.01" transform="translate(10.715 11.235)" fill="none" stroke="#fffbfb"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" />
                <line id="Stroke-15" x2="0.01" transform="translate(6.389 11.235)" fill="none" stroke="#fffbfb"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" />
              </g>
            </g>
          </svg>
          Destek
        </a>
      </li>
        <?php if (isset($_SESSION["login"])): ?>
          <li class="nav-link">
            <a href="/profil">
              <svg xmlns="http://www.w3.org/2000/svg" width="18.042" height="22.817" viewBox="0 0 18.042 22.817">
                <g id="Iconly_Light_Add-User" data-name="Iconly/Light/Add-User" transform="translate(0.6 0.6)">
                  <g id="Add-User">
                    <path id="Stroke-1"
                      d="M9.171,13.206c-4.542,0-8.421.686-8.421,3.437s3.855,3.462,8.421,3.462c4.543,0,8.421-.688,8.421-3.437S13.738,13.206,9.171,13.206Z"
                      transform="translate(-0.75 1.512)" fill="none" stroke="#fff" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                    <path id="Stroke-3" d="M8.706,11.545a5.378,5.378,0,1,0-.037,0Z"
                      transform="translate(-0.285 -0.75)" fill="none" stroke="#fff" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                  </g>
                </g>
              </svg>Profil
            </a>
          </li>
          <li class="nav-link">
            <a href="/kredi/yukle">
              <svg xmlns="http://www.w3.org/2000/svg" width="20.339" height="18.872" viewBox="0 0 20.339 18.872">
                <g id="Iconly_Light_Wallet" data-name="Iconly/Light/Wallet" transform="translate(-1.9 -2.4)">
                  <g id="Wallet" transform="translate(2.5 3)">
                    <path id="Stroke-1" d="M19.139,11.4H15.091a2.691,2.691,0,1,1,0-5.383h4.048" fill="none"
                      stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                      fill-rule="evenodd" />
                    <line id="Stroke-3" x1="0.312" transform="translate(15.237 8.643)" fill="none" stroke="#fff"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                    <path id="Stroke-5"
                      d="M5.248,0h8.643a5.248,5.248,0,0,1,5.248,5.248v7.177a5.248,5.248,0,0,1-5.248,5.248H5.248A5.248,5.248,0,0,1,0,12.425V5.248A5.248,5.248,0,0,1,5.248,0Z"
                      fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                      fill-rule="evenodd" />
                    <line id="Stroke-7" x2="5.399" transform="translate(4.536 4.538)" fill="none" stroke="#fff"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                  </g>
                </g>
              </svg>
              Kredi <?php echo $readAccount["credit"]; ?>
              <span>+</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="/sandik">
              <svg xmlns="http://www.w3.org/2000/svg" width="19.139" height="19.047" viewBox="0 0 19.139 19.047">
                <g id="box" transform="translate(0 -0.173)">
                  <path id="Path_38" data-name="Path 38"
                    d="M9.792,1.412a.6.6,0,0,0-.445,0L2.208,4.267,9.569,7.211,16.93,4.267Zm8.151,3.74-7.775,3.11v9.476l7.775-3.11V5.153ZM8.971,17.739V8.261L1.2,5.152v9.477ZM8.9.3a1.794,1.794,0,0,1,1.333,0l8.527,3.412a.6.6,0,0,1,.375.555V14.629a1.2,1.2,0,0,1-.752,1.11L9.792,19.177a.6.6,0,0,1-.445,0L.753,15.739A1.2,1.2,0,0,1,0,14.629V4.267a.6.6,0,0,1,.376-.555Z"
                    fill="#fff" fill-rule="evenodd" />
                </g>
              </svg>
              Sandık (<?php echo $chestCount; ?>)
            </a>
          </li>
          <li class="nav-link">
            <a href="/hediye">
              <svg xmlns="http://www.w3.org/2000/svg" width="17.31" height="18.653" viewBox="0 0 17.31 18.653">
                <g id="gift-outline" transform="translate(-3.9 -2.775)">
                  <path id="Path_39" data-name="Path 39" d="M18,5.725v2.35h2.35A2.35,2.35,0,1,0,18,5.725Z"
                    transform="translate(-5.445 0)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-miterlimit="10" stroke-width="1.2" />
                  <path id="Path_40" data-name="Path 40" d="M14.823,5.725v2.35h-2.35a2.35,2.35,0,1,1,2.35-2.35Z"
                    transform="translate(-2.268 0)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-miterlimit="10" stroke-width="1.2" />
                  <path id="Path_41" data-name="Path 41"
                    d="M5.843,11.25H19.268a1.343,1.343,0,0,1,1.343,1.343v2.014a1.343,1.343,0,0,1-1.343,1.343H5.843A1.343,1.343,0,0,1,4.5,14.606V12.593A1.343,1.343,0,0,1,5.843,11.25Z"
                    transform="translate(0 -3.176)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.2" />
                  <path id="Path_42" data-name="Path 42"
                    d="M20.175,19.125v6.041a2.014,2.014,0,0,1-2.014,2.014h-9.4A2.014,2.014,0,0,1,6.75,25.166V19.125"
                    transform="translate(-0.907 -6.352)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.2" />
                  <path id="Path_43" data-name="Path 43" d="M18,11.25V24" transform="translate(-5.445 -3.176)"
                    fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                </g>
              </svg>
              Hediye Kuponu
            </a>
          </li>
            <?php if ($readAccount["permission"] == 1 || $readAccount["permission"] == 2 || $readAccount["permission"] == 3 || $readAccount["permission"] == 4 || $readAccount["permission"] == 5): ?>
              <li class="nav-link">
                <a href="/yonetim-paneli">
                  <i class="fa fa-dashboard" style="margin-right: 10px;"></i> 
                  Yönetim Paneli
                </a>
              </li>
            <?php endif; ?>
            <li class="nav-link">
              <a href="/cikis-yap">
                <svg xmlns="http://www.w3.org/2000/svg" width="20.238" height="19.7" viewBox="0 0 20.238 19.7">
                  <g id="Iconly_Light_Upload" data-name="Iconly/Light/Upload"
                    transform="translate(19.638 0.6) rotate(90)">
                    <g id="Upload" transform="translate(0 19.038) rotate(-90)">
                      <path id="Stroke-1"
                        d="M12.244,4.618V3.685A3.685,3.685,0,0,0,8.559,0H3.684A3.685,3.685,0,0,0,0,3.685v11.13A3.685,3.685,0,0,0,3.684,18.5H8.569a3.675,3.675,0,0,0,3.675-3.674v-.943"
                        fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                        fill-rule="evenodd" />
                      <line id="Stroke-3" x1="12.041" transform="translate(6.997 9.25)" fill="none" stroke="#fff"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                      <path id="Stroke-5" d="M0,0,2.928,2.915,0,5.831" transform="translate(16.109 6.335)" fill="none"
                        stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                        fill-rule="evenodd" />
                    </g>
                  </g>
                </svg>
                Çıkış Yap
              </a>
            </li>
        <?php else: ?>
          <a href="#" data-toggle="modal" data-target="#girismodal">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19.795" viewBox="0 0 20 19.795">
              <g id="Iconly_Light_Add-User" data-name="Iconly/Light/Add-User" transform="translate(0.75 0.75)">
                <g id="Add-User">
                  <path id="Stroke-1"
                    d="M7.877,13.206c-3.844,0-7.127.581-7.127,2.909s3.263,2.93,7.127,2.93c3.845,0,7.127-.582,7.127-2.909S11.742,13.206,7.877,13.206Z"
                    transform="translate(-0.75 -0.75)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                  <path id="Stroke-3" d="M7.877,9.886a4.552,4.552,0,1,0-.031,0Z" transform="translate(-0.75 -0.75)"
                    fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    fill-rule="evenodd" />
                  <line id="Stroke-5" y2="4.01" transform="translate(16.454 5.919)" fill="none" stroke="#fff"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                  <line id="Stroke-7" x1="4.09" transform="translate(14.41 7.924)" fill="none" stroke="#fff"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                </g>
              </g>
            </svg>
            Kayıt 
            <svg xmlns="http://www.w3.org/2000/svg" width="18.477" height="20" viewBox="0 0 18.477 20">
              <g id="Iconly_Light_Login" data-name="Iconly/Light/Login" transform="translate(0.75 0.75)">
                <g id="Login">
                  <line id="Stroke-1" x1="12.041" transform="translate(0 9.25)" fill="none" stroke="#fff"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                  <path id="Stroke-3" d="M9.885,7.106l2.928,2.916L9.885,12.938" transform="translate(-0.771 -0.772)"
                    fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    fill-rule="evenodd" />
                  <path id="Stroke-4"
                    d="M5.5,5.389V4.456A3.684,3.684,0,0,1,9.189.772h4.884a3.675,3.675,0,0,1,3.675,3.675v11.14a3.685,3.685,0,0,1-3.685,3.685H9.178A3.675,3.675,0,0,1,5.5,15.6v-.942"
                    transform="translate(-0.771 -0.772)" fill="none" stroke="#fff" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.5" fill-rule="evenodd" />
                </g>
              </g>
            </svg>
            Giriş
          </a>
        <?php endif; ?>
      </li>
    </ul>
  </div>
<!--
  <?php if ($readTheme["headerTheme"] == 2 || $readTheme["headerTheme"] == 3): ?>
    <div class="header-banner">
      <div class="<?php echo ($readTheme["headerStyle"] == 1) ? 'container' : 'container-fluid'; ?>">
        <div class="header-banner-content flex-lg-row flex-column">
          <div class="d-flex flex-column <?php echo ($readTheme["headerTheme"] == 3) ? 'order-2' : 'order-lg-1 order-2'; ?> text-center text-uppercase mt-lg-0 mt-4">
            <div>
              </a>
            </div>
              </button>
            </div>
            <div>
            </div>
          </div>
          <div class="d-flex flex-column overflow-hidden <?php echo ($readTheme["headerTheme"] == 3) ? 'order-1' : 'order-lg-2 order-1'; ?>">
            <div class="<?php echo ($readTheme["headerTheme"] == 2) ? 'zoom-hover' : null; ?> text-center">
              <a href="/">
                <img src="/apps/main/public/assets/img/extras/header-logo.png" class="header-banner-logo" alt="<?php echo $serverName; ?> Logo">
              </a>
            </div>
          </div>
          <?php if ($readTheme["headerTheme"] == 2): ?>
            <div class="d-lg-flex d-none flex-column order-3 text-center">
              <div>
                </a>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <header class="header sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-none">
      <div class="<?php echo ($readTheme["headerStyle"] == 1) ? 'container' : 'container-fluid'; ?>">
        <a class="navbar-brand <?php echo (($readSettings["headerLogoType"] == 2) ? 'image' : null); ?> <?php echo ($readTheme["headerTheme"] == 2 || $readTheme["headerTheme"] == 3) ? 'd-inline-block d-lg-none' : null; ?>" href="/">
          <?php if ($readSettings["headerLogoType"] == 1): ?>
            <?php echo $serverName; ?>
          <?php elseif ($readSettings["headerLogoType"] == 2): ?>
            <img src="/apps/main/public/assets/img/extras/logo.png" alt="<?php echo $serverName; ?> Logo">
          <?php else: ?>
            <?php echo $serverName; ?>
          <?php endif; ?>
        </a>
        <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-between align-items-center w-100" id="navbarSupportedContent">
          <ul id="navbarMainContent" class="nav navbar-nav text-center <?php echo ($readTheme["headerTheme"] == 1) ? 'mx-auto' : null; ?> <?php echo ($readTheme["headerTheme"] == 2 || $readTheme["headerTheme"] == 3) ? 'justify-content-between w-100' : null; ?>">
            <?php
              $activatedStatus = false;
              $headerJSON = json_decode($readTheme["header"], true);
            ?>
            <?php foreach ($headerJSON as $readHeader): ?>
              <?php if ($readHeader["pagetype"] == "support"): ?>
                <?php if (isset($_SESSION["login"])): ?>
                  <?php
                    $unreadMessages = $db->prepare("SELECT S.id FROM Supports S INNER JOIN SupportCategories SC ON S.categoryID = SC.id INNER JOIN Servers Se ON S.serverID = Se.id WHERE S.statusID = ? AND S.readStatus = ? AND S.accountID = ?");
                    $unreadMessages->execute(array(2, 0, $readAccount["id"]));
                  ?>
                  <?php if ($unreadMessages->rowCount() > 0): ?>
                    <?php $readHeader["title"].=" <span>(".$unreadMessages->rowCount().")</span>"; ?>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
              <?php if ($readHeader["pagetype"] == "chest"): ?>
                <?php if (isset($_SESSION["login"])): ?>
                  <?php if ($chestCount > 0): ?>
                    <?php $readHeader["title"].=" <span>(".$chestCount.")</span>"; ?>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
              <?php if (isset($readHeader["children"])): ?>
                <li class="nav-item dropdown <?php echo (((get("route") == $readHeader["pagetype"]) && ($activatedStatus == false)) ? "active" : null); ?>">
                  <a class="nav-link dropdown-toggle" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="<?php echo $readHeader["icon"]; ?>"></i> <?php echo $readHeader["title"]; ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach ($readHeader["children"] as $readHeaderChildren): ?>
                      <a class="dropdown-item" href="<?php echo $readHeaderChildren["url"]; ?>" <?php echo (($readHeaderChildren["tabstatus"] == 1) ? "rel=\"external\"" : null); ?>><?php echo $readHeaderChildren["title"]; ?></a>
                    <?php endforeach; ?>
                  </div>
                </li>
              <?php else: ?>
                <li class="nav-item <?php echo (((get("route") == $readHeader["pagetype"]) && ($activatedStatus == false)) ? "active" : null); ?>">
                  <a class="nav-link" href="<?php echo $readHeader["url"]; ?>" <?php echo (($readHeader["tabstatus"] == 1) ? "rel=\"external\"" : null); ?>><i class="<?php echo $readHeader["icon"]; ?>"></i> <?php echo $readHeader["title"]; ?></a>
                </li>
              <?php endif; ?>
              <?php if (get("route") == $readHeader["pagetype"]): ?>
                <?php $activatedStatus = true; ?>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if (isset($_SESSION["login"])): ?>
              <?php if ($readTheme["headerTheme"] == 2 || $readTheme["headerTheme"] == 3): ?>
                <li class="nav-item dropdown pc <?php echo ((get("route") == "profile") ? "active" : null); ?>">
                  <a id="profileDropdown" class="nav-link dropdown-toggle <?php echo ((get("route") == "profile") ? "active" : null); ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="/">
                    <div class="d-inline-flex align-items-center">
                      <?php echo minecraftHead($readSettings["avatarAPI"], $readAccount["realname"], 14, "mr-1"); ?>
                      <?php echo $readAccount["realname"]; ?>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/profil">
                      <i class="fa fa-user-circle mr-1"></i>
                      <span>Profil</span>
                    </a>
                    <a class="dropdown-item" href="/kredi/yukle">
                      <i class="fa fa-money mr-1"></i>
                      <span>Kredi: <strong><?php echo $readAccount["credit"]; ?> <i class="fa fa-plus-circle text-success"></i></strong></span>
                    </a>
                    <a class="dropdown-item" href="/sandik">
                      <i class="fa fa-archive mr-1"></i>
                      <span>Sandık (<?php echo $chestCount; ?>)</span>
                    </a>
                    <a class="dropdown-item" href="/carkifelek">
                      <i class="fa fa-pie-chart mr-1"></i>
                      <span>Çarkıfelek</span>
                    </a>
                    <a class="dropdown-item" href="/hediye">
                      <i class="fa fa-gift mr-1"></i>
                      <span>Hediye Kuponu</span>
                    </a>
                    <?php if ($readAccount["permission"] == 1 || $readAccount["permission"] == 2 || $readAccount["permission"] == 3 || $readAccount["permission"] == 4 || $readAccount["permission"] == 5): ?>
                      <a class="dropdown-item" rel="external" href="/yonetim-paneli">
                        <i class="fa fa-dashboard mr-1"></i>
                        <span>Yönetim Paneli</span>
                      </a>
                    <?php endif; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/cikis-yap">
                      <i class="fa fa-sign-out mr-1"></i>
                      <span>Çıkış Yap</span>
                    </a>
                  </div>
                </li>
              <?php endif; ?>
              <li class="nav-item mobil <?php echo ((get("route") == 'profile') ? 'active' : null); ?>">
                <a class="nav-link" href="/profil">
                  <i class="fa fa-user-circle"></i>
                  <span>Profil</span>
                </a>
              </li>
              <li class="nav-item mobil">
                <a class="nav-link" href="/kredi/yukle">
                  <i class="fa fa-money"></i>
                  <span>Kredi: <strong><?php echo $readAccount["credit"]; ?></strong></span>
                </a>
              </li>
              <li class="nav-item mobil <?php echo ((get("route") == 'chest') ? 'active' : null); ?>">
                <a class="nav-link" href="/sandik">
                  <i class="fa fa-archive"></i>
                  <span>Sandık (<?php echo $chestCount; ?>)</span>
                </a>
              </li>
              <li class="nav-item mobil <?php echo ((get("route") == 'lottery') ? 'active' : null); ?>">
                <a class="nav-link" href="/carkifelek">
                  <i class="fa fa-pie-chart"></i>
                  <span>Çarkıfelek</span>
                </a>
              </li>
              <li class="nav-item mobil <?php echo ((get("route") == 'gift') ? 'active' : null); ?>">
                <a class="nav-link" href="/hediye">
                  <i class="fa fa-gift"></i>
                  <span>Hediye Kuponu</span>
                </a>
              </li>
              <?php if ($readAccount["permission"] == 1 || $readAccount["permission"] == 2 || $readAccount["permission"] == 3 || $readAccount["permission"] == 4 || $readAccount["permission"] == 5): ?>
                <li class="nav-item mobil">
                  <a class="nav-link" href="/yonetim-paneli">
                    <i class="fa fa-dashboard"></i>
                    <span>Yönetim Paneli</span>
                  </a>
                </li>
              <?php endif; ?>
              <li class="nav-item mobil">
                <a class="nav-link" href="/cikis-yap">
                  <i class="fa fa-sign-out"></i>
                  <span>Çıkış Yap</span>
                </a>
              </li>
            <?php else : ?>
              <?php if ($readTheme["headerTheme"] == 2 || $readTheme["headerTheme"] == 3): ?>
                <li class="nav-item pc <?php echo ((get("route") == 'login') ? 'active' : null); ?>">
                  <a class="nav-link" href="/giris-yap">
                    <i class="fa fa-sign-in"></i>
                    Giriş Yap
                  </a>
                </li>
                <li class="nav-item pc <?php echo ((get("route") == 'register') ? 'active' : null); ?>">
                  <a class="nav-link" href="/kayit-ol">
                    <i class="fa fa-user-plus"></i>
                    Kayıt Ol
                  </a>
                </li>
              <?php endif; ?>
              <li class="nav-item mobil <?php echo ((get("route") == 'login') ? 'active' : null); ?>">
                <a class="nav-link" href="/giris-yap">
                  <i class="fa fa-sign-in"></i>
                  <span>Giriş Yap</span>
                </a>
              </li>
              <li class="nav-item mobil <?php echo ((get("route") == 'register') ? 'active' : null); ?>">
                <a class="nav-link" href="/kayit-ol">
                  <i class="fa fa-user-plus"></i>
                  <span>Kayıt Ol</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if ($readTheme["headerTheme"] == 2 || $readTheme["headerTheme"] == 3): ?>
              <li class="nav-item nav-search pc">
                <a class="nav-link" href="/">
                  <form action="" method="post">
                    <div class="searchbar">
                      <input class="search-input" type="text" name="search" placeholder="Oyuncu Ara" autocomplete="off" required="required">
                      <button type="submit" name="searchAccount" class="theme-color btn search-icon">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </form>
                </a>
              </li>
            <?php endif; ?>
            <li class="nav-item mobil">
              <a class="nav-link" href="/" style="background-color: transparent !important; border-color: transparent !important;">
                <form action="" method="post">
                  <div class="input-group mb-2">
                    <input type="text" name="search" placeholder="Oyuncu Ara" class="form-control" aria-label="Oyuncu Ara" aria-describedby="basic-addon2" required="required">
                    <div class="input-group-append">
                      <button type="submit" name="searchAccount" class="theme-color btn btn-primary">Ara</button>
                    </div>
                  </div>
                </form>
              </a>
            </li>
          </ul>
          <?php if ($readTheme["headerTheme"] == 1): ?>
            <ul class="nav navbar-nav navbar-right navbar-buttons flex-row justify-content-center flex-nowrap">
              <?php if (isset($_SESSION["login"])): ?>
                <li class="nav-item dropdown pc <?php echo ((get("route") == "profile") ? "active" : null); ?>">
                  <a id="profileDropdown" class="nav-link dropdown-toggle <?php echo ((get("route") == "profile") ? "active" : null); ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="/">
                    <div class="d-inline-flex align-items-center">
                      <?php echo minecraftHead($readSettings["avatarAPI"], $readAccount["realname"], 14, "mr-1"); ?>
                      <?php echo $readAccount["realname"]; ?>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/profil">
                      <i class="fa fa-user-circle mr-1"></i>
                      <span>Profil</span>
                    </a>
                    <a class="dropdown-item" href="/kredi/yukle">
                      <i class="fa fa-money mr-1"></i>
                      <span>Kredi: <strong><?php echo $readAccount["credit"]; ?> <i class="fa fa-plus-circle text-success"></i></strong></span>
                    </a>
                    <a class="dropdown-item" href="/sandik">
                      <i class="fa fa-archive mr-1"></i>
                      <span>Sandık (<?php echo $chestCount; ?>)</span>
                    </a>
                    <a class="dropdown-item" href="/carkifelek">
                      <i class="fa fa-pie-chart mr-1"></i>
                      <span>Çarkıfelek</span>
                    </a>
                    <a class="dropdown-item" href="/hediye">
                      <i class="fa fa-gift mr-1"></i>
                      <span>Hediye Kuponu</span>
                    </a>
                    <?php if ($readAccount["permission"] == 1 || $readAccount["permission"] == 2 || $readAccount["permission"] == 3 || $readAccount["permission"] == 4 || $readAccount["permission"] == 5): ?>
                      <a class="dropdown-item" rel="external" href="/yonetim-paneli">
                        <i class="fa fa-dashboard mr-1"></i>
                        <span>Yönetim Paneli</span>
                      </a>
                    <?php endif; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/cikis-yap" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?');">
                      <i class="fa fa-sign-out mr-1"></i>
                      <span>Çıkış Yap</span>
                    </a>
                  </div>
                </li>
              <?php else : ?>
                <li class="nav-item pc">
                  <a class="nav-link" href="/giris-yap">Giriş Yap</a>
                </li>
                <li class="nav-item pc active">
                  <a class="nav-link" href="/kayit-ol">Kayıt Ol</a>
                </li>
              <?php endif; ?>
              <li class="nav-item nav-search pc">
                <a class="nav-link" href="/">
                  <form action="" method="post">
                    <div class="searchbar">
                      <input class="search-input" type="text" name="search" placeholder="Oyuncu Ara" autocomplete="off" required="required">
                      <button type="submit" name="searchAccount" class="theme-color btn search-icon">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </form>
                </a>
              </li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </nav>
    <?php if ($readTheme["headerTheme"] == 1): ?>
      <nav class="navbar navbar-server" data-toggle="onlinebox">
        <div class="<?php echo ($readTheme["headerStyle"] == 1) ? 'container' : 'container-fluid'; ?>">
          <div class="navbar-online">
            Çevrimiçi: <span data-toggle="onlinetext" server-ip="<?php echo $serverIP; ?>">-/-</span>
          </div>
          <div class="navbar-ip" data-toggle="copyip" data-clipboard-action="copy" data-clipboard-text="<?php echo $serverIP; ?>">
            <span class="py-2" data-toggle="tooltip" data-placement="bottom" title="Sunucu Adresini Kopyala">
              <?php echo $serverIP; ?>
            </span>
          </div>
          <div class="navbar-version">
            Sürüm: <?php echo $serverVersion; ?>
          </div>
        </div>
      </nav>
    <?php endif; ?>
  </header>
-->
<!-- Preloader -->
<?php if ($readSettings["preloaderStatus"] == 1): ?>
  <div id="preloader">
    <div class="spinner-border" role="status">
      <span class="sr-only">Yükleniyor...</span>
    </div>
  </div>
<?php endif; ?>
