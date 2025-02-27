<?php
    if(isset($_POST["register"])):
        $email=$_POST["email"];
        $password1=$_POST["password1"];
        $password2=$_POST["password2"];
       echo $Member->register($email, $password1,$password2); 
?>
        <!-- <div class="theme-l5 round">
        <h2 class="center block padding">Başarıyla Giriş Yaptınız</h2>
        <h3 class="center block padding">Profil Sayfanıza Yönlendiriliyorsunuz...</h3>
        <meta http-equiv="refresh" content="1;url=/uye">
        </div> -->
<?php  endif; ?>


<?php if( !$Member->isLogged()  ): ?>
<h2 class="center theme-l1 round">Yeni Kullanıcı Kaydı</h2>
<div class="row">
        <div class="col m1 l2">&nbsp;</div>
        <div class="col m10 l8 theme-l5 round padding card margin-top">

             <form id="registerForm" method="post">
                <input type="hidden" name="register">
                <div class="row padding-small" >
                    <div class="col s4 m4 l3 padding">
                    <img src="/public/img/icon/arroba.png" alt="">
                    <span class="large"> Eposta </span>
                    <small class="block">Aktivasyon bağlantısı bu adrese gelecek</small>
                    <span id="reportEmail" class="small red block center"></span>
                    </div>
                    <div class="col s8 m8 l9 padding">
                        <input type="email" name="email" id="email" value="hdinceler@gmail.com" oninput="Member.validateRegisterForm()"
                        class="input round large round padding-large border border-theme center" required >
                    </div>
                </div>
              
                <div class="row padding-small margin-top" >
                    <div class="col s4 m4 l3 padding">
                        <img src="/public/img/icon/password2.png" alt="">
                        <span class="large"> Parola</span>
                        <small class="block">En az 8 karakter,En az 1 rakam,işaret yasak</small>
                        <span id="reportPass1" class="small red block center"></span>
                    </div>
                    <div class="col s8 m8 l9 padding">
                        <input type="password" name="password1" id="password1"  value="aaaaaaa1"  oninput="Member.validateRegisterForm()"
                         class="input round large round padding-large border border-theme center" required >
                    </div>
                </div>
              

               
                <div class="row padding-small margin-top" >
                    <div class="col s4 m4 l3 padding">
                        <img src="/public/img/icon/password2.png" alt="">
                        <span class="large"> Parola Tekrar</span>
                        <div class="row">
                            <div class="col half">
                                <span id="reportPass2" class="small red block center"></span>
                            </div>
                            <div class="col half">
                                <span id="reportPassEqual" class="small red block center"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col s8 m8 l9 padding">
                        <input type="password" name="password2" id="password2" value="aaaaaaa1" oninput="Member.validateRegisterForm()"
                         class="input round large round padding-large border border-theme center" required >
                    </div>
                </div>

                             
                <div class="row padding-small margin-top" >
                    <div class="col s4 m4 l3 padding">
                    <img src="/public/img/icon/agreement.png" alt="">
                    <span class="large">Sözleşme</span>
                        <span id="reportContract" class="small red block center"></span>
                    </div>
                    <div class="col s8 m8 l9 padding">
                            <input type="checkbox" name="contract" id="contract" class="check" checked onchange="Member.validateRegisterForm()"/>
                            <a href="#" onclick="showContrat();" class="large">Kullanıcı Sözleşmesini Okudum Kabul Ediyorum</a>
                     </div>
                </div>
              
               <div class="row padding-small">
                    <div class="col m4 l3">&nbsp;</div>
                    <div class="col s12 m8 l9 padding"> 
                        <input type="submit" id="btnRegister"  name="btnRegister" class="block margin-top btn padding large round" value="Üye Kaydımı Gerçekleştir "></input>
                        <div class="row padding"> 
                            <div class="padding col half small">
                                <a href="uye" class="round block padding center">Üye Girişi</a>
                            </div>
                            <div class="padding col half small">
                                <a href="parolami-unuttum" class="round block padding center">Parolamı Unuttum</a>
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

  