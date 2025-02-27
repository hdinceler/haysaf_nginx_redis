<a href="/" class="bar-item button">Ana Sayfa</a>
<a href="/kategoriler" class="bar-item button">Kategoriler</a>
<a href="/saticilar" class="bar-item button">Satıcılar</a>
<a href="/urunler" class="bar-item button">Ürünler</a>
<a href="/iletisim" class="bar-item button">İletişim</a>
<?php if($Member->isLogged()):?>
    <a href="/uye" class="bar-item button">Profilim</a>
<?php else:?>
    <a href="/uye" class="bar-item button">Üyelik</a>
<?php endif;?>