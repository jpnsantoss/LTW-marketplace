<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css'), "Home");
?>

<body>
    <?php getNavbar(); ?>
    <p>Home</p>
    <form action="<?php echo URLROOT; ?>/auth/logout" method="post">
        <input type="submit" value="Logout">
    </form>

</body>

<?php
getScript('navbar.js');
?>

</html>