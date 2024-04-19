<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', '/css/navbar.css', '/css/details.css'), "Product Details"); 
    getNavbar();
?>

<body>
<div class="item-container">
    <div class="item-image">
        <img id="item-image" src="<?= $data["item"]->image_urls[0] ?>" alt="Item image">
        <button id="previous-button">&#10094;</button>
        <button id="next-button" >&#10095;</button>

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


    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const images = <?= json_encode($data["item"]->image_urls) ?>;
    const imgElement = document.getElementById("item-image");
    const nextButton = document.getElementById("next-button");
    const previousButton = document.getElementById("previous-button");
    let currentIndex = 0;

    function showNextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        imgElement.src = images[currentIndex];
    }

    function showPreviousImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        imgElement.src = images[currentIndex];
    }

    nextButton.addEventListener("click", showNextImage);
    previousButton.addEventListener("click", showPreviousImage);
});


    </script>

</body>