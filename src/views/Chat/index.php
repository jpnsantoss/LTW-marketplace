<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css', '/css/chat.css'), "Home");
getCSRF();
?>

<body>
    <?php getNavbar(); ?>
    <div class="chat-container">
        <div class="chat-box">
            <h2>Chat about <?= $data['chat']->brand . ' ' . $data['chat']->model ?> with <?= ($data['chat']->seller_id == $_SESSION['user']['id']) ? $data['chat']->buyer_username : $data['chat']->seller_username ?></h2>
            <div class="chat-messages">
                <?php foreach ($data['messages'] as $message) : ?>
                    <div class="chat-message <?= ($message->sender_id == $_SESSION['user']['id']) ? 'right' : 'left' ?>">
                        <p><strong><?= ($message->sender_id == $_SESSION['user']['id']) ? 'You' : ($data['chat']->seller_id == $_SESSION['user']['id'] ? $data['chat']->buyer_username : $data['chat']->seller_username) ?></strong>: <?= $message->content ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <form action="<?= URLROOT ?>/chat/send" method="POST">
                <?php getCSRFInput(); ?>
                <input type="hidden" name="chat_id" value="<?= $data['chat']->id ?>">
                <input type="text" name="content" placeholder="Type a message...">
                <button type="submit">Send</button>
            </form>
        </div>
</body>

<?php
getScript('navbar.js');
?>

</html>