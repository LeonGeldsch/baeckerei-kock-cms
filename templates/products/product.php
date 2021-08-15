<ul>
    <?php foreach( $this->products as $product ) : ?>
        <li>
            <p class="productName"><?= $product[ 'productName' ] ?></p>
            <p class="productId"><?= $product[ 'productId' ] ?></p>
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="amountInput" value="1">
            <button class="addToCartButton">Add to cart</button>
        </li>
    <?php endforeach ?>
</ul>
<script>

    var allProductIds = document.querySelectorAll('.productId');
    var allProductNames = document.querySelectorAll('.productName');
    var allAddToCartButtons = document.querySelectorAll('.addToCartButton');
    var allAmountInputs = document.querySelectorAll('.amountInput');

    var cart = document.querySelectorAll('.cart p');

    for (let i = 0; i < allAddToCartButtons.length; i++) {
        
        allAddToCartButtons[i].addEventListener('click', ()=> {

            let requestData = {'itemId': allProductIds[i].textContent, 'itemAmount': allAmountInputs[i].value, 'itemName': allProductNames[i].textContent};

            ajax.post('/cart/updatecart', requestData, callbackFunction, true);
        });
    }

    function callbackFunction (data) {
        console.log(data);
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