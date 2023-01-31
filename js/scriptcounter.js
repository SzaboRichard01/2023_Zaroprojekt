//Selects the class named 'counter' and stores it in a 'counters' variable.
let counters = document.querySelectorAll('.counter');
let speed = 100;

counters.forEach(counter => {
    let updateCount = () => {
        let target =+ counter.getAttribute('data-target');
        let count =+ counter.innerText;

        let inc = Math.floor((target - count) / speed);

        if (count < target && inc > 0) {
            counter.innerText = count + inc;
            setTimeout(updateCount, 8);
        }else{
            count.innerText = target;
        }
    }

    updateCount();
});