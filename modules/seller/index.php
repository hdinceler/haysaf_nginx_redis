<div class="container row ">
    <h2 class="center theme-l1 round margin">Satıcılar</h2>
    <?php for($sellerKey=0 ; $sellerKey<20; $sellerKey++): ?>
        <div class="padding col s6 m4 l2 seller" id="<?=$sellerKey?>">
            <div class="padding-small block center card   border border-theme theme-l5 round">
                <h4 class="block">Kale Elektronik</h4>
                <small class="block">Bayrampaşa / İSTANBUL</small>
                <img src="kale.jpg" alt="" class="rounded-lg border-theme" height="96px">
                <span class="center xlarge block">12.56 ₺</span>
                <small class="">Ürün:9</small> , 
                <small class="">Stok:13</small>
                <div class="row">
                    <div class="padding-small col s12 m6 l6">
                      <?=$FormElements->button("İncele","incele",""," " )?> 
                    </div>
                    <div class="padding-small col s12 m6 l6">
                      <?=$FormElements->button("İncele","incele",""," " )?> 
                    </div>
                 </div>
            </div>
        </div>
    <?php endfor;?>
</div>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
 
