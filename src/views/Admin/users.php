<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', '/css/table.css', '/css/navbar.css'), "Users");
    getNavbar();
?>
<body>
    <h1>Users</h1>
    <table>
    <tr>
        <th>User Id</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Password Hash</th>
        <th>Seller privileges</th>
        <th>Account Created</th>
        <th></th>
    </tr>
        <?php foreach ($data['users'] as $user){
            $user = (array) $user;
            $isSeller = isset($user['user_id']) ? 'Yes' : 'No';
            $hasRequested
            ?>
            <tr>
                <td><?=$user['id']?></td>
                <td><?=$user['username']?></td>
                <td><?=$user['full_name']?></td>
                <td><?=$user['email']?></td>
                <td><?=$user['hashed_password']?></td>
                <td><?=$isSeller?></td>
                <td><?=$user['created_at']?></td>
                <?php if ($isSeller == 'No') { ?>
                    <td class ="button">
                        <form action="<?= URLROOT ?>/admin/<?=$user['id']?>/promote-user-to-seller" method="get">
                            <button type="submit" class="promote-button">Accept Seller Request</button>
                        </form>
                    </td>
                <?php } else { ?>
                    <td class="button">
                        <form action="<?= URLROOT ?>/Admin/<?=$user['id']?>/userItems" method="get">
                            <button type="submit" class="promote-button">See Items</button>
                        </form>                    
                    </td> 
                <?php } ?>
        
            </tr>
        <?php } ?>
    </table> 
    <?php getScript('promote.js'); ?>
    
</body>
<?php
getScript('navbar.js');
?>
