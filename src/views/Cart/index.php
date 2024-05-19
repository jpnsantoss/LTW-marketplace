<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/itemlist.css'), "Wish List");
getNavbar();
?>

<body>
    <h1>My Cart</h1>

    <?php foreach ($data['items'] as $wishedItem) { ?>
        <article>
            <div class="desc">
                <p><b>Model: </b><?= $wishedItem->model ?></p>
                <p><b>Brand: </b><?= $wishedItem->brand ?></p>
                <p><b>Price: </b><?= $wishedItem->price ?>€</p>
                <p><b>Sold by: </b><?= $wishedItem->username ?></p>
            </div>
            <img src="<?= $wishedItem->url ?>" alt="Image">
            <form action="<?= URLROOT ?>/cart/<?= $wishedItem->item_id ?>/delete-item" method="POST">
                <?php getCSRFInput(); ?>
                <button type="submit" class="remove">Remove</button>
            </form>
            <form action="<?= URLROOT ?>/cart/<?= $wishedItem->item_id ?>/checkout" method="POST">
                <?php getCSRFInput(); ?>
                <button type="submit" class="progress">Checkout Item</button>
            </form>
        </article>
    <?php }
    if (sizeof($data['items']) === 0) { ?>
        <p class="empty">You have no items to checkout!</p>
    <?php } else { ?>
        <form action="<?= URLROOT ?>/cart/checkout" method="post">
            <?php getCSRFInput(); ?>
            <button type="submit" class="checkout">CHECKOUT ALL</button>
        </form>
    <?php } ?>

</body>
<?php
getScript('navbar.js');
?>