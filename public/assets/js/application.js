var cartIcon = document.querySelector('#header-cart-icon');
var cartModalWrapper = document.querySelector('.cart-modal-wrapper');
var cartModalCloseButton = document.querySelector('.cart-modal-close-button');

cartIcon.addEventListener('click', ()=> {
    cartModalWrapper.classList.toggle('active');
});
cartModalWrapper.addEventListener('click', (e)=> {
    if(e.target === cartModalWrapper || e.target === cartModalCloseButton) cartModalWrapper.classList.toggle('active');
});