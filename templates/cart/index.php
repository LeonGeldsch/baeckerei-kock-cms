<ul>
    <?php foreach( $this->items as $item ) : ?>
        <li>
            <p class="itemId">ID: <?= $item[ 'itemId' ] ?></p>
            <p class="itemAmount">Amount: <?= $item[ 'itemAmount' ] ?></p>
            <p class="itemName">Name: <?= $item[ 'itemName' ] ?></p>
        </li>
    <?php endforeach ?>
</ul>