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