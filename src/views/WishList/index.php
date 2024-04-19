<?php 
require_once APPROOT . '/src/views/Common/common.php'; 
getHead(array('/css/style.css', ), "Wish List"); 
getNavbar();
?>

<body>
    <h1>My Wish List</h1>
    <?php foreach ($data as $wishedItem){ ?>
        <p><?= $wishedItem->brand; ?></p>
        <p><?= $wishedItem->model; ?></p>
        <p><?= $wishedItem->price; ?></p>
        <p><?= $wishedItem->added_at; ?></p>
    <?php }?>


