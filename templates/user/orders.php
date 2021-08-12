<ul>
    <?php foreach( $this->orders as $order ) : ?>
        <li>
            <p><?= $order[ 'orderId' ] ?> | <?= $order[ 'orderUserId' ] ?> | <?= $order[ 'orderStatus' ] ?> </p>
        </li>
    <?php endforeach; ?>
</ul>