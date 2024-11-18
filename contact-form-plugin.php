<?php
/*
Plugin Name: Custom Contact Form
Description: A simple customizable contact form plugin.
Version: 1.0.0
Author: Hussein Al-Mansour
Author URL: https://hussein.pro
*/

define('CCF_PLUGIN_DIR', plugin_dir_path(__FILE__));  // Define the plugin directory constant


require_once CCF_PLUGIN_DIR . 'includes/class-contact-form-plugin.php';

CustomContactFormPlugin::get_instance();  // Initialize the plugin

