<ul>
    <?php foreach( $this->products as $product ) : ?>
        <li>
            <p><?= $product[ 'productName' ] ?></p>
        </li>
    <?php endforeach ?>
</ul>