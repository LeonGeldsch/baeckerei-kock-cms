<h4>Please select the day you want to see the orders of</h4>
<form action="" method="post">
    <input type="date" name="date">
    <button type="submit">Submit</button>
</form>
<a href="/admin/orders">
    <button>go back</button>
</a>
<h2>Orders: <?= $this->date ?></h2>
<ul>
    <?php foreach( (array) $this->orders as $order ) : ?>
        <li>
            <p>
                <?= date( 'D, d M Y', $order[ 'orderPickupTime' ] )  ?>
                <select name="status" class="orderStatusSelect" data-orderId="<?= $order[ 'orderId' ] ?>">
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