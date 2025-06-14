<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('application/assets/css/Dashboard.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myProfile').click(function (e) {
                e.preventDefault();
                $('.message-form, .history-form').removeClass('active');
                $('.user-form').addClass('active');
            });
            $('#submitNewForm').click(function (e) {
                e.preventDefault();
                $('.user-form, .history-form').removeClass('active');
                $('.message-form').addClass('active');
            });
            $('#messageHistory').click(function (e) {
                e.preventDefault();
                $('.user-form, .message-form').removeClass('active');
                $('.history-form').addClass('active');
            });
            $('#cancelMessage').click(function (e) {
                e.preventDefault();
                $('.message-form').removeClass('active');
                $('.user-form').addClass('active');
            });
        });
    </script>
</head>

<body class="bg-light">
    <div class="text-center mb-5">
        <a href="#" id="myProfile" class="btn btn-light custom-button">My Profile</a>
        <a href="#" id="submitNewForm" class="btn btn-light custom-button">Submit New Form</a>
        <a href="#" id="messageHistory" class="btn btn-light custom-button">Message History</a>
    </div>

    <div class="form-container">
        
        <form method="post" action="<?= site_url('dashboard/update_user') ?>" class="user-form active">
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
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current">
            </div>
            <button type="submit" class="btn special-button">Update</button>
        </form>

      
        <form method="post" action="<?= site_url('message/submit') ?>" class="message-form">
            <div class="mb-4">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn special-button">Send</button>
            <button type="button" id="cancelMessage" class="btn special-button ms-2">Cancel</button>
        </form>

        
        <div class="history-form">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message-item">
                        <div class="message-text"><?= htmlspecialchars($message->message) ?></div>
                        <div class="message-date"><?= date('d/m/Y', strtotime($message->created_at)) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No messages found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
