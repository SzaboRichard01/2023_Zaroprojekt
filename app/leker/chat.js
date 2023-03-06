// const form = document.querySelector(".chat-szoveg-kuldes"),
// inputField = document.querySelector("#szoveg"),
// sendBtn = document.querySelector("#ChatUzenet"),
const chatBox = document.querySelector(".chatUzenetek");


// inputField.focus();
// inputField.onkeyup = ()=>{
//     if (inputField.value != "") {
//         sendBtn.disabled = false;
//     }else{
//         sendBtn.disabled = true;
//     }
// }
// sendBtn.onclick = ()=>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "chatbeszur.php", true);
//     xhr.onload = ()=>{
//         if (xhr.readyState === XMLHttpRequest.DONE ) {
//             if (xhr.status === 200) {
//                 inputField.value = "";
//                 scrollToBottom();
//             }
//         }
//     }
//     let formData = new formData(form);
//     xhr.send(formData);
// }
// chatBox.onmouseenter = ()=>{
//     chatBox.classList.add("active");
// }
// chatBox.onmouseleave = ()=>{
//     chatBox.classList.remove("active");
// }

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "leker/chatleker.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
            }
        }
    }
    xhr.send();
}, 500)