const form = document.querySelector(".chat-szoveg-kuldes");
const inputField = document.querySelector("#szoveg");
const sendBtn = document.querySelector("#ChatUzenet");
const chatBox = document.querySelector(".chatUzenetek");


inputField.focus();
inputField.onkeyup = ()=>{
    if (inputField.value != "") {
        sendBtn.disabled = false;
    }else{
        sendBtn.disabled = true;
    }
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

let url = window.location.href;
sendBtn.style.display = "none";
inputField.style.display = "none";

//Chat ablak megjelenÍtése, az URL-ben létezik a "chat=". 
if(url.includes("chat=")){
    sendBtn.style.display = "unset";
    inputField.style.display = "unset";
    
    //AJAX a chat felülethez
    setInterval(() =>{
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "leker/chatleker.php", true);
        xhr.onload = ()=>{
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if(!chatBox.classList.contains("active")){
                        scrollToBottom();
                    }
                }
            }
        }
        xhr.send();
    }, 500)
}

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

//Chat üzenet elküldése enter megnyomásakor
inputField.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
      event.preventDefault();
      sendBtn.click();
      scrollToBottom();
    }
})
//------