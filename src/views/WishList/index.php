<?php 
require_once APPROOT . '/src/views/Common/common.php'; 
getHead(array('/css/style.css', '/css/navbar.css', '/css/itemlist.css'), "Wish List"); 
getNavbar();
?>

<body>
    <h1>My Wish List</h1>
    <?php foreach ($data['items'] as $wishedItem){ 
        
        $imageData = $wishedItem->url;

        $encodedImageData = base64_encode($imageData);
        
    ?>
        <article class="wanted-item">
            
            <p><?= $wishedItem->brand ?></p>
            <p><?= $wishedItem->price ?></p>
            <p><?= $wishedItem->added_at ?></p>
            <img src="<?= $wishedItem->image_urls[0] ?>" alt="Image">
            <button class="remove-from-wishlist" data-id="<?= $wishedItem->id?>">Remove</button>
            <button class="add-to-cart" data-id="<?= $wishedItem->id?>">Add to Cart</button>

        <article>
    <?php }?>
</body>

