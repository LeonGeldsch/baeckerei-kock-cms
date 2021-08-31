<div class="product-grid">
    <?php foreach( $this->products as $product ) : ?>
        <div class="product-grid-item" data-id="<?= $product[ 'productId' ] ?>">
            <div class="item-image-wrapper"><img src="<?= $product[ 'productImageThumbUri' ] ?>" alt="" class="item-image"></div>
            <div class="product-item-inner">
                <h2 class="item-name"><?= $product[ 'productName' ] ?></h2>
                <div class="item-interaction">
                    <input type="number" name="amount" id="amount" class="item-amount-input" value="1">
                    <button class="item-button">Add to cart</button>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<script>

    var headerCartAmount = document.querySelector('.header-cart-amount');

    var allItems = document.querySelectorAll('.product-grid-item');

    var allProductNames = document.querySelectorAll('.item-name');
    var allAddToCartButtons = document.querySelectorAll('.item-button');
    var allAmountInputs = document.querySelectorAll('.item-amount-input');

    var allCartItems = document.querySelectorAll('.cart-items p');
    var cart = document.querySelector('.cart-items');

    for (let i = 0; i < allItems.length; i++) {
        
        allAddToCartButtons[i].addEventListener('click', ()=> {

            let requestData = {'itemId': allItems[i].dataset.id, 'itemAmount': allAmountInputs[i].value, 'itemName': allProductNames[i].textContent};

            ajax.post('/cart/updatecart', requestData, callbackFunction, true);
        });
    }

    function callbackFunction (data) {
        //console.log( JSON.parse( data ));
        updateCart(JSON.parse(data));
    }

    function updateCart(items) {
        cart.innerHTML = '';
        let totalAmount = 0;
        items = Object.entries(items);
        console.log(items);
        for (let i = 0; i < items.length; i++) {
            totalAmount += items[i][1].itemAmount;

            let newLine = document.createElement('p');
            newLine.innerHTML = items[i][1].itemName + ': ' + items[i][1].itemAmount;
            newLine.setAttribute('data-id', items[i][1].itemId);
            cart.appendChild(newLine);
        }
        //console.log(totalAmount);
        if (totalAmount > 0) {
            headerCartAmount.innerHTML = totalAmount;
            headerCartAmount.style.display = 'grid';
        } else {
            headerCartAmount.style.display = 'none';
        }
    }



    // for Ajax call to add to cart and display cart

    var ajax = {};
    ajax.x = function () {
        if (typeof XMLHttpRequest !== 'undefined') {
            return new XMLHttpRequest();
        }
        var versions = [
            "MSXML2.XmlHttp.6.0",
            "MSXML2.XmlHttp.5.0",
            "MSXML2.XmlHttp.4.0",
            "MSXML2.XmlHttp.3.0",
            "MSXML2.XmlHttp.2.0",
            "Microsoft.XmlHttp"
        ];

        var xhr;
        for (var i = 0; i < versions.length; i++) {
            try {
                xhr = new ActiveXObject(versions[i]);
                break;
            } catch (e) {
            }
        }
        return xhr;
    };

    ajax.send = function (url, callback, method, data, async) {
        if (async === undefined) {
            async = true;
        }
        var x = ajax.x();
        x.open(method, url, async);
        x.onreadystatechange = function () {
            if (x.readyState == 4) {
                callback(x.responseText)
            }
        };
        if (method == 'POST') {
            x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        }
        x.send(data)
    };

    ajax.get = function (url, data, callback, async) {
        var query = [];
        for (var key in data) {
            query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
        }
        ajax.send(url + (query.length ? '?' + query.join('&') : ''), callback, 'GET', null, async)
    };

    ajax.post = function (url, data, callback, async) {
        var query = [];
        for (var key in data) {
            query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
        }
        ajax.send(url, callback, 'POST', query.join('&'), async)
    };

</script>