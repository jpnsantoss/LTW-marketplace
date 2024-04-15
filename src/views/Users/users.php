<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css'), "Users");
?>
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
