<a href="/admin/products/new">Add new product</a>
<ul>
    <?php foreach( $this->products as $product ) : ?>
        <li class="product">

            <?php 
                echo sprintf('Product name: %1$s;  Price: %2$s; Active: %3$s; Category: %4$s', $product[ 'productName' ], $product[ 'productPrice' ], $product[ 'productActive' ], $product[ 'productCategory' ]);
            ?>
            <button data-productId="<?= $product[ 'productId' ] ?>" class="productDelete">Delete</button>
        </li>
    <?php endforeach ?>
</ul>


<script defer>
    var allDeleteButtons = document.querySelectorAll('.productDelete');

    var allProducts = document.querySelectorAll('.product');

    allDeleteButtons.forEach((button, index) => {
        button.addEventListener('click', (e)=> {


            let requestData = {'productId': e.target.getAttribute('data-productId')};

            console.log(e.target.getAttribute('data-productId'), requestData);
    
            ajax.post('/admin/products/delete', requestData, callbackFunction, true);

            allProducts[index].style.display = 'none';
        });
    });

    function callbackFunction(e) {
        console.log(e);
    }

</script>
