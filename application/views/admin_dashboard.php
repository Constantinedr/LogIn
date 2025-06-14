<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/Dashboard.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

            <?php if ($this->session->flashdata('success')): ?>
                $('#successModal').modal('show');
            <?php endif; ?>

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
        });
    </script>
</head>
<body class="bg-light">
    <br><br>

    <div class="text-center mb-5">
        <a href="#" id="myProfile" class="btn btn-light custom-button">My Profile</a>
        <a href="#" id="submitNewForm" class="btn btn-light custom-button">View All Users</a>
        <a href="#" id="messageHistory" class="btn btn-light custom-button">Message History</a>
    </div>

    <div class="form-container">
        <form method="post" action="<?= site_url('admin/update_admin') ?>" class="user-form active">
            <h3 class="text-center mb-4">My Profile</h3>
            <div class="mb-4">
                <label for="first_name" class="form-label">Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?= htmlspecialchars($admin->first_name ?? '') ?>" required>
            </div>
            <div class="mb-4">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?= htmlspecialchars($admin->last_name ?? '') ?>" required>
            </div>
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($admin->email ?? '') ?>" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current">
            </div>
            <button type="submit" class="btn special-button">Update</button>
            <a href="<?= site_url('auth/logout'); ?>" class="btn special-button">Back to LogIn</a>
        </form>
    </div>

    <div class="form-cont">
        <div class="message-form">
            <h3 class="text-center mb-4">All Customers</h3>
            <?php if (!empty($users)): ?>
                <div class="accordion" id="customerAccordion">
                    <?php foreach ($users as $index => $user): ?>
                        <?php
                            // Get user's last message date, if applicable
                            $lastMessageDate = '';
                            foreach ($messages as $message) {
                                if ($message->user_email === $user->email) {
                                    $lastMessageDate = date('d/m/Y', strtotime($message->created_at));
                                    break;
                                }
                            }
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                                    Customer <?= htmlspecialchars($user->first_name) ?>
                                    &nbsp;&nbsp;•&nbsp;&nbsp;<?= $lastMessageDate ? $lastMessageDate : 'No messages yet' ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#customerAccordion">
                                <div class="accordion-body">
                                    <strong>First Name:</strong> <?= htmlspecialchars($user->first_name) ?><br>
                                    <strong>Last Name:</strong> <?= htmlspecialchars($user->last_name) ?><br>
                                    <strong>Email:</strong> <?= htmlspecialchars($user->email) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">No users found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-cont">
        <div class="history-form">
            <h3 class="text-center mb-4">Message History</h3>
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message-item">
                        <div class="message-text">
                            <strong>From: <?= htmlspecialchars($message->user_email) ?></strong><br>
                            <?= nl2br(htmlspecialchars($message->message)) ?>
                        </div>
                        <div class="message-date"><?= date('d/m/Y', strtotime($message->created_at)) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No messages found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $this->session->flashdata('success') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
