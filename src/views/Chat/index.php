<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/home.css', '/css/chat.css'), "Home");
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
                <input type="hidden" name="chat_id" value="<?= $data['chat']->id ?>">
                <input type="text" name="content" placeholder="Type a message...">
                <button type="submit">Send</button>
            </form>
        </div>
    </div>

    <script>
       var lastTimestamp = '2024-01-01 00:00:00';

        function fetchNewMessages() {
            var chatId = <?= $data['chat']->id ?>;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?= URLROOT ?>/chat/getNewMessages/' + chatId + '?last_timestamp=' + encodeURIComponent(lastTimestamp), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    response.messages.forEach(function(message) {
                        var messageDiv = document.createElement('div');
                        messageDiv.className = 'chat-message ' + (message.sender_id == <?= $_SESSION['user']['id'] ?> ? 'right' : 'left');
                        messageDiv.innerHTML = '<p><strong>' + (message.sender_id == <?= $_SESSION['user']['id'] ?> ? 'You' : (<?= $data['chat']->seller_id ?> == <?= $_SESSION['user']['id'] ?> ? '<?= $data['chat']->buyer_username ?>' : '<?= $data['chat']->seller_username ?>')) + '</strong>: ' + message.content + '</p>';
                        document.querySelector('.chat-messages').appendChild(messageDiv);
                    });

                    if (response.messages.length > 0) {
                        lastTimestamp = response.latest_timestamp;
                    }
                }
            };
            xhr.send();
        }
        setInterval(fetchNewMessages, 1000);      
    </script>
<?php getScript('navbar.js'); ?>
</body>
</html>