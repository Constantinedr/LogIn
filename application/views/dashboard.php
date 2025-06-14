<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .special-button {
            position: relative;
            
            left: 0px;
            width: 200px;
            border: 1px solid #000;
            background-color: #f8f9fa;
            margin-top: 10px;
        }
        .btn, .form-control {
            border-radius: 0 !important;
        }
        .btn {
            text-align: center;
        }
        .custom-button {
            width: 350px;
            height: 50px;
        
            margin: 0 15px;
            font-size: 1.2rem;
            border: 1px solid #000;
        }
        .form-container {
            max-width: 800px;
            margin: 70px auto;
            font-size: 1.2rem;
        }
        .form-label {
            color: #6c757d;
        }
        .form-control {
            font-size: 1.2rem;
            padding: 12px;
            border: 1px solid #000;
        }
        button {
            font-size: 1.2rem;
            padding: 10px;
        }
    </style>
</head>
<br>
<br>
<body class="bg-light">
    <div class="text-center mb-5">
        <a href="#" class="btn btn-light custom-button">My Profile</a>
        <a href="#" class="btn btn-light custom-button">Submit New Form</a>
        <a href="#" class="btn btn-light custom-button">Message History</a>
    </div>
    <div class="form-container">
        <form method="post" action="<?= site_url('auth/update_user') ?>">
            <div class="mb-4">
                <label for="first_name" class="form-label">Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $user->first_name ?>" required>
            </div>
            <div class="mb-4">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $user->last_name ?>" required>
            </div>
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $user->email ?>" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Pass</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current">
            </div>
            <button type="submit" class="btn special-button">Update</button>
        </form>
    </div>
</body>
</html>