<?php require_once APPROOT . '/src/views/Layout/header.php'; ?>
<main class="container auth-container">
    <h1>Welcome to LTW Marketplace</h1>
    <h2>Create account to get started</h2>
    <form class="auth-form" method="post" action="<?= URLROOT; ?>/auth/register">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Username">

        <label for="name">Full Name</label>
        <input id="name" name="name" type="text" placeholder="Full Name">

        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="Email">

        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Password">

        <button class="primary" type="submit">Create Account</button>
    </form>
    <p>Already have an account? <a href="<?= URLROOT; ?>/login">Sign in</a></p>
</main>
<?php require_once APPROOT . '/src/views/Layout/footer.php'; ?>