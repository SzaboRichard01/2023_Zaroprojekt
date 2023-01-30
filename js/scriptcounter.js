let counters = document.querySelectorAll('.counter');
let speed = 100;

counters.forEach(counter => {
    let updateCount = () => {
        let target =+ counter.getAttribute('data-target');
        let count =+ counter.innerText;

        let inc = target / speed;

        if (count < target) {
            counter.innerText = count + inc;
            setTimeout(updateCount, 15);
        }else{
            count.innerText = target;
        }
    }

    updateCount();
});