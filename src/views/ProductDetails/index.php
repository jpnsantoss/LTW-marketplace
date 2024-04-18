<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', '/css/navbar.css', '/css/details.css'), "Product Details"); 
    getNavbar();
?>

<body>
<div class="item-container">
    <div class="item-image">
        <img src="<?= $data["item"]->image_urls[0] ?>" alt="Item image">
    </div>
    <div class="item-details">
        <h2><?= $data["item"]->model; ?></h2>
        <p><?= $data["item"]->brand; ?><p>
        <h4>Price:</h4><h3> <?= $data["item"]->price; ?> €</h3>
        <div class="item-buttons">
            <button class="add-to-wishlist">Add to Wishlist</button>
            <button class="add-to-cart">Add to Cart</button>
        </div>
</div>
        <div class="additional-info">
        <h4>User: <?= $data["item"]->seller_name; ?></h4>
        <p>Category: <?= $data["item"]->category_name; ?></p>
        <p>Size: <?= $data["item"]->size_name; ?></p>
        <p>Condition: <?= $data["item"]->condition_name; ?></p>
        <div class="item-buttons">
        <button class="send-message">Send Message</button>
</div>
        </div>
</div>
</body>