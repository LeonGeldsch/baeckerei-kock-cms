today:

<ul>
    <?php foreach( (array) $this->orders as $order ) : ?>
        <li>
            <p>
                <?= date( 'D, d M Y', $order[ 'orderPickupTime' ] )  ?>
                <select name="status" id="orderStatus">
                    <option value="in progress" <?php if( $order[ 'orderStatus' ] === 'in progress' ) echo 'selected' ?>>in progress</option>
                    <option value="ready" <?php if( $order[ 'orderStatus' ] === 'ready' ) echo 'selected' ?>>ready</option>
                    <option value="collected" <?php if( $order[ 'orderStatus' ] === 'collected' ) echo 'selected' ?>>collected</option>
                </select>
                <?= $order[ 'orderUserFirstname' ] . " " . $order[ 'orderUserLastname' ] ?>
            </p>
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