<?php
$sql="SELECT * FROM kategoriler ORDER BY sira asc";
$kategoriler=[
    ['id'=>1,'ad'=>'Aktif Bileşenler','image'=>'mcu.png','yazi'=>'Elektrik sinyalini yükselten, kontrol eden veya değiştiren bileşenlerdir. Kendi başlarına çalışamazlar ve genellikle bir enerji kaynağına (pil, adaptör vb.) ihtiyaç duyarlar.Transistörler (BJT, MOSFET, IGBT): Sinyal yükseltme ve anahtarlama işlemlerinde kullanılır. Örneğin, IRFZ44N MOSFET yüksek güçlü anahtarlama devrelerinde tercih edilir.Diyotlar: Akımın tek yönlü akmasını sağlar. Örneğin, 1N4007 diyot doğrultma devrelerinde yaygın olarak kullanılır.Entegre Devreler (IC - Integrated Circuit): Birden fazla elektronik bileşeni tek bir çip üzerinde barındıran devre elemanlarıdır. Örneğin, NE555 zamanlayıcı entegresi dalga üretme ve zamanlama işlemleri için kullanılır.Mikrodenetleyiciler (MCU): Programlanabilir çiplerdir, akıllı cihazların ve robotların beyni olarak çalışır. Arduino ve ESP8266 WiFi modülü gibi bileşenler en popüler mikrodenetleyiciler arasındadır.'],
    ['id'=>2,'ad'=>'Pasif Bileşenler','image'=>'capacitors.png','yazi'=>'Elektrik enerjisini depolayan, yönlendiren veya sınırlayan bileşenlerdir. Enerji üretmezler, sadece mevcut enerjiyi düzenlerler.Dirençler: Akımın belirli bir seviyede tutulmasını sağlar. 10KΩ direnç, sensör devrelerinde yaygın olarak kullanılır.Kondansatörler: Elektrik enerjisini kısa süreliğine depolar ve ani akım değişimlerine karşı koruma sağlar. Örneğin, 1000µF elektrolitik kondansatör, güç kaynağı devrelerinde kullanılır.Bobinler (İndüktörler): Manyetik alan oluşturarak akım değişimlerini dengeleyen elemanlardır. 100µH bobin, güç filtreleme devrelerinde kullanılır.Transformatörler: Gerilim seviyesini düşürme veya yükseltme işlemi yapar. 220V-12V trafo, adaptör devrelerinde kullanılır.'],
];
?>
<h2 class="center theme-l1 round margin">Kategoriler</h2>

<div class="row">
    <?php foreach ($kategoriler as $kategori):?>
        <div class="col s12 m12 l12 padding center">
            <div class="card padding round theme-l5">
                <div class="row xlarge center"><?=$kategori["ad"]?></div>
                <img src="./public/img/kategori/<?=$kategori["image"]?>" alt="<?=$kategori["ad"]?>" class="image center">
                <div class="row block center border-bottom padding"><?=$kategori["yazi"]?></div>
                <div class="row center block padding margin-top">
                    <?=$FormElements->button("1289 Ürün","incele",""," " )?> 
                    <?=$FormElements->button("28 kategori","incele",""," " )?> 
                    <?=$FormElements->button("866 DataSheet","incele",""," " )?> 
                </div>
            </div>
        </div>        
    <?php endforeach;?>
</div>