<?php
if (!defined('ABSPATH')) {
    exit;
}

class CustomContactFormPlugin {
    
    private static $instance = null;

    // Constructor
    private function __construct() {
        $this->define_constants();
        $this->load_dependencies();
        $this->register_hooks();
    }

    // Get Single instance.
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Prevent cloning.
    private function __clone() {}

    // Prevent unserializing.
    public function __wakeup() {}

    // Define plugin constants.
    private function define_constants() {
        if (!defined('CCF_PLUGIN_DIR')) {
            define('CCF_PLUGIN_DIR', plugin_dir_path(__FILE__));
        }
        if (!defined('CCF_PLUGIN_URL')) {
            define('CCF_PLUGIN_URL', plugin_dir_url(__FILE__));
        }
    }

    // Load dependencies.
    private function load_dependencies() {
        require_once CCF_PLUGIN_DIR . 'includes/form-handler.php';

    }

    public function register_hooks() {
        add_shortcode('custom_contact_form', [$this, 'render_contact_form']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    // Add menu page.
    public function add_admin_menu() {
        add_menu_page(
            'Contact Form Settings','Contact Form','manage_options','ccf-settings',[$this, 'render_admin_page'],'dashicons-feedback',90);
    }

    // Render the admin page.
    public function render_admin_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (isset($_POST['ccf_save_settings'])) {
            $this->save_settings();
        }

        $settings = get_option('ccf_settings', [
            'name_label' => 'Name',
            'email_label' => 'Email',
            'message_label' => 'Message',
            'submit_text' => 'Send',
        ]);
        ?>
        <div class="wrap">
            <h1>Contact Form Settings</h1>
            <form method="POST">
                <?php wp_nonce_field('ccf_save_settings', 'ccf_nonce'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="ccf_name_label">Name Label</label></th>
                        <td><input type="text" id="ccf_name_label" name="ccf_settings[name_label]" value="<?php echo esc_attr($settings['name_label']); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ccf_email_label">Email Label</label></th>
                        <td><input type="text" id="ccf_email_label" name="ccf_settings[email_label]" value="<?php echo esc_attr($settings['email_label']); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ccf_message_label">Message Label</label></th>
                        <td><input type="text" id="ccf_message_label" name="ccf_settings[message_label]" value="<?php echo esc_attr($settings['message_label']); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ccf_submit_text">Submit Button Text</label></th>
                        <td><input type="text" id="ccf_submit_text" name="ccf_settings[submit_text]" value="<?php echo esc_attr($settings['submit_text']); ?>" class="regular-text"></td>
                    </tr>
                </table>

                <p class="submit">
                    <button type="submit" name="ccf_save_settings" class="button button-primary">Save Changes</button>
                </p>
            </form>
        </div>
        <?php
    }

    // Save settings.
    private function save_settings() {
        if (!isset($_POST['ccf_nonce']) || !wp_verify_nonce($_POST['ccf_nonce'], 'ccf_save_settings')) {
            wp_die('Invalid nonce!');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized!');
        }

        $settings = [
            'name_label' => sanitize_text_field($_POST['ccf_settings']['name_label'] ?? ''),
            'email_label' => sanitize_text_field($_POST['ccf_settings']['email_label'] ?? ''),
            'message_label' => sanitize_text_field($_POST['ccf_settings']['message_label'] ?? ''),
            'submit_text' => sanitize_text_field($_POST['ccf_settings']['submit_text'] ?? ''),
        ];

        update_option('ccf_settings', $settings);

        echo '<div class="updated"><p>Settings saved!</p></div>';
    }

    
    public function render_contact_form() {
        ob_start();
        include CCF_PLUGIN_DIR . 'templates/contact-form.php';
        return ob_get_clean();
    }

    
    public function enqueue_assets() {
        wp_enqueue_style('ccf-style', CCF_PLUGIN_URL . 'assets/css/style.css');
        wp_enqueue_script('ccf-script', CCF_PLUGIN_URL . 'assets/js/script.js', ['jquery'], null, true);
    }
    
}
