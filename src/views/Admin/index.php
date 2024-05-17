<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/form.css', '/css/navbar.css'), "Add Item Category");
getNavbar();
?>

<!-- create item -->

<body class="forms">
    <section>
        <!-- list items -->
        <h1>Items for sale:</h1>
        <ul class="listing">
            <?php foreach ($data["items"] as $item) : ?>
                <?php if ($item->sold_at === NULL) : ?>
                    <li>
                        <?= $item->brand; ?> &emsp;
                        <?= $item->model; ?> &emsp;
                        <?= $item->price; ?> € &emsp;
                        <?= $item->category_name; ?> &emsp;
                        <?= $item->size_name; ?> &emsp;
                        <?= $item->condition_name; ?> &emsp;


                        <form class="button" action="<?= URLROOT; ?>/item/<?= $item->id; ?>/delete" method="post">
                            <input type="submit" value="Delete">
                        </form>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </section>
    <section>
        <h1>Add new category:</h1>

        <!-- create category -->
        <form action="<?= URLROOT; ?>/category/create" method="post">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name">
            <button type="submit">Add Category</button>
        </form>
        <!-- list categories -->
        <h1>Categories:</h1>
        <ul class="listing">
            <?php foreach ($data["categories"] as $category) : ?>
                <li>
                    <?= $category->name; ?> &emsp;
                    <form action="<?= URLROOT; ?>/category/<?= $category->id; ?>/delete" method="post">
                        <input type="submit" value="Delete">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section>

        <h1>Add new size:</h1>

        <!-- create size -->
        <form action="<?= URLROOT; ?>/size/create" method="post">
            <label for="name">Size Name</label>
            <input type="text" name="name" id="name">
            <button type="submit">Add Size</button>
        </form>

        <!-- list sizes -->
        <h1>Sizes:</h1>
        <ul class="listing">
            <?php foreach ($data["sizes"] as $size) : ?>
                <li>
                    <?= $size->name; ?> &emsp;

                    <form action="<?= URLROOT; ?>/size/<?= $size->id; ?>/delete" method="post">
                        <input type="submit" value="Delete">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>

        <h1>Add new condition:</h1>

        <!-- create condition -->

        <form action="<?= URLROOT; ?>/condition/create" method="post">
            <label for="name">Condition Name</label>
            <input type="text" name="name" id="name">
            <button type="submit">Add Condition</button>
        </form>

        <!-- list conditions -->
        <h1>Conditions:</h1>
        <ul class="listing">
            <?php foreach ($data["conditions"] as $condition) : ?>
                <li>
                    <?= $condition->name; ?> &emsp;

                    <form action="<?= URLROOT; ?>/condition/<?= $condition->id; ?>/delete" method="post">
                        <input type="submit" value="Delete">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="users">
        <h1>Users:</h1>
        <a href="/admin/users">Manage Users</a>
    </section>
</body>

<?php
getScript('navbar.js');
?>