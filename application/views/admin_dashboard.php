<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/AdminDashboard.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .message-body-content {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            // Show success modal
            <?php if ($this->session->flashdata('success')): ?>
                $('#successModal').modal('show');
            <?php endif; ?>

            // Tab navigation
            $('#myProfile').click(function (e) {
                e.preventDefault();
                $('.form-cont, .history-form').removeClass('active');
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

            // Toggle customer details
            $('.customer-item-display').on('click', function (e) {
                if ($(e.target).closest('.customer-details').length === 0 && !$(e.target).is('input, button, a, label')) {
                    $(this).find('.customer-details').slideToggle();
                }
            });

            $('.customer-details').on('click', function (e) {
                e.stopPropagation();
            });

            // Toggle message content
            $('.history-form').on('click', '.message-header', function (e) {
                e.preventDefault();
                const targetId = $(this).data('target');
                console.log('Toggling:', targetId); // Debugging
                $(targetId).slideToggle('fast');
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

<div class="form-cont message-form">
    <?php if (!empty($users)): ?>
        <div class="customer-list">
            <?php foreach ($users as $index => $user): ?>
                <?php
                    $lastMessageDate = 'No messages yet';
                    foreach ($messages as $message) {
                        if ($message->user_id === $user->id) {
                            $lastMessageDate = date('d/m/Y', strtotime($message->created_at));
                            break;
                        }
                    }
                ?>
                <div class="customer-item-display" data-index="<?= $index ?>">
                        <div class="customer-summary">
                            <span class="customer-name">
                                <?= !empty($user->first_name) ? 'Customer ' . htmlspecialchars($user->first_name) : htmlspecialchars($user->email) ?>
                            </span>
                            <span class="customer-date"><?= $lastMessageDate ?></span>
                        </div>
                    <div class="customer-details">
                        <form method="post" action="<?= site_url('admin/update_user/' . $user->id) ?>" class="mb-2">
                            <div class="mb-2">
                                <label class="form-label" for="first_name_<?= $user->id ?>">First Name</label>
                                <input type="text" name="first_name" id="first_name_<?= $user->id ?>" class="form-control" value="<?= htmlspecialchars($user->first_name) ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="last_name_<?= $user->id ?>">Last Name</label>
                                <input type="text" name="last_name" id="last_name_<?= $user->id ?>" class="form-control" value="<?= htmlspecialchars($user->last_name) ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="email_<?= $user->id ?>">Email</label>
                                <input type="email" name="email" id="email_<?= $user->id ?>" class="form-control" value="<?= htmlspecialchars($user->email) ?>">
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="password_<?= $user->id ?>">Password (leave blank to keep)</label>
                                <input type="password" name="password" id="password_<?= $user->id ?>" class="form-control" placeholder="New password">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                <a href="<?= site_url('admin/user_messages/' . $user->id) ?>" class="btn btn-sm btn-info" style="text-decoration: none; display: inline-block; margin: 0 5px;">View Messages</a>
                                <a href="<?= site_url('admin/delete_user/' . $user->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')" style="text-decoration: none; display: inline-block; margin: 0 5px;">Delete User</a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No users found.</p>
    <?php endif; ?>
</div>

<div class="form-cont history-form">
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $index => $message): ?>
            <div class="message-item-card">
                <div class="message-header" data-target="#message-content-<?= $index ?>">
                    <span class="message-sender">From: <?= htmlspecialchars($message->user_email) ?></span>
                    <span class="message-date"><?= date('d/m/Y', strtotime($message->created_at)) ?></span>
                </div>
                <div class="message-body-content" id="message-content-<?= $index ?>">
                    <?= nl2br(htmlspecialchars($message->message)) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">No messages found.</p>
    <?php endif; ?>
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