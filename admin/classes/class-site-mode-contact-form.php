<?php
/**
 * Responsible for add and display subscribes.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.8
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for add and display subscribes.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.8
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Contact_Form {

    public function send_email_cb() {
        // Sanitize and validate inputs
        $full_name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validate email
        if (!is_email($email)) {
            echo json_encode(['status' => 'Fail', 'message' => 'Invalid email address.']);
            wp_die();
        }

        // Check required fields
        if (empty($full_name) || empty($subject) || empty($message)) {
            echo json_encode(['status' => 'Fail', 'message' => 'Please fill in all required fields.']);
            wp_die();
        }

        // Email headers
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $full_name . ' <' . $email . '>');

        // Get admin email
        $admin_email = get_option('admin_email');

        // Send email
        if (wp_mail($admin_email, $subject, $message, $headers)) {
            echo json_encode(['status' => 'Success', 'message' => 'Email sent successfully.']);
        } else {
            echo json_encode(['status' => 'Fail', 'message' => 'Failed to send email.']);
        }

        wp_die();
    }
}
