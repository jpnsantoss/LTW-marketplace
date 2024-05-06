<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css', '/css/chat.css'), "Home");
?>

<body>
    <?php getNavbar(); ?>
    <div class="chat-container">
        <div class="chat-box">
            <h2>Chat about <?= $data['product']->brand . " " . $data['product']->model ?> with <?= $data['product']->seller_name ?></h2>
            <div class="chat-messages">
                <?php foreach ($data['messages'] as $message) : ?>
                    <div class="chat-message <?= ($message->buyer_id == $_SESSION['user']['id']) ? 'right' : 'left' ?>">
                        <p><strong><?= ($message->buyer_id == $_SESSION['user']['id']) ? $message->buyer_name : $message->seller_name ?></strong>: <?= $message->content ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <form action="<?= URLROOT ?>/chat/send" method="POST">
                <input type="hidden" name="product_id" value="<?= $data['product']->id ?>">
                <input type="text" name="message" placeholder="Type a message...">
                <button type="submit">Send</button>
            </form>
        </div>

</body>

<?php
getScript('navbar.js');
?>

</html>