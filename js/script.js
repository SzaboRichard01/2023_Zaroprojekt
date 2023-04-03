const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('links')[0]

toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})

function hanyNap(selectObject){
  let hnap = selectObject.value;

  let mezok = "";
  for (let index = 1; index <= hnap; index++) {
    mezok += '<div class="enap"><label for="mnap' + index + '">Melyik napra?*</label><select name="mnap' + index + '" id="mnap' + index + '"><option disabled selected>Válasszon egy lehetőséget</option>';
    if(hnap == 1){
      mezok += '<option value="Minden alkalomra">Minden alkalomra</option>';
    }
    mezok += '<option value="Hétfő">Hétfő</option><option value="Kedd">Kedd</option><option value="Szerda">Szerda</option><option value="Csütörtök">Csütörtök</option><option value="Péntek">Péntek</option><option value="Szombat">Szombat</option><option value="Vasárnap">Vasárnap</option></select><label for="edzes' + index + '">Edzés leírása az adott napra:*</label><textarea name="edzes' + index + '" id="edzes' + index + '"></textarea></div>';
  }
  document.querySelector('#mezonapok').innerHTML = mezok;
}

function etrendNap(selectObject2){
  let hnap = selectObject2.value;

  let mezok = "";
  for (let index = 1; index <= hnap; index++) {
    mezok += '<div class="etnap"><label for="etr-napra' + index + '">Melyik napra?*</label><select name="etr-napra' + index + '" id="etr-napra' + index + '"><option disabled selected>Válasszon egy lehetőséget</option>';
    if(hnap == 1){
      mezok += '<option value="Minden alkalomra">Minden alkalomra</option>';
    }
    mezok += '<option value="Hétfő">Hétfő</option><option value="Kedd">Kedd</option><option value="Szerda">Szerda</option><option value="Csütörtök">Csütörtök</option><option value="Péntek">Péntek</option><option value="Szombat">Szombat</option><option value="Vasárnap">Vasárnap</option></select><label for="etr-etrend' + index + '">Étrend az adott napra:*</label><textarea name="etr-etrend' + index + '" id="etr-etrend' + index + '"></textarea></div>';
  }
  document.querySelector('#etrendnapok').innerHTML = mezok;
}

//Meglévő kapcsolat törlése
function MeglevoTorles(torlendo, teljesnev) {
  Swal.fire({
    title: 'Biztosan törölni szeretné?',
    text: "Ezzel törlődik "+teljesnev+" profilhoz kapcsolódó összes edzésterve! Ezt a műveletet nem tudja majd visszavonni!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#55be3b',
    cancelButtonColor: '#080B0C',
    confirmButtonText: 'Törlés',
    cancelButtonText: 'Mégsem'
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "?eftorlendo=" + torlendo;
    }
  })
}
//------

function btnElfogad(azonosito, teljNev) {
  Swal.fire({
    title: 'Elfogadva!',
    text: "Elfogadtad " + teljNev + " felkérését!",
    icon: 'success',
    confirmButtonColor: '#55be3b',
    confirmButtonText: 'OK',
  }).then((result) => {
    if (result.isConfirmed) {
      location.href='muveletek/fMegerosites.php?kuldo_az=' + azonosito;
    }
  })
}

function btnElutasit(az, tNev) {
  Swal.fire({
    title: 'Biztosan elutasítja?',
    text: "Ezzel elutasítja "+tNev+" felkérését!",
    icon: 'error',
    showCancelButton: true,
    confirmButtonColor: '#55be3b',
    cancelButtonColor: '#080B0C',
    confirmButtonText: 'Igen',
    cancelButtonText: 'Nem'
  }).then((result) => {
    if (result.isConfirmed) {
      location.href='muveletek/fElutasitas.php?kuldo_az=' + az;
    }
  })
}

//Edzésterv törlése
function btnEtervTorles(nev, etneve, etervid){
  Swal.fire({
    title: 'Biztosan törölni szeretné?',
    text: "Ezzel törlődik "+ nev +" kliensének "+ etneve +" nevű edzésterve! Ezt a műveletet nem tudja majd visszavonni!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#55be3b',
    cancelButtonColor: '#080B0C',
    confirmButtonText: 'Törlés'
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "muveletek/edzestervTorles.php?edzesterv=" + etervid;
    }
  })
}
//----------

function tevTeljesBezar(){
  let tevTeljes = document.querySelector(".tevTeljes");
  tevTeljes.style.display = "none";
}

function tevTejlTorles(datum, tevazon){
  Swal.fire({
    title: 'Biztosan törölni szeretné?',
    text: "Ezzel törlődik "+ datum +" napján rögzített tevékenysége! Ezt a műveletet nem tudja majd visszavonni!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#55be3b',
    cancelButtonColor: '#080B0C',
    confirmButtonText: 'Törlés',
    cancelButtonText: 'Mégsem'
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "muveletek/tevTorlese.php?tevaz=" + tevazon;
    }
  })
}