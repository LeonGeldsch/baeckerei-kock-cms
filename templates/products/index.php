<ul class="product-categories">
    <?php foreach( $this->categories as $category ) : ?>
        <li class="product-category">
            <a href="<?= APP_URL . "products" . DIRECTORY_SEPARATOR . strtolower( $category[ 'categoryName' ] ) ?>"><?= $category[ 'categoryName' ] ?></a>
        </li>
    <?php endforeach ?>
</ul>