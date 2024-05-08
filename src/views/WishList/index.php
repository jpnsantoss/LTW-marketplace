<?php 
require_once APPROOT . '/src/views/Common/common.php'; 
getHead(array('/css/style.css', '/css/navbar.css', '/css/itemlist.css'), "Wish List"); 
getNavbar();
?>

<body>
    <h1>My Wishlist</h1>

    <?php foreach ($data['items'] as $wishedItem) { ?>
        <article>
            <div class="desc">
                <p><b>Model: </b><?= $wishedItem->model ?></p>
                <p><b>Brand: </b><?= $wishedItem->brand ?></p>
                <p><b>Price: </b><?= $wishedItem->price ?>€</p>
                <p><b>Sold by: </b><?= $wishedItem->username ?></p>
            </div>
            <img src="<?= $wishedItem->url ?>" alt="Image">
            <button class="remove" data-id="<?= $wishedItem->id?>">Remove</button>
            <form action="<?= URLROOT ?>/cart/<?= $wishedItem->id; ?>/add-to-cart" method="get">
                <button type="submit" class="progress">Add to Cart</button>
            </form>
        </article>
    <?php }?>
</body>

