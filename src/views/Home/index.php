<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css'), "Home");
$user_id = $_SESSION['user']['id'];?>

<body>
    <header>
        <nav>
            <div class="nav-mobile">
                <ul>
                    <li><a href="/">LTW Marketplace</a></li>
                </ul>
                <button id="menu-button"><i class="icon">menu</i></button>
            </div>
            <div id="menu-links">
                <ul>
                    <li><a href="/#"><i class="icon">chat_bubble</i> Messages</a></li>
                    <li><a href="/wishlist"><i class="icon">favorite</i> Wishlist</a></li>

                    <li class="dropdown">
                        <a href="#"><i class="icon">person</i> Account</a>
                        <ul>
                            <?php if (isAdmin()) : ?>
                                <li><a href="/admin">Admin</a></li>
                            <?php endif; ?>
                            <li><a href="/profile">Profile</a></li>
            
                            <li><a href="#" id="logout">Logout</a></li>
                        </ul>
                    </li>

                    <?php if (isSeller()) { ?>
                        <li><a href="/create" class="highlight">Post Items</a></li>
                    <?php }else if(hasRequested()) {?>
                        <li><a id="awaitingConfirm" class="highlight">Awaiting Admin Confirmation</a></li>
                    <?php } else { ?>
                        <li id="requestLi">
                            <form id="sellerRequestForm" class="highlight" action="<?= URLROOT ?>/admin/<?= $_SESSION['user']['id'] ?>/request-to-be-seller" method="get">
                                <button type="submit" class="requestButton">Request Seller Privileges</button>
                            </form>
                        </li>
                    <?php } ?>
                    <li><a href="/cart" class="highlight">Cart</a></li>

                </ul>
            </div>
        </nav>
    </header> 
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
                    <?php foreach ($data["items"] as $item) : 
                        if($item->sold_at === NULL) {?>
                        
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
                    <?php } endforeach; ?>
                <?php endif; ?>
            </div>

        </section>
    </main>
</body>
<script>
    document.querySelector('form:not(#sellerRequestForm)').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const params = Array.from(new FormData(form), ([key, value]) =>
            value === '' || (form[key].tagName === 'SELECT' && form[key].selectedIndex === 0) ? null : `${encodeURIComponent(key)}=${encodeURIComponent(value)}`
        ).filter(Boolean).join('&');

        const originalUrl = window.location.href.split('?')[0];

        window.location.href = params ? originalUrl + '?' + params : originalUrl;
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('sellerRequestForm').addEventListener('click', function(event) {
            event.preventDefault();
            // Replace the button with the awaiting confirm message
            var li = document.createElement('li');
            var a = document.createElement('a');
            a.setAttribute('href', '#'); // Set href attribute if needed
            a.classList.add('highlight'); // Add the 'no-hover' class
            a.innerText = 'Awaiting Admin Confirm';
            li.appendChild(a);
            var requestLi = document.getElementById('requestLi');
            requestLi.parentNode.replaceChild(li, requestLi);

            // Optionally, submit the form via AJAX to update the server
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?= URLROOT ?>/admin/<?= $_SESSION['user']['id'] ?>/request-to-be-seller', true);
            xhr.send();
        });
    });

</script>
<?php
    getScript('navbar.js');
?>

</html>