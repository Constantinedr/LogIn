<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/LogIn.css') ?>">
</head>
<body>
    <div class="admin-button-container">
        <button id="toggle-admin-form" class="admin-button">For ADMIN</button>
    </div>
    <h2 class="page-main-title">LOGIN INTO YOUR ACCOUNT</h2>
    <div class="login-wrapper" id="customer-login">
        <h3 class="login-title">CUSTOMER</h3>
        <form method="post" action="<?php echo site_url('auth/login_user'); ?>">
            <div class="login-form-group">
                <label for="customer-email" class="login-label">Email</label>
                <input type="email" name="email" id="customer-email" class="login-input" required>
            </div>
            <div class="login-form-group">
                <label for="customer-password" class="login-label">Password</label>
                <input type="password" name="password" id="customer-password" class="login-input" required>
            </div>
            <div class="login-button-container">
                <button type="submit" class="login-button">OK</button>
            </div>
        </form>
        <div class="login-links">
            <a href="<?php echo site_url('auth/LostPass'); ?>">Lost My Password</a>
            <a href="<?php echo site_url('auth/registry'); ?>">New Account</a>
        </div>
    </div>
    <div class="login-wrapper" id="admin-login" style="display: none;">
        <h3 class="login-title">ADMIN</h3>
        <form method="post" action="<?php echo site_url('auth/login_admin'); ?>">
            <div class="login-form-group">
                <label for="admin-email" class="login-label">Email</label>
                <input type="email" name="email" id="admin-email" class="login-input" required>
            </div>
            <div class="login-form-group">
                <label for="admin-password" class="login-label">Password</label>
                <input type="password" name="password" id="admin-password" class="login-input" required>
            </div>
            <div class="login-button-container">
                <button type="submit" class="login-button">OK</button>
            </div>
        </form>
        <div class="login-links">
            <a href="<?php echo site_url('auth/LostPass'); ?>">Lost My Password</a>
        </div>
    </div>
    <script>
        document.getElementById('toggle-admin-form').addEventListener('click', function(e) {
            e.preventDefault();
            const customerForm = document.getElementById('customer-login');
            const adminForm = document.getElementById('admin-login');
            if (customerForm.style.display === 'none') {
                customerForm.style.display = 'block';
                adminForm.style.display = 'none';
                this.textContent = 'For ADMIN';
            } else {
                customerForm.style.display = 'none';
                adminForm.style.display = 'block';
                this.textContent = 'For CUSTOMER';
            }
        });
    </script>
</body>
</html>