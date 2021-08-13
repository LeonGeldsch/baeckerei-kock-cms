<ul>
    <?php foreach( $this->categories as $category ) : ?>
        <li>
            <a href="<?= $category[ 'categoryName' ] ?>"><?= $category[ 'categoryName' ] ?></a>
        </li>
    <?php endforeach ?>
</ul>