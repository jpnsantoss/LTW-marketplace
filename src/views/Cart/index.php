<?php 
require_once APPROOT . '/src/views/Common/common.php'; 
getHead(array('/css/style.css'/*, '/css/itemlist.css'*/), "Wish List"); 
getNavbar();
?>

<body>
    <h1>My Cart</h1>
    <?php foreach ($data['items'] as $cartItem){ ?>
        <a href="<?= URLROOT ?>/home/details<?= $cartItem['id']?>#">
            <div class="item-container">
                <p><?= $cartItem['brand']; ?></p>
                <p><?= $cartItem['price']; ?></p>
                <p><?= $cartItem['added_at']; ?></p>
                <button class="remove" data-id="<?= $cartItem['id']?>">Remove</button>
            </div>
        </a>
    <?php }?>

</body>
