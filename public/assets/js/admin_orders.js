var allOrderStatusSelects = document.querySelectorAll('.orderStatusSelect');


allOrderStatusSelects.forEach(select => {
    select.addEventListener('change', (e)=> {
        let requestData = {'orderId': e.target.getAttribute('data-orderId'), 'newStatus': e.target.value};
    
        ajax.post('/admin/updateOrderStatus', requestData, callbackFunction, true);

    });

});

function callbackFunction(e) {
    console.log(e);
}