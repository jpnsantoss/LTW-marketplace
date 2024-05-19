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

function getCSRFInput()
{
    echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
}

function getNavbar()
{
    getCSRF();
?>
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
                    <li><a href="/inbox"><i class="icon">chat_bubble</i> Messages</a></li>
                    <li><a href="/wishlist"><i class="icon">favorite</i> Wishlist</a></li>

                    <li class="dropdown">
                        <a href="#"><i class="icon">person</i> Account</a>
                        <ul>
                            <?php if (isAdmin()) : ?>
                                <li><a href="/admin">Admin</a></li>
                            <?php endif; ?>
                            <li><a href="/profile">Profile</a></li>

                            <li><a href="#" id="logout">Logout</a></li>
                        </ul>
                    </li>


                    <?php if (isSeller()) : ?>
                        <li><a href="/create" class="highlight">Post Items</a></li>
                    <?php elseif (hasRequested()) : ?>
                        <li><a class="highlight">Request Sent</a></li>
                    <?php else : ?>
                        <li>
                            <form class="highlight" action="<?= URLROOT ?>/auth/request" method="post">
                                <?php getCSRFInput(); ?>
                                <button type="submit" class="requestButton">Request Seller Privileges</button>
                            </form>
                        </li>
                    <?php endif; ?>
                    <li><a href="/cart" class="highlight">Cart</a></li>

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