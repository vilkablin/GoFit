
const accordionHeaders =Array.from(document.querySelectorAll(".accordion-header"));

accordionHeaders.forEach((accHeader)=>{
  accHeader.addEventListener("click", openAccordion = (e) =>{
    e.preventDefault;
    let currentAcc = e.target.closest(".accordion-item");
    currentAcc.classList.toggle("accordion-item-show");
  });
}
)

