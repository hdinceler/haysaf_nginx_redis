<?php if( $Member->isLogged()  ): ?>
<h2 class="center theme-l1 round margin">Profilim</h2>
<div class="container row block">
    <div class="bar theme-l3">
      <a href="?profileTask=ozet" class="bar-item button"><img src="/public/img/icon/search.png" alt=""> <span class="hide-small">Özet</span></a>
      <a href="?profileTask=siparis" class="bar-item button"><img src="/public/img/icon/check-out.png" alt=""> <span class="hide-small">Spariş</span></a>
      <a href="?profileTask=guvenlik" class="bar-item button"><img src="/public/img/icon/security.png" alt=""> <span class="hide-small">Güvenlik</span></a>
      <a href="?profileTask=iletisim" class="bar-item button"><img src="/public/img/icon/support.png" alt=""> <span class="hide-small">İletişim</span></a>
      <a href="?profileTask=" class="bar-item button"><img src="/public/img/icon/store.png" alt=""> <span class="hide-small">İş Yeri</span></a>
      <a href="?profileTask=" class="bar-item button"><img src="/public/img/icon/product.png" alt=""> <span class="hide-small">Ürün</span></a>
      <a href="?profileTask=" class="bar-item button"><img src="/public/img/icon/turkish-lira2.png" alt=""> <span class="hide-small">Ödeme</span></a>
      <a href="?profileTask=" class="bar-item button"><img src="/public/img/icon/shipping.png" alt=""> <span class="hide-small">Kargo</span></a>
      <a href="?profileTask=" class="bar-item button"><img src="/public/img/icon/contract.png" alt=""> <span class="hide-small">Yasal</span></a>
      <a href="?profileTask=" class="bar-item button"><img src="/public/img/icon/advertising.png" alt=""> <span class="hide-small">Kampanya</span></a>
      <a href="?profileTask=" class="bar-item button"><img src="/public/img/icon/chart.png" alt=""> <span class="hide-small">Analiz</span></a>
      <a href="/cikis-yap" class="bar-item button"><img src="/public/img/icon/error.png" alt=""> <span class="hide-small">Çıkış</span></a>
    </div>

</div>
<div class="margin padding round container center round">
    <div class="col l3">&nbsp;</div>
            <div class="col l6">

                <?php 
                if(isset($_GET["profileTask"])):  
                    // var_dump($_GET);  
                    if($_GET["profileTask"] == "guvenlik") {  require_once "security.php"; } 
                    elseif($_GET["profileTask"] == "siparis") {  require_once "order.php"; } 
                    elseif($_GET["profileTask"] == "iletisim") {  require_once "contact.php"; } 
                    else { require_once "default.php"; }  
                else:  
                    require_once "default.php";  
                endif;
                ?>
                <?php else: require_once __DIR__ ."/../login.php";  endif;?>
            </div>
    <div class="col l3">&nbsp;</div>
</div> 