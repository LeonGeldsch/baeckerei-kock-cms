<ul>
    <?php foreach( $this->categories as $category ) : ?>
        <li class="product-category">
            <a href="<?= APP_URL . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . strtolower( $category[ 'categoryName' ] ) ?>"><?= $category[ 'categoryName' ] ?></a>
        </li>
    <?php endforeach ?>
</ul>