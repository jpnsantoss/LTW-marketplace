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