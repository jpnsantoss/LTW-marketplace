<h1>Items</h1>

<!-- create item -->

<form action="<?= URLROOT; ?>/item/create" method="post">
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
    <button type="submit">Add Item</button>
</form>

<!-- list items -->

<ul>
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

<h1>Categories</h1>
<!-- create category -->
<form action="<?= URLROOT; ?>/category/create" method="post">
    <label for="name">Category Name</label>
    <input type="text" name="name" id="name">
    <button type="submit">Add Category</button>
</form>

<!-- list categories -->

<ul>
    <?php foreach ($data["categories"] as $category) : ?>
        <li>
            <?= $category->name; ?> &emsp;

            <form action="<?= URLROOT; ?>/category/<?= $category->id; ?>/delete" method="post">
                <input type="submit" value="Delete">
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<h1>Sizes</h1>

<!-- create size -->
<form action="<?= URLROOT; ?>/size/create" method="post">
    <label for="name">Size Name</label>
    <input type="text" name="name" id="name">
    <button type="submit">Add Size</button>
</form>

<!-- list sizes -->
<ul>
    <?php foreach ($data["sizes"] as $size) : ?>
        <li>
            <?= $size->name; ?> &emsp;

            <form action="<?= URLROOT; ?>/size/<?= $size->id; ?>/delete" method="post">
                <input type="submit" value="Delete">
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<h1>Conditions</h1>

<!-- create condition -->
<form action="<?= URLROOT; ?>/condition/create" method="post">
    <label for="name">Condition Name</label>
    <input type="text" name="name" id="name">
    <button type="submit">Add Condition</button>
</form>

<!-- list conditions -->

<ul>
    <?php foreach ($data["conditions"] as $condition) : ?>
        <li>
            <?= $condition->name; ?> &emsp;

            <form action="<?= URLROOT; ?>/condition/<?= $condition->id; ?>/delete" method="post">
                <input type="submit" value="Delete">
            </form>
        </li>
    <?php endforeach; ?>
</ul>