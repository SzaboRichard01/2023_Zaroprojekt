const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('links')[0]

toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})

function hanyNap(selectObject){
  let hnap = selectObject.value;

  let mezok = "";
  for (let index = 1; index <= hnap; index++) {
    mezok += '<div class="enap"><label for="mnap' + index + '">Melyik napra?</label><input type="text" name="mnap' + index + '" id="mnap' + index + '"><label for="edzes' + index + '">Edzés leírása az adott napra:</label><textarea name="edzes' + index + '" id="edzes' + index + '"></textarea></div>';
  }
  document.querySelector('#mezonapok').innerHTML = mezok;
}

function etrendNap(selectObject2){
  let hnap = selectObject2.value;

  let mezok = "";
  for (let index = 1; index <= hnap; index++) {
    mezok += '<div class="etnap"><label for="etr-napra' + index + '">Melyik napra?</label><input type="text" name="etr-napra' + index + '" id="etr-napra' + index + '"><label for="etr-etrend' + index + '">Étrend az adott napra:</label><textarea name="etr-etrend' + index + '" id="etr-etrend' + index + '"></textarea></div>';
  }
  document.querySelector('#etrendnapok').innerHTML = mezok;
}

function MeglevoTorles(torlendo, teljesnev) {
  if(confirm("Biztosan törölni szeretné?\nEzzel törlődik "+teljesnev+" profilhoz kapcsolódó összes edzésterve!") == true){
    location.href = "?eftorlendo=" + torlendo;
  }
}

//Edzésterv törlése
function btnEtervTorles(nev, etneve, etervid){
  if(confirm("Biztosan törölni szeretné "+ nev +" kliensének " + etneve+" nevű edzéstervét?") == true){
    location.href = "muveletek/edzestervTorles.php?edzesterv=" + etervid;
  }
}