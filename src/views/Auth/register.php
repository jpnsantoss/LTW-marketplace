<?php require_once APPROOT . '/src/views/Layout/header.php'; ?>
<main class="container auth-container">
    <h1>Welcome to LTW Marketplace</h1>
    <h2>Create account to get started</h2>
    <form class="auth-form">
        <label for="name">Username</label>
        <input id="username" type="text" placeholder="Username">

        <label for="mobile">Full Name</label>
        <input id="name" type="text" placeholder="Full Name">

        <label for="mobile">Email</label>
        <input id="name" type="email" placeholder="Email">

        <label for="mobile">Password</label>
        <input id="name" type="password" placeholder="Password">

        <button class="primary" type="submit">Create Account</button>
    </form>
    <p>Already have an account? <a href="<?= URLROOT; ?>/login">Sign in</a></p>
</main>
<?php require_once APPROOT . '/src/views/Layout/footer.php'; ?>