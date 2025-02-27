// /public/acions.js 
const basketButtons= document.querySelectorAll('.addBasket');
const capitalizeFirsLetter=(str)=>{
    return str.charAt(0).toUpperCase()+ str.slice(1).toLowerCase() ;
}

basketButtons.forEach(
    (button)=>{
        button.addEventListener(
            'click',function(){
                const productDiv= this.closest('.product')
                if(productDiv){
                    const productKey=productDiv.id;
                    console.log(productKey)
                }
            }
        )
    }
)


class Modal{
    static progressBar=document.getElementById('modalProgress');
    static modalHeader=document.getElementById('modalHeader');
    static modalBody=document.getElementById('modalBody');
    static modalProgressBar=document.getElementById('modalProgressBar');
    static show(header,body) {
        console.log("modal açıldı");
        document.getElementById("modal").classList.add("modal-show");
        this.modalHeader.innerText=header;
        this.modalBody.innerHTML=body;
        this.insert("check",'Login başarılı');
        this.insert("wait",'Puanınız Hesaplanıyor...');
        this.insert("warning",'Login başarılı');
        this.insert("error",'Login başarılı');
    }

    static hide() {
        console.log("modal kapatıldı");
        document.getElementById("modal").classList.remove("modal-show");
    }
    
    static async insert(type,message){
        // wait,warning,error,check
        const div=document.createElement('div')
        div.classList.add('row','block');
        
        const img =document.createElement('img');
        img.id='img'+ capitalizeFirsLetter(type);
        img.src='/public/img/icon/'+ type + '.png';
        img.classList.add('padding-small');
        if(type==='wait') img.classList.add('spin');
        div.appendChild(img);  

        const span= document.createElement('span');
        span.classList.add('large');
        span.innerText=message;
        div.appendChild(span);


        
        this.modalBody.appendChild(div)
         
    }
    static progress(start,stop){
        let counter=start;
        modalProgressBar.classList.add('theme-l2')
        modalProgressBar.classList.remove('green','card')
        const intervalCounter=setInterval(
            ()=>{
                if(counter>stop){ 
                    clearInterval(intervalCounter);
                    modalProgressBar.classList.remove('theme-l2')
                    modalProgressBar.classList.add('green','card')
                }
                else{
                    modalProgressBar.style.width=counter + '%'  ;
                    counter++;
                }
            },10
        )
    }
}
 

class Member{
    static async register(){
        try{
            // alert();
            const email= document.getElementById('email');
            const password=document.getElementById('password');
            const response = await fetch('/api/member/register',{
                method:'POST',
                headers:{'Content-Type':'application/json'},
                body:JSON.stringify({email,password})
            });
            // const data= await response.json();
            const data= await response.text() ;
            console.log('Response:', data);
        }catch(error){
            console.error('member register error:', error)
        };


    };

 
    static validateRegisterForm() {
        const emailInput = document.getElementById('email');
        const passwordInput1 = document.getElementById('password1');
        const passwordInput2 = document.getElementById('password2');
        const contractInput = document.getElementById('contract');
    
        const reportEmail = document.getElementById('reportEmail');
        const reportPass1 = document.getElementById('reportPass1');
        const reportPass2 = document.getElementById('reportPass2');
        const reportPassEqual = document.getElementById('reportPassEqual');
        const reportContract = document.getElementById('reportContract');
        const btnRegister=document.getElementById('btnRegister');
    
        const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const regexPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,32}$/;


        const validEmail = regexEmail.test(emailInput.value);
        const validPassword1 = regexPassword.test(passwordInput1.value);
        const validPassword2 = regexPassword.test(passwordInput2.value);
        const equalPasswords = passwordInput1.value === passwordInput2.value;
        const contractChecked = contractInput.checked;

        function updateValidation(element, report, isValid, successMsg, errorMsg) {
            if (isValid) {
                element.classList.remove('yellow');
                element.classList.add('green', 'animate-zoom');
                report.classList.add('green');
                report.classList.remove('red');
                report.innerText = successMsg;
            } else {
                element.classList.remove('green', 'animate-zoom');
                element.classList.add('yellow');
                report.classList.add('red');
                report.classList.remove('green');
                report.innerText = errorMsg;
            }
        }
    
        updateValidation(emailInput, reportEmail, validEmail, 'Geçerli', 'Geçersiz');
        updateValidation(passwordInput1, reportPass1, validPassword1, 'Geçerli', 'Geçersiz');
        updateValidation(passwordInput2, reportPass2, validPassword2, ' Geçerli', 'Geçersiz');
        updateValidation(passwordInput2, reportPassEqual, equalPasswords, 'Aynı', 'Farklı');
        updateValidation(contractInput, reportContract, contractChecked, 'Onaylandı', 'Onaylanmadı');
        if(validEmail&&validPassword1 && validPassword2 && equalPasswords && contractChecked ){
            btnRegister.disabled=false;
            btnRegister.classList.remove('red');
            btnRegister.classList.add('green', 'animate-zoom');
        }
        else{
            btnRegister.disabled=true;
            btnRegister.classList.remove('green');
            elebtnRegisterment.classList.add('red', 'animate-zoom');
        }
        // if (contractChecked) {
        //     reportContract.classList.add('green');
        //     reportContract.classList.remove('red');
        //     reportContract.innerText = 'Sözleşme Onaylandı';
        // } else {
        //     reportContract.classList.add('red');
        //     reportContract.classList.remove('green');
        //     reportContract.innerText = 'Sözleşme Onaylanmadı';
        // }
    }
    

    static async login(event){
        event.preventDefault();
        try{
            Modal.show("Üye Grişi Yapılıyor","");
            //   Modal.progress(20,100);
            // alert();
            const email= document.getElementById('email').value;
            const password=document.getElementById('password').value;
            const response = await fetch('/api/member',{
                method:'POST',
                headers:{'Content-Type':'application/json'},
                body:JSON.stringify({email,password,job:'login'}),
                credentials: 'include'  // php nin session görmesi ve  ÇEREZLERİN GÖNDERİLMESİNİ SAĞLAR
            });
            // const data= await response.json();
            const data= await response.text() ;
            console.log(data);
        }catch(error){
            console.error('member register error:', error)
        }
    }
}


 