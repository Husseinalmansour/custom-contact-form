<?php
if (!defined('ABSPATH')) {
    exit;
}


add_action('init', function () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ccf_submit'])) {
        ccf_process_form();
    }
});


function ccf_process_form() {
    $name = sanitize_text_field($_POST['ccf_name']);
    $email = sanitize_email($_POST['ccf_email']);
    $message = sanitize_textarea_field($_POST['ccf_message']);

    if (!is_email($email)) {
        wp_die('Invalid email address.');
    }

    $to = get_option('admin_email'); // Send to admin by default.
    $subject = "Contact Form Message from $name";
    $headers = ['From: ' . $name . ' <' . $email . '>'];

    // Use wp_mail to send the email.
    $sent = wp_mail($to, $subject, $message, $headers);

    if (!$sent) {
        wp_die('Failed to send email. Please try again.');
    }

    // Redirect after submission.
    wp_redirect(home_url());
    exit;
}
