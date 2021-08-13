<ul>
    <?php foreach( $this->categories as $category ) : ?>
        <li>
            <a href="products/<?= $category[ 'categoryName' ] ?>"><?= $category[ 'categoryName' ] ?></a>
        </li>
    <?php endforeach ?>
</ul>