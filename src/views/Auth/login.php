<?php
require_once APPROOT . '/src/views/Common/common.php';
$styles = array('/css/style.css', '/css/auth.css');
getHead($styles, "Log In");
getCSRF();
?>

<body>
    <main class="container auth-container">
        <h1>Welcome back to LTW Marketplace!</h1>
        <h2>Sign into your account to get started</h2>
        <form class="auth-form" action="<?= URLROOT; ?>/auth/login" method="post">
            <?php getCSRFInput(); ?>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required placeholder="Enter your email">

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required placeholder="Enter your password">


            <button class="primary" type="submit">Log In</button>
        </form>
        <p>Don't have an account yet? <a href="<?= URLROOT; ?>/register">Sign up</a></p>
    </main>
</body>

</html>