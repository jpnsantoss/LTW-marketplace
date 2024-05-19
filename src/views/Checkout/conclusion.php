<?php 
require_once APPROOT . '/src/views/Common/common.php'; 
getHead(array('/css/style.css', '/css/navbar.css', '/css/form.css', '/css/itemlist.css'), "Checkout"); 
?>

<body>
    <?php getNavbar(); ?>
    <h1>You checked out your items successfully!</h1>
    <h3>Total spent: </h3>
    <h3>Items purchased: </h3>
    <h3>Total spent: €</h3>
    <p>You will soon receive shipping forms of your products from the respective seller. If you don't receive a shipping form, please contact your seller. If they do not answer in a workday, please contact an Admin.</p>
    <?php getScript('navbar.js'); ?>
</body>
</html>
