<?php require_once APPROOT . '/src/views/Layout/header.php'; ?>
<?php require_once APPROOT . '/src/views/Layout/navbar.php'; ?>
<p>Home</p>
<form action="<?php echo URLROOT; ?>/auth/logout" method="post">
    <input type="submit" value="Logout">
</form>
<?php require_once APPROOT . '/src/views/Layout/footer.php'; ?>