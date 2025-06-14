<!DOCTYPE html>
<html>
<head>
    <title>Registry</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/Dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/registry.css') ?>">
</head>
<body class="bg-light">
<div class="login-wrapper">
    <h2 class="login-title">Regestry Page</h2>
    <form method="post" action="<?php echo site_url('auth/register_user'); ?>">
        <div class="login-form-group">
            <label for="first-name" class="login-label">Name</label>
            <input type="text" name="first_name" id="first-name" class="login-input" required>
        </div>
        <div class="login-form-group">
            <label for="last-name" class="login-label">Last Name</label>
            <input type="text" name="last_name" id="last-name" class="login-input" required>
        </div>
        <div class="login-form-group">
            <label for="email" class="login-label">Email</label>
            <input type="email" name="email" id="email" class="login-input" required>
        </div>
        <div class="login-form-group">
            <label for="password" class="login-label">Pass</label>
            <input type="password" name="password" id="password" class="login-input" required>
        </div>
        <div class="login-form-group">
            <label for="confirm-password" class="login-label">Retype Pass</label>
            <input type="password" name="confirm_password" id="confirm-password" class="login-input" required>
        </div>
        <div class="login-button-container">
            <button type="submit" class="login-button">Registry</button>
        </div>
        <div class="login-button-container">
            <a style="text-decoration:none" href="<?= site_url('auth/login'); ?>" class="login-button">Back to Login</a>
        </div>
    </form>
    </div>
</body>
</html>