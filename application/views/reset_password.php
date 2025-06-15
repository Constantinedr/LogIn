<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/LostPass.css') ?>">
</head>
<body class="bg-light">
<div class="lost-pass-container">
    <h2 class="lost-pass-title">Reset Your Password</h2>
    <form method="post" action="<?= site_url('Auth/update_password') ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
        <div class="login-form-group">
            <label for="password" class="login-label">New Password</label>
            <input type="password" name="password" id="password" class="login-input" required>
        </div>
        <div class="login-button-container">
            <button type="submit" class="login-button">Update Password</button>
            
        </div>
    </form>
</div>
</body>
</html>
