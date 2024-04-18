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
                <button class="item-button" data-item-id="<?= $item->id; ?>">
                    <h3> <?= $item->model; ?> &emsp; </h3>
                    <p> <?= $item->brand; ?> &emsp; </p>
                    <p> <?= $item->price; ?> € &emsp; </p>

                    </button>
                </li>
            <?php endforeach; ?>
    </ul>
    
    <form class="logout" action="<?php echo URLROOT; ?>/auth/logout" method="post">
    <button class="button" type="submit">Logout</button>        
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.item-button').click(function() {
                var itemId = $(this).data('item-id');
                window.location.href = "<?php echo URLROOT; ?>/details";
            });
        });
    </script>
</body>

<?php
getScript('navbar.js');
?>

</html>