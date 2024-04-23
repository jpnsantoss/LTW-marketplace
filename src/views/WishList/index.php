<?php 
require_once APPROOT . '/src/views/Common/common.php'; 
getHead(array('/css/style.css'/*, '/css/itemlist.css'*/), "Wish List"); 
getNavbar();
?>

<body>
    <h1>My Wish List</h1>
    <?php foreach ($data['items'] as $wishedItem){ ?>
        <a href="<?= URLROOT ?>/home/details<?= $wishedItem['id']?>#">
            <div>
                <p><?= $wishedItem['brand']; ?></p>
                <p><?= $wishedItem['price']; ?></p>
                <p><?= $wishedItem['added_at']; ?></p>
                <button class="remove-from-wishlist" data-id="<?= $wishedItem['id']?>">Remove</button>
                <button class="add-to-cart" data-id="<?= $wishedItem['id']?>">Add to Cart</button>
            <div>
        </a>
    <?php }?>

</body>
<?php getScript('addtowishlist.js'); ?>
