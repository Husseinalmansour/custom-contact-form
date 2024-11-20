# custom-contact-form
A lightweight and customizable WordPress plugin that allows users to add a simple contact form to their website. The form supports customizable labels and displays a success message after submission.

Features
Customizable form labels via an admin settings page.
Displays a success message after submission.
Easy-to-use shortcode to embed the form anywhere.
Lightweight design with minimal dependencies.
Installation
Download the Plugin: Clone or download the plugin files from the GitHub repository.

Upload to WordPress:

Go to your WordPress admin dashboard.
Navigate to Plugins > Add New.
Click Upload Plugin and select the plugin .zip file.
Click Install Now and then Activate.
Manual Installation:

Extract the plugin files to your wp-content/plugins/ directory.
Go to Plugins in the WordPress admin and activate the plugin.
Usage
Add the Shortcode: Use the shortcode [custom_contact_form] to embed the contact form on any page or post.

Customize Labels:

Navigate to Contact Form in the WordPress admin sidebar.
Update the form labels and the submit button text as needed.
Save changes.
View Form: Add the shortcode to any page or post and view the form live on your website.

Screenshots
1. Admin Settings Page

2. Contact Form Example

Code Example
Embed the Form:
Add this shortcode to any page or post:
[custom_contact_form]

Redirect and Success Message:
The plugin uses a query parameter (ccf_success=1) to display a success message after submission.

Requirements
WordPress 5.0 or higher.
PHP 7.4 or higher.
FAQ
1. How do I customize the labels?
Go to the Contact Form menu in the admin dashboard and update the labels in the settings page.

2. How do I style the form?
The plugin includes a default stylesheet. To customize it further, edit the style.css file located in the includes/assets/css/ directory.

3. Does the form use AJAX?
No, the form uses standard form submission. AJAX support can be added in future updates.

Contributing
If you'd like to contribute, fork the repository and submit a pull request. Feedback and suggestions are welcome!

Changelog
1.0.0
Initial release.
Basic contact form functionality.
Admin settings page for customization.
License
This plugin is licensed under the GNU3

Support
For issues or feature requests, open an issue in the GitHub repository.
