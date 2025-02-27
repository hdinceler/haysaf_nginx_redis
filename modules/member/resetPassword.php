 
<?php if( !$Member->isLogged()  ): ?>
<h2 class="center theme-l1 round">Parolamı Unuttum</h2>
<div class="row">
        <div class="col m1 l2">&nbsp;</div>
        <div class="col s12 m10 l8 theme-l5 round padding card margin-top">

             <form id="loginForm">
                <div class="row padding-small" >
                    <div class="col s12 m4 l3 padding">
                            <span class="large"> Eposta </span>
                            <small class="block">Parola sıfırlama bağlantısı bu adrese gelecek</small>
                    </div>
                    <div class="col s12 m8 l9 padding">
                        <input type="email" name="email" id="email" value="hdinceler@gmail.com" class="input round large round padding-large border border-theme center" required >
                    </div>

                </div>
              

                <div class="row padding-small">
                        <div class="col m12 l3">&nbsp;</div>
                        <div class="col s12 m12 l9 padding"> 
                            <a href="#" onclick="Member.sendResetLink()" class="block margin-top btn theme-l4 padding large hover-theme round"> Sıfırlama bağlantısı gönder </a>
                            <div class="row padding"> 
                                <div class="padding col half small">
                                    <a href="uye" class="round block padding center">Üye Girişi</a>
                                </div>
                                <div class="padding col half small">
                                    <a href="kayit-ol" class="round block padding center">Yeni Kullanıcı Kaydı</a>
                                </div>
                            </div>

                    </div>

 
            </form>

 
 <?php else: ?>
    <h2 class="center block"> Zaten Giriş Yapmışsınız</h2>
    <div class="row center padding">
        <a href="cikis-yap" class="center btn round border red border-radius border-theme">Çıkış yap</a>
    </div>
<?php endif;?>

 