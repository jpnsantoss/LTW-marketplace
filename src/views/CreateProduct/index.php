<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/form.css', '/css/navbar.css'), "Add Item Category");
getNavbar();
?>

<body class="forms">
    <section>
    <h1>Sell Item:</h1>
        <form action="<?= URLROOT; ?>/item/create" method="post" enctype="multipart/form-data">
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
            <label for="images">Images</label>
            <input type="file" name="images[]" id="images" multiple>
            <br>
            <br>
            <button class="button" type="submit">Add Item</button>
        </form>
    </section>
</body>  

<?php
getScript('navbar.js');
?>