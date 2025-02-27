    <h2 class="center theme-l1 round margin">İletişim</h2>
    <div class="container padding-32">
            <h3>Firma Adı</h3>
            <p><i class="text-teal">Adres:</i> Örnek Mah. Örnek Cad. No: 10, İstanbul</p>
            <p><i class="text-teal">Telefon:</i> +90 555 123 45 67</p>
            <p><i class="text-teal">E-Posta:</i><?=$GlobalVars->adminEmail?> </p>
        </div>

        <?php 
    ?>
        <!-- İletişim Formu -->
        <div class="container padding-32">
            <h3>Bizimle İletişime Geçin</h3>
            <form action="iletisim.php" method="POST">
                <label>Ad Soyad</label>
                <input class="input border margin-bottom" type="text" name="name" required>
                
                <label>E-Posta</label>
                <input class="input border margin-bottom" type="email" name="email" required>
                
                <label>Mesaj</label>
                <textarea class="input border margin-bottom" name="message" rows="4" required></textarea>
                
                <button class="button teal margin-top" type="submit">Gönder</button>
            </form>
        </div>

        <!-- Harita -->
        <div class="container padding-32 center">
            <h3>Konumumuz</h3>
            <iframe class="border" src="https://maps.google.com/maps?q=istanbul&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                    width="100%" height="300" allowfullscreen></iframe>
        </div>
 