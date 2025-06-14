<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Link to your custom CSS file -->
    <link rel="stylesheet" href="<?= base_url('assets/css/Dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/LogIn.css') ?>">
</head>
<body class="bg-light">
<div class="login-wrapper">
    <h2 class="login-title">Login Into Your Account</h2>
    <h3 class="login-subtitle">Customer</h3>
    <form method="post" action="<?php echo site_url('auth/login_user'); ?>">
        <div class="login-form-group">
            <label for="email" class="login-label">Email</label>
            <input type="email" name="email" id="email" class="login-input" required>
        </div>
        <div class="login-form-group">
            <label for="password" class="login-label">Pass</label>
            <input type="password" name="password" id="password" class="login-input" required>
        </div>
        <div class="login-button-container">
            <button type="submit" class="login-button">OK</button>
        </div>
    </form>
    <div class="login-links">
        <a href="#">Lost My Pass</a>
        <a href="<?php echo site_url('auth/registry'); ?>">New Account</a>
    </div>
</div>
</body>
</html>