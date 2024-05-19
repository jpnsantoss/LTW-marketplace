<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css'), "Home");
$user_id = $_SESSION['user']['id'];
$user = $_SESSION['user'];?>

<body>
    <?php getNavbar(); ?>
    <main>
        <section class="search">
            <form class="search-items" action="<?= URLROOT ?>/home/index" method="get">
                <div class="search-main">
                    <input type="text" name="search" id="search" placeholder="What are you looking for?" value="<?= $_GET['search'] ?? '' ?>">
                    <select name="category_id" id="category">
                        <option value="">All Categories</option>
                        <?php foreach ($data["categories"] as $category) : ?>
                            <option value="<?= $category->id; ?>" <?= isset($_GET['category_id']) && $_GET['category_id'] == $category->id ? 'selected' : '' ?>><?= $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" value="Search" id="search-button">

                    
                </div>
                <div class="search-filters">
                    <label for="size">Size
                        <select name="size_id" id="size">
                            <option value="">All Sizes</option>
                            <?php foreach ($data["sizes"] as $size) : ?>
                                <option value="<?= $size->id; ?>" <?= isset($_GET['size_id']) && $_GET['size_id'] == $size->id ? 'selected' : '' ?>><?= $size->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label for="min-price">Price
                        <div class="price-input">
                            <input type="number" name="price_from" id="min-price" placeholder="From" value="<?= $_GET['price_from'] ?? '' ?>">
                            <input type="number" name="price_to" id="max-price" placeholder="To" value="<?= $_GET['price_to'] ?? '' ?>">
                        </div>
                    </label>

                    <label for="condition">Condition
                        <select name="condition_id" id="condition">
                            <option value="">All Conditions</option>
                            <?php foreach ($data["conditions"] as $condition) : ?>
                                <option value="<?= $condition->id; ?>" <?= isset($_GET['condition_id']) && $_GET['condition_id'] == $condition->id ? 'selected' : '' ?>><?= $condition->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                
            </form>
            <form class="userPreferences" action="<?= URLROOT ?>/home/index/" method="get">
                <input type="hidden" name="active" value="true">
                <button type="submit" class="requestButton filterButton">Filter by user preferences</button>
            </form>
        </section>

        <section class="home-items">
            <h2>Items for sale:</h2>
            <div class="listing-items">
                <?php if (empty($data["items"])) : ?>
                    <p>No items found.</p>
                <?php else : ?>
                    <?php foreach ($data["items"] as $item) :
                        if ($item->sold_at === NULL) { ?>

                            <article class="item-card">
                                <a href="/home/details/<?= $item->id ?>">
                                    <img src="<?= $item->image_urls[0] ?>" alt="Item image" id="item-image">
                                </a>

                                <div class="item-info">
                                    <div>
                                        <div class="item-header">
                                            <p> <?= $item->brand; ?></p>
                                            <span class="category"> <?= $item->category_name; ?></span>
                                        </div>

                                        <a href="/home/details/<?= $item->id ?>">
                                            <?= $item->model; ?>
                                        </a>

                                    </div>
                                    <div class="item-footer">
                                        <h3><?= $item->price; ?> €</h3>
                                        <div class="buttons">
                                            <form action="<?= URLROOT ?>/WishList/<?= $item->id ?>/add-to-wish-list" method="get">
                                                <button type="submit"><i class="icon">favorite</i></button>
                                            </form>
                                            <form action="<?= URLROOT ?>/cart/<?= $item->id ?>/add-to-cart" method="get">
                                                <button type="submit"><i class="icon">shopping_cart</i> Add to cart</button>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </article>
                    <?php }
                    endforeach; ?>
                <?php endif; ?>
            </div>

        </section>
    </main>
    <?php getScript('filter.js');?>
    <?php getScript('navbar.js');?>
</body>

</html>