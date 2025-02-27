


    <div class="col l6 border border-theme round padding">
        <form id="registerForm">
                <div class="row padding-small" >
                    <div class="col s6 m4 l3">
                        <span class="large">Eposta</span>
                    </div>
                    <div class="col s6 m8 l9 padding">
                        <input type="email" name="email" id="email" value="hdinceler@gmail.com" class="input round large border-theme border text-grey" disabled >
                    </div>
                </div>
                <div class="row padding-small">
                    <div class="col s6 m4 l3 padding">
                        <span class="large">Parola <br/><small>(En az 8 karakter , En az 1 Rakam)</small></span>
                    </div>
                    <div class="col s6 m8 l9 padding">
                        <input type="password" name="password" id="password" value="123" class="input round large theme-l5 border border-theme" required >
                    </div>
                </div>

   
                <div class="row padding-small">
                    <div class="col s6 m4 l3 padding">
                        <span class="large">Parola Tekrar</span>
                    </div>
                    <div class="col s6 m8 l9 padding">
                        <input type="password" name="password" id="password" value="123" class="input round large theme-l5 border border-theme" required >
                    </div>
                </div>

   



                <div class="row padding-small center ">
                    <label class="center large">
                        <input type="checkbox" name="checkSozlesme" id="checkSozlesme" class="check"> 
                        <a href="#" onclick="showContrat();">Kullanıcı Sözleşmesini Okudum Kabul Ediyorum</a>
                    </label>
                    <a href="#" onclick="Member.register()" class="margin-top block border border-theme btn round"> Kayıt Ol </a>
                </div>
                <div class="row padding-small center ">
                    <div class="row">
                        <div class="padding col half small">
                            <a href="uye" class="btn round border border-theme">Zaten Üyeyim</a>
                        </div>
                        <div class="padding col half small">
                            <a href="parolami-unuttum" class="btn round border border-radius border-theme">Parolamı Unuttum</a>
                        </div>
                    </div>
                </div>
            </form>


    </div>
 
 </div>