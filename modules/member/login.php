 
<?php
    if(isset($_POST["login"])):
        $email=$_POST["email"];
        $password=$_POST["password"];
        $Member->login($email, $password); 
        if(!$Member->isLogged()):
?>
            <div class="theme-l5 round">
                <h2 class="center block padding">Hatalı Giriş Denemesi</h2>
                <h3 class="center block padding"></h3>
                <meta http-equiv="refresh" content="5;url=/uye">
            </div>
        <?php else:?>
            <div class="theme-l5 round">
                <h2 class="center block padding">Başarıyla Giriş Yaptınız</h2>
                <h3 class="center block padding">Profil Sayfanıza Yönlendiriliyorsunuz...</h3>
                <meta http-equiv="refresh" content="1;url=/uye">
            </div>
    <?php  endif; ?>
<?php  endif; ?>

<?php if( !$Member->isLogged()  ): ?>
<h2 class="center theme-l1 round">Üye Girişi</h2>
<div class="row">
        <div class="col m1 l2">&nbsp;</div>
        <div class="col m10 l8 theme-l5 round padding card margin-top">
            <form method="post">
                <div class="row padding-small" >
                    <input type="hidden" name="login">
                    <div class="col s3 m4 l3 padding">
                            <span class="large"> Eposta </span>
                    </div>
                    <div class="col s9 m8 l9 padding">
                        <input type="email" name="email" id="email" value="hdinceler@gmail.com" class="input round large round padding-large border border-theme center" required >
                    </div>
                </div>
                <div class="row padding-small">
                    <div class="col s3 m4 l3 padding">
                        <span class="large">Parola:</span>
                    </div>
                    <div class="col s9 m8 l9 padding">
                        <input type="password" name="password" id="password" value="aaaaaaa1" class="input round large round padding-large border border-theme center" required >
                    </div>
                </div>

                <div class="row padding-small">
                        <div class="col m12 l3">&nbsp;</div>
                        <div class="col m12 l9 padding"> 
                            <input type="submit" class="block margin-top btn theme-l4 padding large hover-theme round" value=" Giriş yap "></input>
                            <div class="row padding"> 
                                    <div class="padding col half small">
                                        <a href="kayit-ol" class="round block padding center">Yeni Kullanıcı Kaydı</a>
                                    </div>
                                    <div class="padding col half small">
                                        <a href="parolami-unuttum" class="round block padding center">Parolamı Unuttum</a>
                                    </div>
                            </div>
                        </div>
                </div>

            </form>
        </div>
</div>
 
<?php endif;?>
