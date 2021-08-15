<ul>
    <?php foreach( $this->orders as $order ) : ?>
        <li>
            <p>Pickup time: <?= date( 'D, d M Y', $order[ 'orderPickupTime' ] )  ?> | <?= $order[ 'orderStatus' ] ?> </p>
            <ul>
                <?php foreach( $order[ 'orderItems' ] as $orderItem ) : ?>
                    <li>
                        <p><?= $orderItem[ 'orderItemProductName' ] ?> | <?= $orderItem[ 'orderItemAmount' ] ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>