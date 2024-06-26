<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css', '/css/inbox.css'), "Home");
?>

<body>
    <?php getNavbar(); ?>
    <div class="chat-inbox">
        <div class="sellers">
            <h2>A comprar:</h2>
            <?php foreach ($data['buying'] as $chat) : ?>
                <div class="product">
                    <h3><?= htmlspecialchars($chat->brand . ' ' . $chat->model) ?>:</h3>
                    <div class="users">
                        <p><?= htmlspecialchars($chat->seller_username) ?>: <a href="/chat/index/<?= $chat->id ?>">Open chat</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="buyers">
            <h2>A anunciar:</h2>
            <?php foreach ($data['selling'] as $chat) : ?>
                <div class="product">
                    <h3><?= htmlspecialchars($chat->brand . ' ' . $chat->model) ?>:</h3>
                    <div class="users">
                        <p><?= htmlspecialchars($chat->buyer_username) ?>: <a href="/chat/index/<?= $chat->id ?>">Open chat</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php getScript('navbar.js');?>
</body>
</html>