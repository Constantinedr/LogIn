<!DOCTYPE html>
<html>
<head>
    <title>Registry</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/Dashboard.css') ?>">
    <style>
        /*
           All the CSS rules from the previous login page styling
           (e.g., .login-wrapper, .login-title, .login-form-group,
           .login-label, .login-input, .login-button-container,
           .login-button) should be present in your Dashboard.css file.
           
           I am including the core structure of the necessary CSS here for completeness.
           You should ensure these are in your Dashboard.css.
        */

        /* Basic reset for consistent rendering */
        body, h1, h2, h3, h4, h5, h6, p, label, input, textarea, button, a {
            margin: 0;
            padding: 0;
            font-family: sans-serif; /* General font, customize if needed */
            color: #6c757d; /* Grey text color from your existing styles */
            box-sizing: border-box;
        }

        body {
            
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
        }

        /* --- Reused/Modified CSS for the Form --- */
        .login-wrapper { /* Reused for the main container */
            width: 100%;
            max-width: 400px; /* Constrain width as per image */
            
            padding: 20px; /* Padding inside the container */
            text-align: center;
            background-color: #fff; /* White background for the form area */
        }

        .login-title { /* Reused for the main title */
            font-size: 1.5rem; /* Adjust font size for main title */
            margin-bottom: 20px; /* Increased margin for this page */
            text-transform: uppercase;
            color: #6c757d;
            font-weight: normal;
        }

        /* .login-subtitle is not used on this page */

        .login-form-group { /* Reused for spacing between form groups */
            margin-bottom: 15px; /* Spacing between form groups */
            text-align: left; /* Align labels and inputs to the left */
        }

        .login-label { /* Reused for labels */
            display: block; /* Make label appear above input */
            margin-bottom: 5px;
            font-size: 1.1rem;
            color: #6c757d;
        }

        .login-input { /* Reused for input fields */
            width: 100%;
            padding: 8px 10px; /* Adjust padding */
            border: 1px solid #6c757d; /* Grey border */
            border-radius: 0; /* Square corners */
            font-size: 1.1rem;
            box-sizing: border-box; /* Include padding and border in element's total width */
        }

        .login-button-container { /* Reused for button alignment */
            text-align: right; /* Align button to the right */
            margin-top: 20px;
            /* No margin-bottom as there are no links below */
        }

        .login-button { /* Reused for button styling */
            padding: 8px 25px; /* Adjust padding for button */
            border: 1px solid #6c757d; /* Grey border for button */
            background-color: #fff; /* White background */
            color: #6c757d; /* Grey text */
            font-size: 1.1rem;
            cursor: pointer;
            border-radius: 0; /* Square corners */
            transition: background-color 0.2s, color 0.2s;
        }

        .login-button:hover {
            background-color: #e9ecef; /* Slight hover effect */
        }

        /* .login-links is not used on this page */
    </style>
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
    </form>
    </div>
</body>
</html>