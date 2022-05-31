const formSignup = document.querySelector(".signup-form form"),
    sendSButton = formSignup.querySelector(".form-button input");

const errorText = document.querySelector(".signup .container .error-text");

formSignup.onsubmit = (e) =>{
    e.preventDefault();
}

sendSButton.onclick = () =>{
    let xhr = new XMLHttpRequest();
    let done = XMLHttpRequest.DONE;
    xhr.open("POST", "../php/allrequests.php?signup", true);
    xhr.onload = () =>{
        if(xhr.readyState === done){
            if(xhr.status === 200){
                let data = xhr.response;
                
                if(data == "success"){
                    location.href="?login"
                }else{
                    errorText.style.display="block";
                    errorText.textContent= data;
                }
            }
        }
    }
    let formdata = new FormData(formSignup);
    xhr.send(formdata);
}
