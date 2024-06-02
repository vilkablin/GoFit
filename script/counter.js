
const step = 1;

const element1 = document.querySelector(".one");
const element2 = document.querySelector(".two");
const element3 = document.querySelector(".three");

outNum(96, element1, 5000);
outNum(19, element2, 4000);
outNum(1342, element3, 1000);

function outNum(num, element, time) {
  let n = 0;
  
  let t = Math.round(time / (num / step));

  let interval = setInterval(() => {
    n = n + step;

    if (n >= num) {
      clearInterval(interval);
    }

    element.innerHTML = n;
  }, t);
}
