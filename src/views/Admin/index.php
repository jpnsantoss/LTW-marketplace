<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', 'css/form.css'), "Add Item Category"); 
    getNavbar();
?>


<!-- create item -->
<body>
    <section>
        <h1>Sell Item:</h1>
        <form action="<?= URLROOT; ?>/item/create" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand">
            <label for="model">Model</label>
            <input type="text" name="model" id="model">
            <label for="price">Price</label>
            <input type="number" name="price" id="price">
            <label for="category">Category</label>
            <select name="category" id="category">
                <?php foreach ($data["categories"] as $category) : ?>
                    <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="size">Size</label>
            <select name="size" id="size">
                <?php foreach ($data["sizes"] as $size) : ?>
                    <option value="<?= $size->id; ?>"><?= $size->name; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="condition">Condition</label>
            <select name="condition" id="condition">
                <?php foreach ($data["conditions"] as $condition) : ?>
                    <option value="<?= $condition->id; ?>"><?= $condition->name; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" enctype="multipart/form-data">>
            <br>
            <br>
            <button type="submit">Add Item</button>
        </form>
        <?php if(isAdmin()) : ?>
    <!-- list items -->
        <h1>Items for sale:</h1>            
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
    <?php endif; ?>
</body>