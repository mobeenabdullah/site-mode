<?php
/**
 * Responsible for add and display subscribes.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for add and display subscribes.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.1.1
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Contact_Form {

	/**
	 * Responsible for send email.
	 *
	 * @since 1.1.1
	 * @access public
	 * @return void
	 */
	public function send_email_cb() {

		// Sanitize and validate inputs.
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'sm_contact_form_nonce' ) ) {
			wp_send_json_error( 'Invalid nonce' );
		}

		$full_name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
		$email     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$subject   = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
		$message   = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

		// Validate email.
		if ( ! is_email( $email ) ) {
			echo wp_json_encode(
				array(
					'status'  => 'Fail',
					'message' => 'Invalid email address.',
				)
			);
			wp_die();
		}

		// Check required fields.
		if ( empty( $full_name ) || empty( $subject ) || empty( $message ) ) {
			echo wp_json_encode(
				array(
					'status'  => 'Fail',
					'message' => 'Please fill in all required fields.',
				)
			);
			wp_die();
		}

		// Email headers.
		$headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $full_name . ' <' . $email . '>' );

		// Get admin email.
		$admin_email = get_option( 'admin_email' );

		// Send email.
		if ( wp_mail( $admin_email, $subject, $message, $headers ) ) {
			echo wp_json_encode(
				array(
					'status'  => 'Success',
					'message' => 'Email sent successfully.',
				)
			);
		} else {
			echo wp_json_encode(
				array(
					'status'  => 'Fail',
					'message' => 'Failed to send email.',
				)
			);
		}

		wp_die();
	}
}
