
const renderAccordion = () => {
    const categories = document.getElementById('categories');
    const popupElement = document.getElementById("catalogPopup");

    
    if (!categories || !popupElement) return;

    const accordion = document.querySelector('.categories').cloneNode(true);


    const items = Array.from(accordion.querySelectorAll('.accordion-header'));


    items.forEach((el) => {
        el.addEventListener('click', (e) => {
      
            e.currentTarget.parentElement.classList.toggle('accordion-item-show');
        })
    });
    popupElement.classList.add('categories');
    popupElement.insertAdjacentElement('beforeend', accordion);
}

const hamburger = () => {
    const hamburgerButton = document.getElementById("catalogHamb");
    const popupElement = document.getElementById("catalogPopup");


    if (!hamburgerButton || !popupElement) return;

    hamburgerButton.addEventListener('click', (e) => {
        e.preventDefault();

    
        e.currentTarget.classList.toggle('active');
        popupElement.classList.toggle('open');
    })
}

const init = () => {
    renderAccordion();
    hamburger();
}

document.addEventListener('DOMContentLoaded', init);

