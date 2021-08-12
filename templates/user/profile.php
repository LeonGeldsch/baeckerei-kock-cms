<style>
    .posts__list-item {
        position: relative;
    }
    .posts__anchor {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        z-index: 10;
    }
    .posts__list-item--repost {
        background: #ccc;
    }
</style>

<h1><?= $this->profile[ 'username' ] ?></h1>
<ul class="posts__list">
    <?php foreach( $this->posts as $post ) : ?>
        <li class="posts__list-item <?= $post[ 'repost' ] === TRUE ? 'posts__list-item--repost' : 'posts__list-item--own' ?>">
            <a class="posts__anchor" href="/feed/post/<?= $post[ 'post_id' ] ?>"></a>
            <img src="<?= json_decode( unserialize( $post[ 'avatar' ] ), TRUE )[ 'thumbnail' ][ 'fileuri' ] ?>">
            <p><?= $post[ 'username' ] ?></p>
            <p><?= date( 'd.M.Y - H:i', $post[ 'timestamp' ] ) ?></p>
            <p><?= $post[ 'message' ] ?></p>
            <p>Comments (<?=$post[ 'comments' ] ?>)</p>
        </li>
    <?php endforeach; ?>
</ul>
