<?php require_once APPROOT . '/src/views/Layout/header.php'; ?>

<h1>Users</h1>

<form action="<?= URLROOT; ?>/user/add-user" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="username" placeholder="Username">
</form>

<ul>
    <?php foreach ($data as $user) : ?>
        <li>
            <?= $user->username ?>
        </li>
    <?php endforeach; ?>
</ul>

<?php require_once APPROOT . '/src/views/include/footer.php'; ?>