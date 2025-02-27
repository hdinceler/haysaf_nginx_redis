<div class="container row ">
    <h2 class="center theme-l1 round margin">Ürünler</h2>
    <?php for($productKey=0 ; $productKey<20; $productKey++): ?>
        <div class="padding col s6 m4 l2 product" id="<?=$productKey?>">
            <div class="padding-small block center card   border border-theme theme-l5 round">
                <h4 class="block">IRFZ44N N-Channel Mosfet</h4>
                <img src="/public/img/urun/transistor.png" alt="" class="rounded-lg border-theme" height="96px">
                <span class="center xlarge block">12.56 ₺</span>
                <small class="">Satıcı:9</small> , 
                <small class="">Stok:13</small>
                <div class="row">
                    <div class="padding-small col s12 m6 l6">
                    <?=$FormElements->button("Satıcılar","satici-listesi-12","","red" )?>
                    </div>
                    <div class="padding-small col s12 m6 l6 ">
                        <?=$FormElements->button("İncele","incele"," " ,"")?>
                    </div>
                 </div>
            </div>
        </div>
    <?php endfor;?>
</div>
 
