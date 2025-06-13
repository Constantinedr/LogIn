<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post" action="<?php echo site_url('auth/login_user'); ?>">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>
        <div class="text-center mt-3">
        <a href="<?php echo site_url('auth/registry'); ?>">Register</a>
        </div>
    </div>
</div>
</body>
</html>
