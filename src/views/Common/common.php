<?php function getHead($styles, $title){?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php foreach($styles as $style){ ?>
        <link rel="stylesheet" href="<?=$style?>">
        <?php } ?>
        <title><?=$title?></title>
    </head>
<?php }

function getNavbar(){ ?>
    <header>
    <nav class="navbar">
        <ul class="nav">
            <li><a href="#home">LTW Marketplace</a></li>
        </ul>
        <button class="icon-button dropdown"><i class="icon">menu</i></button>
        <div class="nav-collapse">
            <ul class="nav nav-right">
                <li><a href="#"><i class="icon left">chat_bubble</i></a></li>
                <li><a href="#"><i class="icon left">favorite</i></a></li>
                <li><a href="#"><i class="icon left">person</i></a></li>
                <li><a href="#">John Smith</a></li>
                <li><a href="#" class="highlight">Vender</a></li>
            </ul>
        </div>
    </nav>
</header>
<?php }

function getScript($script){?>
    <script src="<?= URLROOT ?>/js/<?=$script?>"></script>
<?php } 
?>
