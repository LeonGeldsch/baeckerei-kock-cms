<form action="/cart/buycartitems" method="POST">
    <?php if( !empty($this->items) ) : ?>
    <?php foreach( $this->items as $item ) : ?>

        <label for="<?= $item[ 'itemId' ] ?>"><?= $item[ 'itemName' ] ?></label>
        <input type="text" name="<?= $item[ 'itemId' ] ?>" value="<?= $item[ 'itemAmount' ] ?>">

    <?php endforeach ?>
    <input type="date" name="pickupTime" id="pickupTime" value="123123">
    <button type="submit">Confirm Order</button>
    <?php else : ?>
    <p><?= _('You have no items in your cart.') ?></p>
    <a href="/products">look for items</a>
    <?php endif ?>
</form>