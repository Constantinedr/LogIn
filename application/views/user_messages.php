<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Messages for <?= htmlspecialchars($user->first_name ?? '') ?> <?= htmlspecialchars($user->last_name ?? '') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/Dashboard.css') ?>">
</head>
<body class="bg-light">
    <div class="main-content-wrapper user-messages-page">
        <h3 class="text-center mb-4">Messages for <?= htmlspecialchars($user->email ?? 'Unknown User') ?></h3>

        <?php if (!empty($messages)): ?>
            <div class="messages-list">
                <?php foreach ($messages as $message): ?>
                    <div class="message-item">
                        <div class="message-text">
                            <p><?= nl2br(htmlspecialchars($message->message ?? '')) ?></p>
                        </div>
                        <div class="message-date"><?= date('d/m/Y', strtotime($message->created_at ?? 'now')) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No messages found for this user.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="<?= site_url('admin/dashboard') ?>" class="btn special-button">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>