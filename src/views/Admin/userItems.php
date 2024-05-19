<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/itemlist.css', '/css/navbar.css'), "Add Item Category");
$hasItems = false;
?>

<body>
<?php getNavbar(); 
foreach ($data['items'] as $item) { 
    $hasItems = true; ?>
        <article>
            <div class="desc">
                <p><b>Model: </b><?= $item->model ?></p>
                <p><b>Brand: </b><?= $item->brand ?></p>
                <p><b>Price: </b><?= $item->price ?>€</p>
                <p><b>Created at: </b><?= $item->created_at ?></p>
                <p><b>Status: </b>For sale</p>
            </div>
            <img src="<?= $item->url ?>" alt="Image">
        </article>
    <?php }?>
    <div class="desc">
        <?php if (!$hasItems) : ?>
            <h2>No items for sale yet</h2>
         <?php endif; ?>
    </div>
    <?php getScript('navbar.js'); ?>
</body>
</html>

