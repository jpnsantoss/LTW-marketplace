<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', '/css/navbar.css'), "Profile"); 
    getNavbar();
?>

<?php session_start(); ?>

<?php if (!isLoggedIn()) {
    // Redirecionar para a página de login, por exemplo:
    header("Location: login.php");
    exit;
} 

$user = $_SESSION['user'];
?>

<body>
    <h1>Welcome, <?php echo $user['username']; ?>!</h1>
    <h2> Current info </h2>
    <p>Email: <?php echo $user['email']; ?></p>
    
    <p>Full name: <?php echo $user['full_name']; ?></p>
    <p>Date: <?php echo $user['created_at']; ?></p>
    <!-- Outras informações do perfil podem ser exibidas aqui -->

    <h2>Edit Profile:</h2>

    <form action="<?= URLROOT; ?>/auth/changeemail" method="post">
        <label for="email">New email: </label>
        <input type="text" name="email" id="email">
    <button class="button" type="submit">Submit</button>
    </form>

    <form action="<?= URLROOT; ?>/auth/changeusername" method="post">
        <label for="username">New username: </label>
        <input type="text" name="username" id="username">
    <button class="button" type="submit">Submit</button>
    </form>

    <form action="<?= URLROOT; ?>/auth/changefullname" method="post">
        <label for="username">New name: </label>
        <input type="text" name="fullname" id="fullname">
    <button class="button" type="submit">Submit</button>
    </form>


    <h2>Change Password</h2>
    <form action="<?= URLROOT; ?>/auth/changepassword" method="post">
        <label for="current_password">Current password: </label>
        <input type="text" name="current_password" id="current_password">

        <label for="new_password">New password: </label>
        <input type="text" name="new_password" id="new_password">

        <label for="confirm_password">Confirm password: </label>
        <input type="text" name="confirm_password" id="confirm_password">
    <button class="button" type="submit">Submit</button>
    </form>

    <a href="#" id="logout">Logout</a>
</body>

<?php
getScript('navbar.js');
?>