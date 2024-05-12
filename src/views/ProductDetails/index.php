<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/details.css'), "Product Details");
getNavbar();
?>

<body>
    <div class="item-container">
        <div class="item-image">
            <img id="item-image" src="<?= $data["item"]->image_urls[0] ?>" alt="Item image">
            <?php if ($data["item"]->image_urls > 1) : ?>
                <button id="previous-button">&#10094;</button>
                <button id="next-button">&#10095;</button>
            <?php endif; ?>

        </div>
        <div class="info">
            <div class="item-details">
                <div class="main-info">
                    <p><?= $data["item"]->brand; ?></p>
                    <h2><?= $data["item"]->model; ?></h2>
                    <h3> <?= $data["item"]->price; ?> € <span>VAT incl.</span></h3>
                </div>
                <div class="additional-info">
                    <li>Category: <?= $data["item"]->category_name; ?></li>
                    <li>Size: <?= $data["item"]->size_name; ?></li>
                    <li>Condition: <?= $data["item"]->condition_name; ?></li>
                </div>
                <div class="item-buttons">
                <form action="<?= URLROOT ?>/WishList/<?= $data["item"]->id; ?>/add-to-wish-list" method="get">
                    <button type="submit" class="add-to-wishlist">Add to Wishlist</button>
                </form>
                <form action="<?= URLROOT ?>/cart/<?= $data["item"]->id; ?>/add-to-cart" method="get">
                    <button type="submit" class="add-to-cart">Add to Cart</button>
                </form>
                </div>
            </div>
            <div class="user-info">
                <h4>User: <?= $data["item"]->seller_name; ?></h4>

                <div class="item-buttons">
                    <a href="<?= URLROOT ?>/chat/index/<?= $data["item"]->id ?>" class="send-message">Send Message</a>
                </div>
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
