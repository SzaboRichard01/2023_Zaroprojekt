//regisztráció
//profil típus
let ptipus = document.getElementById('ptipus');
ptipus.onchange = function (){
    sessionStorage.setItem('ptipus', ptipus.value);
}

if(sessionStorage['ptipus']){
    ptipus.value = sessionStorage.getItem('ptipus');
}

//nem (férfi/nő)
let neme = document.getElementById('neme');
neme.onchange = function (){
    sessionStorage.setItem('neme', neme.value);
}

if(sessionStorage['neme']){
    neme.value = sessionStorage.getItem('neme');
}

//vezetéknév
let vnev = document.getElementById('vnev');
vnev.onchange = function(){
    sessionStorage.setItem('vnev', vnev.value);
}

if(sessionStorage['vnev']){
    vnev.value = sessionStorage.getItem('vnev');
}

//keresztnév
let knev = document.getElementById('knev');
knev.onchange = function(){
    sessionStorage.setItem('knev', knev.value);
}

if(sessionStorage['knev']){
    knev.value = sessionStorage.getItem('knev');
}

//e-mail
let email = document.getElementById('email');
email.onchange = function(){
    sessionStorage.setItem('email', email.value);
}

if(sessionStorage['email']){
    email.value = sessionStorage.getItem('email');
}

//bemutatkozó
$("#bemutatkozo").redactor({
    keyupCallback: function(){
        let szoveg = $('#bemutatkozo').redactor().getCode();
        sessionStorage.setItem('bemutatkozo', szoveg);
    }
});

if(sessionStorage['bemutatkozo']){
    $('#bemutatkozo').redactor().setCode(sessionStorage.getItem('bemutatkozo'));
}

//telefon
let telefon = document.getElementById('telefon');
telefon.onchange = function(){
    sessionStorage.setItem('telefon', telefon.value);
}

if(sessionStorage['telefon']){
    telefon.value = sessionStorage.getItem('telefon');
}
//-----