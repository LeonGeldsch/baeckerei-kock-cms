<!--
<ul>
    <?php foreach( $this->items as $item ) : ?>
        <li>
            <p class="itemId">ID: <?= $item[ 'itemId' ] ?></p>
            <p class="itemAmount">Amount: <?= $item[ 'itemAmount' ] ?></p>
            <p class="itemName">Name: <?= $item[ 'itemName' ] ?></p>
        </li>
    <?php endforeach ?>
</ul>
<button>Confirm Order</button>
-->

<form action="/cart/buycartitems" method="POST">
    <?php foreach( $this->items as $index => $item ) : ?>

        <input type="text" name="<?= $item[ 'itemId' ] ?>" value="<?= $item['itemAmount'] ?>">

    <?php endforeach ?>
    <input type="number" name="pickupTime" id="pickupTime" value="123123">
    <button type="submit">Confirm Order</button>
</form>