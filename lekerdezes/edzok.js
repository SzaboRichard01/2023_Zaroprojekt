////teljes edző lista kiíratására
const EdzokLista = document.querySelector(".edzok-lista");

setInterval(()=> {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "lekerdezes/edzok.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                EdzokLista.innerHTML = data;
            }
        }
    }
    xhr.send();
}, 500);