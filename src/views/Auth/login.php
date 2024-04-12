<?php require_once APPROOT . '/src/views/Layout/header.php'; ?>
<main class="container auth-container">
    <h1>Welcome back to LTW Marketplace</h1>
    <h2>Sign into your account to get started</h2>
    <form class="auth-form" action="<?= URLROOT; ?>/auth/login" method="post">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="Email">

        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Password">

        <button class="primary" type="submit">Login</button>
    </form>
    <p>Don't have an account yet? <a href="<?= URLROOT; ?>/register">Sign up</a></p>
</main>
<?php require_once APPROOT . '/src/views/Layout/footer.php'; ?>