<h2 class="user-heading">My profile</h2>
<div class="user-wrapper">
    <div class="user-nav">
        <a href="/user/orders" class="user-nav-link">Orders</a>
        <a href="/logout" class="user-nav-link">Logout</a>
        <a href="/user/notifications" class="user-nav-link">Notifications</a>
    </div>
    <div class="user-orders">
        <div class="user-orders-filter">
            <a href="">Date</a>
            <a href="">Time</a>
            <a href="">Amount</a>
            <a href="">Price</a>
            <a href="">Status</a>
            <a href="">More info</a>
            <a href="">Delete Order</a>
        </div>
        <ul class="user-orders-list">
            <?php foreach( $this->orders as $order ) : ?>
                <li class="user-orders-list-item">
                    <div class="user-order-info" data-id="<?= $order[ 'orderId' ] ?>">
                        <p><?= date( 'd.m.o', $order[ 'orderPickupTime' ] )  ?></p>
                        <p><?= date( 'G:i', $order[ 'orderPickupTime' ] ) ?></p>
                        <p><?= $order[ 'orderAmount' ] ?></p>
                        <p><?= $order[ 'orderPrice' ] ?>€</p>
                        <p><?= $order[ 'orderStatus' ] ?></p>
                        <div>
                            <img src="/assets/img/chevrons-right.svg" alt="" class="order-expand-button">
                        </div>
                        <div>
                            <img src="/assets/img/x-circle.svg" alt="" class="order-delete-button">
                        </div>
                    </div>
                    <ul class="user-order-items">
                        <div class="user-order-filter">
                            <p href="">Product name</p>
                            <p href="">Price (pp)</p>
                            <p href="">Amount</p>
                            <p href="">Price (total)</p>
                        </div>
                        <?php foreach( $order[ 'orderItems' ] as $orderItem ) : ?>
                            <li class="user-order-item">
                                <p><?= $orderItem[ 'orderItemProduct' ][ 'productName' ] ?></p>
                                <p><?= $orderItem[ 'orderItemProduct' ][ 'productPrice' ] ?>€</p>
                                <p><?= $orderItem[ 'orderItemAmount' ] ?></p>
                                <p><?= $orderItem[ 'orderItemPrice' ] ?>€</p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

