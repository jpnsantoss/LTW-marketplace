<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css'), "Home");
?>

<body>
    <?php getNavbar(); ?>
    <main>
        <section class="search">
            <form>
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
        </section>

        <section class="home-items">
            <h2>Items for sale:</h2>
            <div class="listing-items">
                <?php if (empty($data["items"])) : ?>
                    <p>No items found.</p>
                <?php else : ?>
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
                <?php endif; ?>
            </div>

        </section>
    </main>
</body>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const params = Array.from(new FormData(form), ([key, value]) =>
            value === '' || (form[key].tagName === 'SELECT' && form[key].selectedIndex === 0) ? null : `${encodeURIComponent(key)}=${encodeURIComponent(value)}`
        ).filter(Boolean).join('&');

        // Get the original URL of the page without any query parameters
        const originalUrl = window.location.href.split('?')[0];

        // Redirect to the URL with the query string only if params is not empty
        window.location.href = params ? originalUrl + '?' + params : originalUrl;
    });
</script>
<?php
getScript('navbar.js');
?>

</html>