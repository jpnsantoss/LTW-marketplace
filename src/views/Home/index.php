<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css'), "Home");
?>

<body>
    <?php getNavbar(); ?>
    <main>
        <section class="search">
            <form action="">
                <div class="search-main">
                    <input type="text" name="search" id="search" placeholder="What are you looking for?">
                    <select name="category" id="category">
                        <option value="">All Categories</option>
                        <?php foreach ($data["categories"] as $category) : ?>
                            <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" value="Search" id="search-button">
                </div>
                <div class="search-filters">
                    <label for="size">Size
                        <select name="size" id="size">
                            <option value="">All Sizes</option>
                            <?php foreach ($data["sizes"] as $size) : ?>
                                <option value="<?= $size->id; ?>"><?= $size->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label for="min-price">Price
                        <div class="price-input">
                            <input type="number" name="min-price" id="min-price" placeholder="From">
                            <input type="number" name="max-price" id="max-price" placeholder="To">
                        </div>
                    </label>

                    <label for="condition">Condition
                        <select name="condition" id="condition">
                            <option value="">All Conditions</option>
                            <?php foreach ($data["conditions"] as $condition) : ?>
                                <option value="<?= $condition->id; ?>"><?= $condition->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </form>
        </section>

        <section class="home-items">
            <h2>Items for sale:</h2>
            <div class="listing-items">
                <?php foreach ($data["items"] as $item) : ?>
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
                                <div>
                                    <button><i class="icon">favorite</i></button>
                                    <button><i class="icon">shopping_cart</i> Add to cart</button>
                                </div>
                            </div>


                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </section>
    </main>
</body>

<?php
getScript('navbar.js');
?>

</html>