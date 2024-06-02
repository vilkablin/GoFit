const body = document.body;
const hamb = document.querySelector("#hamb");
const popup = document.querySelector("#popup");

const nav = document.querySelector("#nav").cloneNode(1);

hamb.addEventListener("click", hambHandler);

function hambHandler(e){
e.preventDefault;
popup.classList.toggle("open");
hamb.classList.toggle("active");
body.classList.toggle("noscroll");
renderPopup();
}

function renderPopup(){
  popup.appendChild(nav);
}

const links = Array.from(nav.children);

links.forEach((link) => {
  link.addEventListener("click", closeOnClick);
});

function closeOnClick() {
  popup.classList.remove("open");
  hamb.classList.remove("active");
  body.classList.remove("noscroll");
};