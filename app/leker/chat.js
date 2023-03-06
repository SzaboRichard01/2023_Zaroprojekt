const form = document.querySelector(".chat-szoveg-kuldes"),
inputField = form.querySelector("#szoveg"),
sendBtn = form.querySelector("#ChatUzenet"),
chatBox = document.querySelector(".chatUzenetek");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if (inputField.value != "") {
        sendBtn.disabled = false;
    }else{
        sendBtn.disabled = true;
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "chatbeszur.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE ) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    let formData = new formData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "chatleker.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
}, 500)

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}