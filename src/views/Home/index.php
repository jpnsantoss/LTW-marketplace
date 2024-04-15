<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css'), "Home");
getNavbar();
?>
<p>Home</p>
<form action="<?php echo URLROOT; ?>/auth/logout" method="post">
    <input type="submit" value="Logout">
</form>

<?php
getScript('navbar.js');
?>