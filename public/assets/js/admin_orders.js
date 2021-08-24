var allOrderStatusSelects = document.querySelectorAll('.orderStatusSelect');
var allOrderDeleteButtons = document.querySelectorAll('.orderDeleteButton');
var allOrders = document.querySelectorAll('.order');

allOrderStatusSelects.forEach(select => {
    select.addEventListener('change', (e)=> {
        let requestData = {'orderId': e.target.getAttribute('data-orderId'), 'newStatus': e.target.value};
    
        ajax.post('/admin/updateOrderStatus', requestData, callbackFunction, true);

    });

});


allOrderDeleteButtons.forEach((button, index) => {
    button.addEventListener('click', ()=> {
        let requestData = {'orderId': button.getAttribute('data-orderId')};

        ajax.post('/admin/removeOrder', requestData, callbackFunction, true);

        allOrders[index].style.display = 'none';

    });
});


function callbackFunction(e) {
}