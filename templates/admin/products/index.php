<a href="/admin/products/new">Add new product</a>
<ul>
    <?php foreach( $this->products as $product ) : ?>
        <li>

            <?php 
                echo sprintf('Product name: %1$s;  Price: %2$s; Active: %3$s; Category: %4$s', $product[ 'productName' ], $product[ 'productPrice' ], $product[ 'productActive' ], $product[ 'productCategory' ]);
            ?>
        </li>
    <?php endforeach ?>
</ul>