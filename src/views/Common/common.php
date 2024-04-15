<?php function getHead($styles, $title)
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php foreach ($styles as $style) { ?>
            <link rel="stylesheet" href="<?= $style ?>">
        <?php } ?>
        <title><?= $title ?></title>
    </head>
<?php }

function getNavbar()
{ ?>
    <header>
        <nav>
            <div class="nav-mobile">
                <ul>
                    <li><a href="/">LTW Marketplace</a></li>
                </ul>
                <button id="menu-button"><i class="icon">menu</i></button>
            </div>
            <div id="menu-links">
                <ul>
                    <li><a href="#"><i class="icon">chat_bubble</i> Messages</a></li>
                    <li><a href="#"><i class="icon">favorite</i> Wishlist</a></li>
                    <li><a href="#"><i class="icon">person</i> Account</a></li>
                    <li><a href="#" class="highlight">Post Items</a></li>
                </ul>
            </div>
        </nav>
    </header>
<?php }

function getScript($script)
{ ?>
    <script src="<?= URLROOT ?>/js/<?= $script ?>"></script>
<?php }
?>