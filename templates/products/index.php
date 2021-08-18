<ul>
    <?php foreach( $this->categories as $category ) : ?>
        <li>
            <a href="<?= APP_URL . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . $category[ 'categoryName' ] ?>"><?= $category[ 'categoryName' ] ?></a>
        </li>
    <?php endforeach ?>
</ul>