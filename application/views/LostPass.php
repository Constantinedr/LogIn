<!DOCTYPE html>
<html>
<head>
    <title>Lost Password</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/Dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/LostPass.css') ?>">
</head>
<body class="bg-light">
<div class="lost-pass-container">
    <h2 class="lost-pass-title">Lost Pass ?</h2>
    <p class="lost-pass-instruction">
        Entry here your email and we will send you a link to generate your pass again.
    </p>
    <form method="post" action="<?php echo site_url('Auth/send_reset_link'); ?>">
        <div class="login-form-group">
            <label for="email" class="login-label">Email</label>
            <input type="email" name="email" id="email" class="login-input" required>
        </div>
        <div class="login-button-container">
            <a  style="text-decoration:none" href="<?= site_url('auth/LogIn'); ?>" class="login-button">Back to logIn</a>
            <button type="submit" class="login-button">Remind Me</button>
            
        </div>
    </form>
</div>
</body>
</html>