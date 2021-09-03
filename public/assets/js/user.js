var allOrderExpandButtons = document.querySelectorAll('.order-expand-button');

var allOrderItems = document.querySelectorAll('.user-order-items');

allOrderExpandButtons.forEach((button, index) => {
    button.addEventListener('click', ()=> {
        allOrderExpandButtons[index].classList.toggle('active');
        allOrderItems[index].classList.toggle('active');
    });
});