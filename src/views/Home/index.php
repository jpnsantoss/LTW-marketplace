<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css'), "Home");
getNavbar(); 
?>

<body class="home">
    <h1>Items for sale:</h1>
    <ul class = "listing-column">
    <?php foreach ($data["items"] as $item) : ?>
                <li>
                <button class="item-button" data-item-id="<?= $item->id; ?>">
                    <h3> <?= $item->model; ?> &emsp; </h3>
                    <p> <?= $item->brand; ?> &emsp; </p>
                    <p> <?= $item->price; ?> € &emsp; </p>

                    </button>
                </li>
            <?php endforeach; ?>
    </ul>
    
    <form class="logout" action="<?php echo URLROOT; ?>/auth/logout" method="post">
    <button class="button" type="submit">Logout</button>        
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.item-button').click(function() {
                var itemId = $(this).data('item-id');
                window.location.href = "<?php echo URLROOT; ?>/details";
            });
        });
    </script>
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
            <h1>Items for sale:</h1>
            <ul class="listing-items">
                <?php foreach ($data["items"] as $item) : ?>
                    <li>
                        <button class="item-button" data-item-id="<?= $item->id; ?>"onclick="redirectToDetails(<?= $item->id; ?>)">
                            
                        <img src="<?= $item->image_urls[0] ?>" alt="Item image" id="item-image">
                        <div class="item-info">
                            <h4> <?= $item->category_name; ?> &emsp; </h4>
                            <h2> <?= $item->model; ?> &emsp; </h2>
                            <p> <?= $item->brand; ?> &emsp; </p>
                            <h3> <?= $item->price; ?> € &emsp; </h3>
                            
                </div> 
                        </button>
                        <script>
    function redirectToDetails(itemId) {
        // Redireciona para a rota details com o ID do item
        window.location.href = '/home/details/' + itemId;
    }
</script>
                    </li>
                <?php endforeach; ?>
            </ul>
            
        </section>
    </main>
</body>

<?php
getScript('navbar.js');
?>

</html>
