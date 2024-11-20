<?php
$settings = get_option('ccf_settings', [
    'name_label' => 'Name',
    'email_label' => 'Email',
    'message_label' => 'Message',
    'submit_text' => 'Send',
]);
?>
<?php if (isset($_GET['ccf_success']) && $_GET['ccf_success'] == '1') : ?>
    <script>
        alert('Thank you for your message! We will get back to you soon.');
    </script>
<?php endif; ?>

<form id="ccf-contact-form" method="POST" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
    <label for="ccf-name"><?php echo esc_html($settings['name_label']); ?></label>
    <input type="text" id="ccf-name" name="ccf_name" required>

    <label for="ccf-email"><?php echo esc_html($settings['email_label']); ?></label>
    <input type="email" id="ccf-email" name="ccf_email" required>

    <label for="ccf-message"><?php echo esc_html($settings['message_label']); ?></label>
    <textarea id="ccf-message" name="ccf_message" required></textarea>

    <input type="submit" name="ccf_submit" value="<?php echo esc_attr($settings['submit_text']); ?>">
</form>
