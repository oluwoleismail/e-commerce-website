const formLogin = document.querySelector(".signin-form form"),
    sendLButton = formLogin.querySelector(".form-button input");

const errorTextL = document.querySelector(".sign-in .container .error-text");

formLogin.onsubmit = (e) =>{
    e.preventDefault();
}

sendLButton.onclick = () =>{
    let xhr = new XMLHttpRequest();
    let done = XMLHttpRequest.DONE;
    xhr.open("POST", "../php/allrequests.php?login", true);
    xhr.onload = () =>{
        if(xhr.readyState === done){
            if(xhr.status === 200){
                let data = xhr.response;
                
                if(data == "success"){
                    location.href="../?loggedin";
                }else{
                    errorTextL.style.display="block";
                    errorTextL.textContent= data;
                }
                if(data == "admin success"){
                    location.href="../admin/";
                }
            }
        }
    }
    let formdata = new FormData(formLogin);
    xhr.send(formdata);
}
