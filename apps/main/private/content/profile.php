<?php
  if (!isset($_SESSION["login"])) {
    go("/giris-yap");
  }
?>
<div class="gap"></div>
<div class="profile-page-wrapper">
    <div class="container">
      <div class="profile-sidebar">
        <div class="user-profile">
          <div class="pic-wrap">
            <div class="pic">
              <img src="https://mc-heads.net/avatar/<?php echo $readAccount["realname"]; ?>/100" alt="<?php echo $readAccount["realname"]; ?>">
            </div>
          </div>
          <div class="name"><?php echo $readAccount["realname"]; ?></div>
          <div class="rank-wrap">
            <div class="rank">
              <span><?php echo permissionTag($readAccount["permission"]); ?></span>
            </div>
            <!--
            <div class="rank">
              <img src="images/valorantgold.png" alt="">
              <div class="rank-tooltip">
                <p><span>Seviye:</span> Altın 3</p>
                <p><span>Tecrübe Puanı:</span> 0 TP</p>
                <p><span>Sonraki Seviye:</span> 0 TP</p>
              </div>
            </div>
              -->
          </div>
        </div>

        <div class="profile-links">
          <div class="subtitle">Hesap Ayarları</div>
          <a href="/profil/duzenle" class="active">
            <svg xmlns="http://www.w3.org/2000/svg" width="19.307" height="18.907" viewBox="0 0 19.307 18.907">
              <g id="Edit" transform="translate(0.657 0.814)">
                <line id="Stroke-1" x2="7.253" transform="translate(10.747 17.443)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-3"
                  d="M9.78.795A2.245,2.245,0,0,1,12.9.492L14.63,1.839a2.142,2.142,0,0,1,.72,2.984c-.034.055-9.537,11.942-9.537,11.942A1.7,1.7,0,0,1,4.5,17.4l-3.639.046-.82-3.471A1.629,1.629,0,0,1,.36,12.577Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-5" x2="5.452" y2="4.187" transform="translate(8.021 3.001)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Profili düzenle
          </a>
          <a href="/profil/duzenle">
            <svg xmlns="http://www.w3.org/2000/svg" width="17.21" height="20.633" viewBox="0 0 17.21 20.633">
              <g id="Unlock" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M12.323,3.2A4.768,4.768,0,0,0,3.052,4.735V7" transform="translate(0.137 0)"
                  fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"
                  fill-rule="evenodd" />
                <path id="Stroke-3"
                  d="M11.947,19.035H3.963A3.963,3.963,0,0,1,0,15.071V10.59A3.963,3.963,0,0,1,3.963,6.626h7.985A3.963,3.963,0,0,1,15.91,10.59v4.481A3.963,3.963,0,0,1,11.947,19.035Z"
                  transform="translate(0 0.298)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-5" y2="2.322" transform="translate(7.955 11.968)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Şifreyi Değiştir
          </a>
          <a href="/profil/duzenle">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            E-Posta
          </a>
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Abonelikler
          </a>
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Skin Değiştir
          </a>
          <hr>
          <div class="subtitle">Ayrıntılar</div>
          <a href="#nav-credit-history">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Ödeme Geçmişim
          </a>
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            RV Geçmişim
          </a>
          <a href="#nav-credit-history">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Coin Geçmişim
          </a>
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Hesap Kayıtlarım
          </a>
          <a href="/cezalar">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.3" height="19.768" viewBox="0 0 21.3 19.768">
              <g id="Wallet" transform="translate(0.65 0.65)">
                <path id="Stroke-1" d="M19.442,11.638h-4.23a2.812,2.812,0,1,1,0-5.625h4.23"
                  transform="translate(0.558 0.27)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-3" x1="0.326" transform="translate(15.922 9.032)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
                <path id="Stroke-5"
                  d="M5.484,0h9.032A5.484,5.484,0,0,1,20,5.484v7.5a5.484,5.484,0,0,1-5.484,5.484H5.484A5.484,5.484,0,0,1,0,12.984v-7.5A5.484,5.484,0,0,1,5.484,0Z"
                  transform="translate(0 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.3" fill-rule="evenodd" />
                <line id="Stroke-7" x2="5.642" transform="translate(4.74 4.742)" fill="none" stroke="#fff"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Ceza Geçmişim
          </a>
        </div>

        <div class="logout-btn">
          <a href="/cikis-yap">
            <svg xmlns="http://www.w3.org/2000/svg" width="20.065" height="20.065" viewBox="0 0 20.065 20.065">
              <g id="Icon_feather-log-out" data-name="Icon feather-log-out" transform="translate(0.65 0.65)">
                <path id="Path_90" data-name="Path 90"
                  d="M10.755,23.265H6.585A2.085,2.085,0,0,1,4.5,21.18V6.585A2.085,2.085,0,0,1,6.585,4.5h4.17"
                  transform="translate(-4.5 -4.5)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" />
                <path id="Path_91" data-name="Path 91" d="M24,20.926l5.213-5.213L24,10.5"
                  transform="translate(-10.447 -6.33)" fill="none" stroke="#fff" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.3" />
                <path id="Path_92" data-name="Path 92" d="M26.011,18H13.5" transform="translate(-7.245 -8.617)"
                  fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" />
              </g>
            </svg>
            Çıkış yap
          </a>
        </div>
      </div>
      <div class="profile-card-wrapper">

        <div class="profile-card no-pad">
          <div class="card-header center">
            <div class="left">
              <h4>Faction</h4>
            </div>

          </div>

          <div class="card-content">

            <div class="profile-table  table-2">
              <table>
                <thead>
                  <tr>
                    <th>Sıra</th>
                    <th>Kafa</th>
                    <th>Kullanıcı Adı</th>
                    <th>Öldürme</th>
                    <th>Ölme</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#1</td>
                    <td><img src="images/mc-head1.svg" alt=""></td>
                    <td>BukiBurti</td>
                    <td>24.000</td>
                    <td><span>4.213</span></td>
                  </tr>
                </tbody>
              </table>
            </div>



          </div>

        </div>


        <div class="profile-card no-pad">
          <div class="card-header">
            <div class="left">
              Destek Mesajları
            </div>
          </div>

          <div class="card-content">
            <div class="profile-table table-2">
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Güncelleme</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Merhabalar</td>
                    <td>Ödeme Bildirimi</td>
                    <td>7 Saat Önce</td>
                    <td><span class="badge">Cevaplandı</span></td>
                    <td>
                      <a href="#" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.769" height="17.437"
                          viewBox="0 0 21.769 17.437">
                          <g id="Show" transform="translate(0.6 0.6)">
                            <path id="Stroke-1"
                              d="M6.838,8.407a3.515,3.515,0,1,0,3.516-3.516A3.515,3.515,0,0,0,6.838,8.407Z"
                              transform="translate(-0.069 -0.288)" fill="none" stroke="#1daf79" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                            <path id="Stroke-3"
                              d="M11.037,16.988C6.8,16.988,2.93,13.944.75,8.87,2.93,3.8,6.8.751,11.037.751h0c4.234,0,8.107,3.044,10.287,8.119-2.18,5.074-6.053,8.119-10.287,8.119Z"
                              transform="translate(-0.75 -0.751)" fill="none" stroke="#1daf79" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                          </g>
                        </svg>
                      </a>
                      <a href="#" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.055" height="21.769"
                          viewBox="0 0 20.055 21.769">
                          <g id="Group_432" data-name="Group 432" transform="translate(-79.12 -7.774)">
                            <path id="Stroke-1"
                              d="M2.134,7.468s.6,7.488.954,10.643A2.488,2.488,0,0,0,5.71,20.528c2.9.052,5.8.056,8.7-.006a2.462,2.462,0,0,0,2.545-2.4c.352-3.182.953-10.65.953-10.65"
                              transform="translate(79.124 8.375)" fill="none" stroke="#ff5509" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                            <line id="Stroke-3" x2="18.855" transform="translate(79.72 12.253)" fill="none"
                              stroke="#ff5509" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                            <path id="Stroke-5"
                              d="M4.018,4.63a1.832,1.832,0,0,0,1.8-1.472l.27-1.352A1.423,1.423,0,0,1,7.459.751h4.706a1.423,1.423,0,0,1,1.375,1.055l.27,1.352a1.832,1.832,0,0,0,1.8,1.472"
                              transform="translate(79.335 7.623)" fill="none" stroke="#ff5509" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                          </g>
                        </svg>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Merhabalar</td>
                    <td>Ödeme Bildirimi</td>
                    <td>7 Saat Önce</td>
                    <td><span class="badge">Cevaplandı</span></td>
                    <td>
                      <a href="#" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.769" height="17.437"
                          viewBox="0 0 21.769 17.437">
                          <g id="Show" transform="translate(0.6 0.6)">
                            <path id="Stroke-1"
                              d="M6.838,8.407a3.515,3.515,0,1,0,3.516-3.516A3.515,3.515,0,0,0,6.838,8.407Z"
                              transform="translate(-0.069 -0.288)" fill="none" stroke="#1daf79" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                            <path id="Stroke-3"
                              d="M11.037,16.988C6.8,16.988,2.93,13.944.75,8.87,2.93,3.8,6.8.751,11.037.751h0c4.234,0,8.107,3.044,10.287,8.119-2.18,5.074-6.053,8.119-10.287,8.119Z"
                              transform="translate(-0.75 -0.751)" fill="none" stroke="#1daf79" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                          </g>
                        </svg>
                      </a>
                      <a href="#" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.055" height="21.769"
                          viewBox="0 0 20.055 21.769">
                          <g id="Group_432" data-name="Group 432" transform="translate(-79.12 -7.774)">
                            <path id="Stroke-1"
                              d="M2.134,7.468s.6,7.488.954,10.643A2.488,2.488,0,0,0,5.71,20.528c2.9.052,5.8.056,8.7-.006a2.462,2.462,0,0,0,2.545-2.4c.352-3.182.953-10.65.953-10.65"
                              transform="translate(79.124 8.375)" fill="none" stroke="#ff5509" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                            <line id="Stroke-3" x2="18.855" transform="translate(79.72 12.253)" fill="none"
                              stroke="#ff5509" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                            <path id="Stroke-5"
                              d="M4.018,4.63a1.832,1.832,0,0,0,1.8-1.472l.27-1.352A1.423,1.423,0,0,1,7.459.751h4.706a1.423,1.423,0,0,1,1.375,1.055l.27,1.352a1.832,1.832,0,0,0,1.8,1.472"
                              transform="translate(79.335 7.623)" fill="none" stroke="#ff5509" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                          </g>
                        </svg>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <div class="profile-card no-pad">
          <div class="card-header">
            <div class="left">
              Hediye Geçmişi
            </div>
          </div>

          <div class="card-content">
            <div class="profile-table table-2">
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Kimden</th>
                    <th>Kaç Adet</th>
                    <th>Ne Zaman</th>
                    <th>Ne Kadar</th>
                    <th>İşlem</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>AfacaAli</td>
                    <td>02 Adet</td>
                    <td>7 Tmz. 2021</td>
                    <td>500.000</td>
                    <td>
                      <a href="#" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.769" height="17.437"
                          viewBox="0 0 21.769 17.437">
                          <g id="Show" transform="translate(0.6 0.6)">
                            <path id="Stroke-1"
                              d="M6.838,8.407a3.515,3.515,0,1,0,3.516-3.516A3.515,3.515,0,0,0,6.838,8.407Z"
                              transform="translate(-0.069 -0.288)" fill="none" stroke="#1daf79" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                            <path id="Stroke-3"
                              d="M11.037,16.988C6.8,16.988,2.93,13.944.75,8.87,2.93,3.8,6.8.751,11.037.751h0c4.234,0,8.107,3.044,10.287,8.119-2.18,5.074-6.053,8.119-10.287,8.119Z"
                              transform="translate(-0.75 -0.751)" fill="none" stroke="#1daf79" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                          </g>
                        </svg>
                      </a>
                      <a href="#" class="action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.055" height="21.769"
                          viewBox="0 0 20.055 21.769">
                          <g id="Group_432" data-name="Group 432" transform="translate(-79.12 -7.774)">
                            <path id="Stroke-1"
                              d="M2.134,7.468s.6,7.488.954,10.643A2.488,2.488,0,0,0,5.71,20.528c2.9.052,5.8.056,8.7-.006a2.462,2.462,0,0,0,2.545-2.4c.352-3.182.953-10.65.953-10.65"
                              transform="translate(79.124 8.375)" fill="none" stroke="#ff5509" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                            <line id="Stroke-3" x2="18.855" transform="translate(79.72 12.253)" fill="none"
                              stroke="#ff5509" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" />
                            <path id="Stroke-5"
                              d="M4.018,4.63a1.832,1.832,0,0,0,1.8-1.472l.27-1.352A1.423,1.423,0,0,1,7.459.751h4.706a1.423,1.423,0,0,1,1.375,1.055l.27,1.352a1.832,1.832,0,0,0,1.8,1.472"
                              transform="translate(79.335 7.623)" fill="none" stroke="#ff5509" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.2" fill-rule="evenodd" />
                          </g>
                        </svg>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="gap"></div>
<section class="section profile-section d-none">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <?php if (isset($_GET["step"])): ?>
              <li class="breadcrumb-item"><a href="/profil">Profil</a></li>
              <?php if ($_GET["step"] == "update"): ?>
                <li class="breadcrumb-item active" aria-current="page">Profili Düzenle</li>
              <?php elseif ($_GET["step"] == "change-password"): ?>
                <li class="breadcrumb-item active" aria-current="page">Şifre Değiştir</li>
              <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page">Hata!</li>
              <?php endif; ?>
            <?php else: ?>
              <li class="breadcrumb-item active" aria-current="page">Profil</li>
            <?php endif; ?>
          </ol>
        </nav>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-img-profile">
            <a href="/profil">
              <?php echo minecraftHead($readSettings["avatarAPI"], $readAccount["realname"], 70); ?>
            </a>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-5">Kullanıcı Adı:</label>
              <label class="col-sm-7">
                <?php echo $readAccount["realname"]; ?>
                <?php echo verifiedCircle($readAccount["permission"]); ?>
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-5">E-Posta:</label>
              <label class="col-sm-7">
                <?php echo $readAccount["email"]; ?>
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-5">Yetki:</label>
              <label class="col-sm-7">
                <?php echo permissionTag($readAccount["permission"]); ?>
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-5">Kredi:</label>
              <label class="col-sm-7">
                <?php echo $readAccount["credit"]; ?> <a class="text-success" href="/kredi/yukle"><i class="fa fa-plus-circle"></i></a>
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-5">Son Giriş:</label>
              <label class="col-sm-7">
                <?php if ($readAccount["lastlogin"] == 0): ?>
                  Giriş Yapılmadı
                <?php else: ?>
                  <?php echo convertTime(date("Y-m-d H:i:s", ($readAccount["lastlogin"]/1000)), 2, true); ?>
                <?php endif; ?>
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-5">Kayıt Tarihi:</label>
              <label class="col-sm-7">
                <?php if ($readAccount["creationDate"] == "1000-01-01 00:00:00"): ?>
                  Bilinmiyor
                <?php else: ?>
                  <?php echo convertTime($readAccount["creationDate"], 2, true); ?>
                <?php endif; ?>
              </label>
            </div>
            <?php if ($readSettings["authStatus"] == 1): ?>
              <div class="form-group row">
                <label class="col-sm-5">
                  2FA:
                  <a href="https://support.google.com/accounts/answer/1066447?hl=TR" rel="external">
                    <i class="fa fa-question-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="İki Adımlı Doğrulama"></i>
                  </a>
                </label>
                <label class="col-sm-7">
                  <?php echo ($readAccount["authStatus"] == 0) ? "Kapalı" : "Açık"; ?>
                </label>
              </div>
            <?php endif; ?>
            <?php
              $accountSocialMedia = $db->prepare("SELECT * FROM AccountSocialMedia WHERE accountID = ?");
              $accountSocialMedia->execute(array($readAccount["id"]));
              $readAccountSocialMedia = $accountSocialMedia->fetch();
            ?>
            <div class="form-group row">
              <label class="col-sm-5">Skype:</label>
              <label class="col-sm-7">
                <?php if ($accountSocialMedia->rowCount() > 0): ?>
                  <?php echo (($readAccountSocialMedia["skype"] != '0') ? $readAccountSocialMedia["skype"] : "-"); ?>
                <?php else: ?>
                  -
                <?php endif; ?>
              </label>
            </div>
            <div class="form-group row">
              <label class="col-sm-5">Discord:</label>
              <label class="col-sm-7">
                <?php if ($accountSocialMedia->rowCount() > 0): ?>
                  <?php echo (($readAccountSocialMedia["discord"] != '0') ? $readAccountSocialMedia["discord"] : "-"); ?>
                <?php else: ?>
                  -
                <?php endif; ?>
              </label>
            </div>
            <?php
              $siteBannedAccountStatus = $db->prepare("SELECT * FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?) ORDER BY expiryDate DESC LIMIT 1");
              $siteBannedAccountStatus->execute(array($readAccount["id"], 1, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
              $readSiteBannedAccountStatus = $siteBannedAccountStatus->fetch();
            ?>
            <?php if ($siteBannedAccountStatus->rowCount() > 0): ?>
              <div class="form-group row">
                <label class="col-sm-5">Site Engel:</label>
                <label class="col-sm-7">
                  <?php echo ($readSiteBannedAccountStatus["expiryDate"] == '1000-01-01 00:00:00') ? 'Süresiz' : getDuration($readSiteBannedAccountStatus["expiryDate"]).' gün'; ?>
                </label>
              </div>
            <?php endif; ?>
            <?php
              $supportBannedAccountStatus = $db->prepare("SELECT * FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?) ORDER BY expiryDate DESC LIMIT 1");
              $supportBannedAccountStatus->execute(array($readAccount["id"], 2, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
              $readSupportBannedAccountStatus = $supportBannedAccountStatus->fetch();
            ?>
            <?php if ($supportBannedAccountStatus->rowCount() > 0): ?>
              <div class="form-group row">
                <label class="col-sm-5">Destek Engel:</label>
                <label class="col-sm-7">
                  <?php echo ($readSupportBannedAccountStatus["expiryDate"] == '1000-01-01 00:00:00') ? 'Süresiz' : getDuration($readSupportBannedAccountStatus["expiryDate"]).' gün'; ?>
                </label>
              </div>
            <?php endif; ?>
            <?php
              $commentBannedAccountStatus = $db->prepare("SELECT * FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?) ORDER BY expiryDate DESC LIMIT 1");
              $commentBannedAccountStatus->execute(array($readAccount["id"], 3, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
              $readCommentBannedAccountStatus = $commentBannedAccountStatus->fetch();
            ?>
            <?php if ($commentBannedAccountStatus->rowCount() > 0): ?>
              <div class="form-group row">
                <label class="col-sm-5">Yorum Engel:</label>
                <label class="col-sm-7">
                  <?php echo ($readCommentBannedAccountStatus["expiryDate"] == '1000-01-01 00:00:00') ? 'Süresiz' : getDuration($readCommentBannedAccountStatus["expiryDate"]).' gün'; ?>
                </label>
              </div>
            <?php endif; ?>
            <div class="row justify-content-between">
              <div class="col-md-6 btn-account-edit">
                <a class="btn btn-success w-100" href="/profil/duzenle">Profili Düzenle</a>
              </div>
              <div class="col-md-6 btn-account-password">
                <a class="btn btn-primary w-100" href="/profil/sifre-degistir">Şifreyi Değiştir</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <?php if (get("target") == 'profile'): ?>
          <?php if (get("action") == 'get'): ?>
            <?php
              $statServers = $db->query("SELECT serverName, serverSlug FROM Leaderboards");
              $statServers->execute();
            ?>
            <?php if ($statServers->rowCount() > 0): ?>
              <div class="card">
                <div class="card-body p-0">
                  <nav>
                    <div class="nav nav-tabs nav-fill">
                      <?php foreach ($statServers as $readStatServers): ?>
                        <?php
                          if (!get("siralama")) {
                            $_GET["siralama"] = $readStatServers["serverSlug"];
                          }
                        ?>
                        <a class="nav-item nav-link <?php echo (get("siralama") == $readStatServers["serverSlug"]) ? "active" : null; ?>" id="nav-<?php echo $readStatServers["serverSlug"]; ?>-tab" href="?siralama=<?php echo $readStatServers["serverSlug"]; ?>">
                          <?php echo $readStatServers["serverName"]; ?>
                        </a>
                      <?php endforeach; ?>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <?php
                      $statServer = $db->query("SELECT * FROM Leaderboards");
                      $statServer->execute();
                    ?>
                    <?php foreach ($statServer as $readStatServer): ?>
                      <?php
                        $usernameColumn = $readStatServer["usernameColumn"];
                        $mysqlTable = $readStatServer["mysqlTable"];
                        $sorter = $readStatServer["sorter"];
                        $tableTitles = $readStatServer["tableTitles"];
                        $tableData = $readStatServer["tableData"];
                        $tableTitlesArray = explode(",", $tableTitles);
                        $tableDataArray = explode(",", $tableData);

                        if ($readStatServer["mysqlServer"] == '0') {
                          $accountOrder = $db->prepare("SELECT $usernameColumn,$tableData FROM $mysqlTable WHERE $usernameColumn = ? ORDER BY $sorter DESC");
                          $accountOrder->execute(array($readAccount["realname"]));
                        }
                        else {
                          try {
                            $newDB = new PDO("mysql:host=".$readStatServer["mysqlServer"]."; port=".$readStatServer["mysqlPort"]."; dbname=".$readStatServer["mysqlDatabase"]."; charset=utf8", $readStatServer["mysqlUsername"], $readStatServer["mysqlPassword"]);
                          }
                          catch (PDOException $e) {
                            die("<strong>MySQL bağlantı hatası:</strong> ".utf8_encode($e->getMessage()));
                          }
                          $accountOrder = $newDB->prepare("SELECT $usernameColumn,$tableData FROM $mysqlTable WHERE $usernameColumn = ? ORDER BY $sorter DESC");
                          $accountOrder->execute(array($readAccount["realname"]));
                        }
                      ?>
                      <div class="tab-pane fade <?php echo (get("siralama") == $readStatServer["serverSlug"]) ? "show active" : null; ?>" id="nav-<?php echo $readStatServer["serverSlug"] ?>">
                        <?php if ($accountOrder->rowCount() > 0): ?>
                          <div class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" style="width: 40px;">Sıra</th>
                                  <th class="text-center" style="width: 20px;">#</th>
                                  <th>Kullanıcı Adı</th>
                                  <?php
                                    foreach ($tableTitlesArray as $readTableTitles) {
                                      echo '<th class="text-center">'.$readTableTitles.'</th>';
                                    }
                                  ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($accountOrder as $readAccountOrder): ?>
                                  <tr>
                                    <td class="text-center" style="width: 40px;">
                                      <?php
                                        if ($readStatServer["mysqlServer"] == '0') {
                                          $userPosition = $db->prepare("SET @position = 0");
                                          $userPosition->execute();
                                          $userPosition = $db->prepare("SELECT (@position:=@position+1) AS position,$usernameColumn FROM $mysqlTable ORDER BY $sorter DESC");
                                          $userPosition->execute();
                                        }
                                        else {
                                          $userPosition = $newDB->prepare("SET @position = 0");
                                          $userPosition->execute();
                                          $userPosition = $newDB->prepare("SELECT (@position:=@position+1) AS position,$usernameColumn FROM $mysqlTable ORDER BY $sorter DESC");
                                          $userPosition->execute();
                                        }
                                      ?>
                                      <?php foreach ($userPosition as $readUserPosition): ?>
                                        <?php if ($readUserPosition[$usernameColumn] == $readAccount["realname"]): ?>
                                          <?php if ($readUserPosition["position"] == 1): ?>
                                            <strong class="text-success">1</strong>
                                          <?php elseif ($readUserPosition["position"] == 2): ?>
                                            <strong class="text-warning">2</strong>
                                          <?php elseif ($readUserPosition["position"] == 3): ?>
                                            <strong class="text-danger">3</strong>
                                          <?php else: ?>
                                            <?php echo $readUserPosition["position"]; ?>
                                          <?php endif; ?>
                                          <?php break; ?>
                                        <?php endif; ?>
                                      <?php endforeach; ?>
                                    </td>
                                    <td class="text-center" style="width: 20px;">
                                      <?php echo minecraftHead($readSettings["avatarAPI"], $readAccount["realname"], 20); ?>
                                    </td>
                                    <td>
                                      <?php echo $readAccount["realname"]; ?>
                                      <?php echo verifiedCircle($readAccount["permission"]); ?>
                                    </td>
                                    <?php foreach ($tableDataArray as $readTableData): ?>
                                      <td class="text-center"><?php echo $readAccountOrder[$readTableData]; ?></td>
                                    <?php endforeach; ?>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        <?php else: ?>
                          <div class="p-4"><?php echo alertError("Bu sunucuda size ait sıralama kaydı bulunmamaktadır!", false); ?></div>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <div class="card">
              <div class="card-body p-0">
                <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-profile-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-support-tab" data-toggle="tab" href="#nav-support" role="tab" aria-controls="nav-support" aria-selected="true">Destek Mesajları</a>
                    <a class="nav-item nav-link" id="nav-credit-history-tab" data-toggle="tab" href="#nav-credit-history" role="tab" aria-controls="nav-credit-history" aria-selected="false">Kredi Geçmişi</a>
                    <a class="nav-item nav-link" id="nav-store-history-tab" data-toggle="tab" href="#nav-store-history" role="tab" aria-controls="nav-store-history" aria-selected="false">Mağaza Geçmişi</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-support" role="tabpanel" aria-labelledby="nav-support-tab">
                    <?php
                      $supports = $db->prepare("SELECT S.*, SC.name as categoryName, Se.name as serverName FROM Supports S INNER JOIN SupportCategories SC ON S.categoryID = SC.id INNER JOIN Servers Se ON S.serverID = Se.id WHERE S.accountID = ? ORDER BY S.updateDate DESC LIMIT 50");
                      $supports->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($supports->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($supports->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 40px;">ID</th>
                              <th>Başlık</th>
                              <th>Kategori</th>
                              <th>Son Güncelleme</th>
                              <th class="text-center">Durum</th>
                              <th class="text-center">İşlem</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($supports as $readSupports): ?>
                              <tr>
                                <td class="text-center" style="width: 40px;">
                                  <a href="/destek/goruntule/<?php echo $readSupports["id"]; ?>/">
                                    #<?php echo $readSupports["id"]; ?>
                                  </a>
                                </td>
                                <td>
                                  <a href="/destek/goruntule/<?php echo $readSupports["id"]; ?>/">
                                    <?php echo $readSupports["title"]; ?>
                                  </a>
                                </td>
                                <td>
                                  <?php echo $readSupports["categoryName"]; ?>
                                </td>
                                <td>
                                  <?php echo convertTime($readSupports["updateDate"]); ?>
                                </td>
                                <td class="text-center">
                                  <?php if ($readSupports["statusID"] == 1): ?>
                                    <span class="badge badge-pill badge-danger">Cevaplanmadı</span>
                                  <?php elseif ($readSupports["statusID"] == 2): ?>
                                    <span class="badge badge-pill badge-success">Cevaplandı</span>
                                  <?php elseif ($readSupports["statusID"] == 3): ?>
                                    <span class="badge badge-pill badge-warning">Kullanıcı Yanıtı</span>
                                  <?php elseif ($readSupports["statusID"] == 4): ?>
                                    <span class="badge badge-pill badge-danger">Kapatıldı</span>
                                  <?php else: ?>
                                    <span class="badge badge-pill badge-danger">HATA!</span>
                                  <?php endif; ?>
                                </td>
                                <td class="text-center">
                                  <a class="btn btn-success btn-circle" href="/destek/goruntule/<?php echo $readSupports["id"]; ?>/" data-toggle="tooltip" data-placement="top" title="Mesajı Oku">
                                    <i class="fa fa-eye"></i>
                                  </a>
                                  <a class="btn btn-danger btn-circle clickdelete" href="/destek/sil/<?php echo $readSupports["id"]; ?>/" data-toggle="tooltip" data-placement="top" title="Mesajı Sil">
                                    <i class="fa fa-trash"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Size ait destek mesajı bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-credit-history" role="tabpanel" aria-labelledby="nav-credit-history-tab">
                    <?php
                      $creditHistory = $db->prepare("SELECT * FROM CreditHistory WHERE accountID = ? AND paymentStatus = ? ORDER BY id DESC LIMIT 50");
                      $creditHistory->execute(array($readAccount["id"], 1));
                    ?>
                    <?php if ($creditHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($creditHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th class="text-center">Miktar</th>
                              <th class="text-center">Ödeme</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($creditHistory as $readCreditHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readCreditHistory["id"]; ?></td>
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
                                <td><?php echo convertTime($readCreditHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Size ait kredi geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-store-history" role="tabpanel" aria-labelledby="nav-store-history-tab">
                    <?php
                      $storeHistory = $db->prepare("SELECT SH.*, P.name as productName, S.name as serverName FROM StoreHistory SH INNER JOIN Products P ON SH.productID = P.id INNER JOIN Servers S ON SH.serverID = S.id WHERE SH.accountID = ? ORDER BY SH.id DESC LIMIT 50");
                      $storeHistory->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($storeHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($storeHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Ürün</th>
                              <th>Sunucu</th>
                              <th>Tutar</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($storeHistory as $readStoreHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readStoreHistory["id"]; ?></td>
                                <td><?php echo $readStoreHistory["productName"]; ?></td>
                                <td><?php echo $readStoreHistory["serverName"]; ?></td>
                                <td>
                                  <?php if ($readStoreHistory["price"] > 0): ?>
                                    <?php echo $readStoreHistory["price"]; ?> kredi
                                  <?php else: ?>
                                    Ücretsiz
                                  <?php endif; ?>
                                </td>
                                <td><?php echo convertTime($readStoreHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Size ait mağaza geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body p-0">
                <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-profile-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-lottery-history-tab" data-toggle="tab" href="#nav-lottery-history" role="tab" aria-controls="nav-lottery-history" aria-selected="false">Çarkıfelek Geçmişi</a>
                    <a class="nav-item nav-link" id="nav-gift-history-tab" data-toggle="tab" href="#nav-gift-history" role="tab" aria-controls="nav-gift-history" aria-selected="false">Hediye Geçmişi</a>
                    <a class="nav-item nav-link" id="nav-chest-history-tab" data-toggle="tab" href="#nav-chest-history" role="tab" aria-controls="nav-chest-history" aria-selected="false">Sandık Geçmişi</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-lottery-history" role="tabpanel" aria-labelledby="nav-lottery-history-tab">
                    <?php
                      $lotteryHistory = $db->prepare("SELECT LH.*, L.title as lotteryTitle, LA.title as awardTitle, LA.awardType, LA.award FROM LotteryHistory LH INNER JOIN LotteryAwards LA ON LH.lotteryAwardID = LA.id INNER JOIN Lotteries L ON LA.lotteryID = L.id WHERE LH.accountID = ? AND LA.awardType != ? ORDER by LH.id DESC LIMIT 50");
                      $lotteryHistory->execute(array($readAccount["id"], 3));
                    ?>
                    <?php if ($lotteryHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($lotteryHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Çarkıfelek</th>
                              <th>Ödül</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($lotteryHistory as $readLotteryHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readLotteryHistory["id"]; ?></td>
                                <td>
                                  <?php echo $readLotteryHistory["lotteryTitle"]; ?>
                                </td>
                                <td>
                                  <?php echo $readLotteryHistory["awardTitle"]; ?>
                                </td>
                                <td><?php echo convertTime($readLotteryHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Size ait çarkıfelek geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-gift-history" role="tabpanel" aria-labelledby="nav-gift-history-tab">
                    <?php
                      $giftHistory = $db->prepare("SELECT PGH.*, PG.name, PG.giftType, PG.gift FROM ProductGiftsHistory PGH INNER JOIN ProductGifts PG ON PGH.giftID = PG.id WHERE PGH.accountID = ? ORDER by PGH.id DESC LIMIT 50");
                      $giftHistory->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($giftHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($giftHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Kod</th>
                              <th>Hediye</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($giftHistory as $readGiftHistory): ?>
                              <tr>
                                <td class="text-center">#<?php echo $readGiftHistory["id"]; ?></td>
                                <td>
                                  <?php echo $readGiftHistory["name"]; ?>
                                </td>
                                <td>
                                  <?php if ($readGiftHistory["giftType"] == 1): ?>
                                    <?php
                                      $product = $db->prepare("SELECT name FROM Products WHERE id = ?");
                                      $product->execute(array($readGiftHistory["gift"]));
                                      $readProduct = $product->fetch();
                                      echo $readProduct["name"];
                                    ?>
                                  <?php else: ?>
                                    <?php echo $readGiftHistory["gift"]; ?> kredi
                                  <?php endif; ?>
                                </td>
                                <td><?php echo convertTime($readGiftHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Size ait hediye geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="tab-pane fade" id="nav-chest-history" role="tabpanel" aria-labelledby="nav-chest-history-tab">
                    <?php
                      $chestsHistory = $db->prepare("SELECT CH.*, P.name as productName, S.name as serverName FROM ChestsHistory CH INNER JOIN Chests C ON CH.chestID = C.id INNER JOIN Products P ON C.productID = P.id INNER JOIN Servers S ON P.serverID = S.id WHERE CH.accountID = ? ORDER BY CH.id DESC LIMIT 5");
                      $chestsHistory->execute(array($readAccount["id"]));
                    ?>
                    <?php if ($chestsHistory->rowCount() > 0): ?>
                      <div class="table-responsive" <?php echo ($chestsHistory->rowCount() > 10) ? 'style="height: 400px; overflow:auto;"' : null; ?>>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="text-center">ID</th>
                              <th>Ürün</th>
                              <th>Sunucu</th>
                              <th class="text-center">İşlem</th>
                              <th>Tarih</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($chestsHistory as $readChestsHistory): ?>
                              <tr>
                                <td class="text-center">
                                  #<?php echo $readChestsHistory["id"]; ?>
                                </td>
                                <td><?php echo $readChestsHistory["productName"]; ?></td>
                                <td><?php echo $readChestsHistory["serverName"]; ?></td>
                                <td class="text-center">
                                  <?php if ($readChestsHistory["type"] == 1): ?>
                                    <i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Teslim"></i>
                                  <?php elseif ($readChestsHistory["type"] == 2): ?>
                                    <i class="fa fa-gift" data-toggle="tooltip" data-placement="top" title="Hediye (Gönderen)"></i>
                                  <?php elseif ($readChestsHistory["type"] == 3): ?>
                                    <i class="fa fa-gift" data-toggle="tooltip" data-placement="top" title="Hediye (Alan)"></i>
                                  <?php else: ?>
                                    <i class="fa fa-check"></i>
                                  <?php endif; ?>
                                </td>
                                <td><?php echo convertTime($readChestsHistory["creationDate"], 2, true); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="p-4"><?php echo alertError("Size ait hediye geçmişi bulunmamaktadır!", false); ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php elseif (get("action") == 'update'): ?>
            <?php
              require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
              $csrf = new CSRF('csrf-sessions', 'csrf-token');

              $accountSocialMedia = $db->prepare("SELECT * FROM AccountSocialMedia WHERE accountID = ?");
              $accountSocialMedia->execute(array($readAccount["id"]));
              $readAccountSocialMedia = $accountSocialMedia->fetch();

              if (isset($_POST["updateAccounts"])) {
                if (post("skype") == null) {
                  $_POST["skype"] = '0';
                }
                if (post("discord") == null) {
                  $_POST["discord"] = '0';
                }
                if (!$csrf->validate('updateAccounts')) {
                  echo alertError("Sistemsel bir sorun oluştu!");
                }
                else if (post("email") == null || ($readSettings["authStatus"] == 1 && post("authStatus") == null)) {
                  echo alertError("Lütfen zorunlu alanları doldurunuz!");
                }
                else if (post("password") == null) {
                  echo alertError("Değişiklerin kaydedilmesi şifrenizi giriniz!");
                }
                else {
                  $emailValid = $db->prepare("SELECT * FROM Accounts WHERE email = ?");
                  $emailValid->execute(array(post("email")));
                  $password = (($readSettings["passwordType"] == 1) ? checkSHA256(post("password"), $readAccount["password"]) : ((md5(post("password")) == $readAccount["password"]) ? true : false));
                  if (!$password) {
                    echo alertError("Şifrenizi yanlış girdiniz!");
                  }
                  else if (checkEmail(post("email"))) {
                    echo alertError("Lütfen geçerli bir email adresi giriniz!");
                  }
                  else if (post("email") != $readAccount["email"] && $emailValid->rowCount() > 0) {
                    echo alertError('<strong>'.post("email").'</strong> başkası tarafından kullanılıyor!');
                  }
                  else {
                    if ($readAccount["email"] != post("email")) {
                      $loginToken = md5(uniqid(mt_rand(), true));
                      $updateAccounts = $db->prepare("UPDATE Accounts SET email = ? WHERE id = ?");
                      $updateAccounts->execute(array(post("email"), $readAccount["id"]));
                      $deleteAccountSessions = $db->prepare("DELETE FROM AccountSessions WHERE accountID = ?");
                      $deleteAccountSessions->execute(array($readAccount["id"]));
                      $insertAccountSessions = $db->prepare("INSERT INTO AccountSessions (accountID, loginToken, creationIP, expiryDate, creationDate) VALUES (?, ?, ?, ?, ?)");
                      $insertAccountSessions->execute(array($readAccount["id"], $loginToken, getIP(), createDuration(((isset($_COOKIE["rememberMe"])) ? 365 : 0.01666666666)), date("Y-m-d H:i:s")));
                      $_SESSION["login"] = $loginToken;
                      if (isset($_COOKIE["rememberMe"])) {
                        createCookie("rememberMe", $loginToken, 365, $sslStatus);
                      }
                    }
                    if ($accountSocialMedia->rowCount() > 0) {
                      $updateAccountSocialMedia = $db->prepare("UPDATE AccountSocialMedia SET skype = ?, discord = ? WHERE accountID = ?");
                      $updateAccountSocialMedia->execute(array(post("skype"), post("discord"), $readAccount["id"]));
                    }
                    else {
                      $insertAccountSocialMedia = $db->prepare("INSERT INTO AccountSocialMedia (accountID, skype, discord) VALUES (?, ?, ?)");
                      $insertAccountSocialMedia->execute(array($readAccount["id"], post("skype"), post("discord")));
                    }

                    if ($readSettings["authStatus"] == 1 && (post("authStatus") == 0 || post("authStatus") == 1)) {
                      if (post("authStatus") == 1 && $readAccount["authStatus"] == 0) {
                        $deleteAccountSessions = $db->prepare("DELETE FROM AccountSessions WHERE accountID = ? AND loginToken = ? AND creationIP = ?");
                        $deleteAccountSessions->execute(array($readAccount["id"], $_SESSION["login"], getIP()));
                        unset($_SESSION["login"]);
                        $_SESSION["tfa"] = array(
                          'accountID'     => $readAccount["id"],
                          'profileUpdate' => 'true',
                          'rememberMe'    => (isset($_COOKIE["rememberMe"])) ? 'true' : 'false',
                          'ipAddress'     => getIP(),
                          'expiryDate'    => createDuration(0.00347222222)
                        );
                        removeCookie("rememberMe");
                        go("/dogrulama");
                      }
                      else {
                        $deleteAccountAuths = $db->prepare("DELETE FROM AccountAuths WHERE accountID = ?");
                        $deleteAccountAuths->execute(array($readAccount["id"]));
                        $updateAccounts = $db->prepare("UPDATE Accounts SET authStatus = ? WHERE id = ?");
                        $updateAccounts->execute(array(0, $readAccount["id"]));
                      }
                    }

                    echo alertSuccess("Profiliniz başarıyla düzenlenmiştir!");
                  }
                }
              }
            ?>
            <div class="card">
              <div class="card-header">
                Profili Düzenle
              </div>
              <div class="card-body">
                <form action="" method="post">
                  <div class="form-group row">
                    <label class="col-sm-3">Kullanıcı Adı:</label>
                    <div class="col-sm-9">
                      <?php echo $readAccount["realname"]; ?>
                      <?php echo verifiedCircle($readAccount["permission"]); ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3">Email Adresi:</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" name="email" placeholder="Örn: merhaba@gmail.com" value="<?php echo $readAccount["email"]; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3">Skype:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="skype" placeholder="Skype adresinizi giriniz." value="<?php echo (($accountSocialMedia->rowCount() > 0 && $readAccountSocialMedia["skype"] != '0') ? $readAccountSocialMedia["skype"] : null); ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3">Discord:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="discord" placeholder="Discord adresinizi giriniz." value="<?php echo (($accountSocialMedia->rowCount() > 0 && $readAccountSocialMedia["discord"] != '0') ? $readAccountSocialMedia["discord"] : null); ?>">
                    </div>
                  </div>
                  <?php if ($readSettings["authStatus"] == 1): ?>
                    <div class="form-group row">
                      <label class="col-sm-3">
                        2FA:
                        <a href="https://support.google.com/accounts/answer/1066447?hl=TR" rel="external">
                          <i class="fa fa-question-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="İki Adımlı Doğrulama"></i>
                        </a>
                      </label>
                      <div class="col-sm-9">
                        <select class="form-control" name="authStatus" data-toggle="select2">
                          <option value="0" <?php echo ($readAccount["authStatus"] == 0) ? 'selected="selected"' : null; ?>>Kapalı</option>
                          <option value="1" <?php echo ($readAccount["authStatus"] == 1) ? 'selected="selected"' : null; ?>>Açık</option>
                        </select>
                      </div>
                    </div>
                  <?php endif; ?>
                  <hr>
                  <div class="form-group row">
                    <label class="col-sm-3">Şifre:</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="password" placeholder="Değişiklerin onaylanması için mevcut şifrenizi giriniz.">
                    </div>
                  </div>
                  <?php echo $csrf->input('updateAccounts'); ?>
                  <div class="clearfix">
                    <div class="float-right">
                      <button type="submit" class="btn btn-success btn-rounded" name="updateAccounts">Kaydet</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php elseif (get("action") == 'change-password'): ?>
            <?php
              require_once(__ROOT__."/apps/main/private/packages/class/csrf/csrf.php");
              $csrf = new CSRF('csrf-sessions', 'csrf-token');
              if (isset($_POST["changePassword"])) {
                if (!$csrf->validate('changePassword')) {
                  echo alertError("Sistemsel bir sorun oluştu!");
                }
                else if ((post("currentPassword") == null) || (post("password") == null) || (post("passwordRe") == null)) {
                  echo alertError("Lütfen boş alan bırakmayınız!");
                }
                else {
                  $currentPassword = (($readSettings["passwordType"] == 1) ? checkSHA256(post("currentPassword"), $readAccount["password"]) : ((md5(post("currentPassword")) == $readAccount["password"]) ? true : false));
                  if (!$currentPassword) {
                    echo alertError("Mevcut şifreyi yanlış girdiniz!");
                  }
                  else if (strlen(post("password")) < 4) {
                    echo alertError("Şifreniz 4 karakterden az olamaz!");
                  }
                  else if (post("password") != post("passwordRe")) {
                    echo alertError("Yeni şifreniz tekrarı ile uyuşmuyor!");
                  }
                  else if (checkBadPassword(post("password"))) {
                    echo alertError("Basit şifreler kullanamazsınız!");
                  }
                  else {
                    $loginToken = md5(uniqid(mt_rand(), true));
                    $password = (($readSettings["passwordType"] == 1) ? createSHA256(post("password")) : md5(post("password")));
                    $updateAccounts = $db->prepare("UPDATE Accounts SET password = ? WHERE id = ?");
                    $updateAccounts->execute(array($password, $readAccount["id"]));
                    $deleteAccountSessions = $db->prepare("DELETE FROM AccountSessions WHERE accountID = ?");
                    $deleteAccountSessions->execute(array($readAccount["id"]));
                    $insertAccountSessions = $db->prepare("INSERT INTO AccountSessions (accountID, loginToken, creationIP, expiryDate, creationDate) VALUES (?, ?, ?, ?, ?)");
                    $insertAccountSessions->execute(array($readAccount["id"], $loginToken, getIP(), createDuration(((isset($_COOKIE["rememberMe"])) ? 365 : 0.01666666666)), date("Y-m-d H:i:s")));
                    echo alertSuccess("Şifreniz başarıyla değiştirilmiştir!");
                    $_SESSION["login"] = $loginToken;
                    if (isset($_COOKIE["rememberMe"])) {
                      createCookie("rememberMe", $loginToken, 365, $sslStatus);
                    }
                  }
                }
              }
            ?>
            <div class="card">
              <div class="card-header">
                Şifre Değiştir
              </div>
              <div class="card-body">
                <form action="" method="post">
                  <div class="form-group row">
                    <label class="col-sm-3">Mevcut Şifre:</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="currentPassword" placeholder="Mevcut şifrenizi giriniz">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3">Yeni Şifre:</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="password" placeholder="Yeni şifrenizi giriniz">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3">Yeni Şifre (Tekrar):</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="passwordRe" placeholder="Yeni şifrenizi tekrar giriniz">
                    </div>
                  </div>
                  <?php echo $csrf->input('changePassword'); ?>
                  <div class="clearfix">
                    <div class="float-right">
                      <button type="submit" class="btn btn-success btn-rounded" name="changePassword">Değiştir</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php else: ?>
            <?php go('/404'); ?>
          <?php endif; ?>
        <?php else: ?>
          <?php go('/404'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
