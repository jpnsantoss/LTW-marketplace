<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', '/css/navbar.css'), "Product Details"); 
    getNavbar();
?>

<body>
<ul class="listing">
    <?php foreach ($data["items"] as $item) : ?>
        <li>
            <?= $item->name; ?> &emsp;
            <?= $item->price; ?> &emsp;
            <?= $item->category_name; ?> &emsp;
            <?= $item->size_name; ?> &emsp;
            <?= $item->condition_name; ?> &emsp;

            <form action="<?= URLROOT; ?>/item/<?= $item->id; ?>/delete" method="post">
                <input type="submit" value="Delete">
            </form>
        </li>
    <?php endforeach; ?>
</ul>
</body>