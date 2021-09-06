var allOrderExpandButtons = document.querySelectorAll('.order-expand-button');
var allOrderDeleteButtons = document.querySelectorAll('.order-delete-button');

var allOrderItems = document.querySelectorAll('.user-order-items');

var allOrders = document.querySelectorAll('.user-order-info');


allOrderExpandButtons.forEach((button, index) => {
    button.addEventListener('click', ()=> {
        allOrderExpandButtons[index].classList.toggle('active');
        allOrderItems[index].classList.toggle('active');
    });
});


allOrderDeleteButtons.forEach((button, index) => {
    button.addEventListener('click', ()=> {

        let requestData = {'orderId': allOrders[index].getAttribute('data-id')};

        ajax.post('/user/removeOrder', requestData, callbackFunction, true);

        allOrders[index].classList.add('hidden');

        setTimeout(()=> {
            allOrders[index].style.display = 'none';
        }, 500);
    });
});


function callbackFunction() {

}