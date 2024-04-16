<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/form.css'), "Home");
getNavbar(); 
?>

<body class="home">
    <h1>Items for sale:</h1>
    <ul class = "listing-column">
    <?php foreach ($data["items"] as $item) : ?>
                <li>
                    
                    <h3> <?= $item->model; ?> &emsp; </h3>
                    <p> <?= $item->brand; ?> &emsp; </p>
                    <p> <?= $item->price; ?> € &emsp; </p>

                  
                </li>
            <?php endforeach; ?>
    </ul>
    
    <form class="logout" action="<?php echo URLROOT; ?>/auth/logout" method="post">
    <button class="button" type="submit">Logout</button>        
    </form>
   
</body>

<?php
getScript('navbar.js');
?>

</html>