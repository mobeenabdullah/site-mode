<?php
/**
 * Responsible for add and display subscribes.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.0.7
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for add and display subscribes.
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.7
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Subscribe {

	/**
	 * The array of subscribes.
	 *
	 * @since    1.0.7
	 * @access   private
	 * @var      array    $subscribes    The array of subscribes.
	 */
	public $subscribes = array();

	/**
	 * Site_Mode_Subscribe constructor.
	 *
	 * @since 1.0.7
	 * @return void
	 */
	public function __construct() {
		$this->get_subscribes();
	}

	/**
	 * Responsible for creating custom table.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	public static function create_subscribe_table() {
		global $wpdb;
		$table_name      = $wpdb->prefix . 'site_mode_subscribe';
		$charset_collate = $wpdb->get_charset_collate();
		$sql             = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL UNIQUE,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		// dbDelta( $sql );
		$result = dbDelta( $sql );

		if ( $result === false ) {
			error_log( 'Database table creation error: ' . $wpdb->last_error );
		}
		return $result;
	}

	/**
	 * Responsible for Insert subscribes into database.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	public static function insert_subscribes() {
		global $wpdb;

		$table_name = $wpdb->prefix . 'site_mode_subscribe';
		// check nonce
		if ( ! wp_verify_nonce( $_POST['nonce'], 'sm_subscribe_form_nonce' ) ) {
			wp_send_json_error( 'Invalid nonce' );
		}

		if ( ! isset( $_POST['name'] ) || ! isset( $_POST['email'] ) ) {
			wp_send_json_error( 'Missing required fields' );
		}

		$name  = sanitize_text_field( $_POST['name'] );
		$email = sanitize_email( $_POST['email'] );

		if ( empty( $name ) || empty( $email ) ) {
			wp_send_json_error( 'Missing required fields' );
		}

		// Insert data into the table
		$result = $wpdb->insert(
			$table_name,
			array(
				'name'       => $name,
				'email'      => $email,
				'created_at' => current_time( 'mysql' ),
			),
			array( '%s', '%s', '%s' )
		);

		if ( $result === false ) {
			wp_send_json_error( $wpdb->last_error );
		} else {
			wp_send_json_success( 'Data inserted successfully' );
		}
	}

	/**
	 * Responsible for Get subscribes from database.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	public function get_subscribes() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'site_mode_subscribe';

        // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$this->subscribes = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name", ARRAY_A ) );
	}

	/**
	 * Responsible for to check if subscribe is not empty.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return bool
	 */
	public function hasSubscribes() {
		return ! empty( $this->subscribes );
	}

	/**
	 * Responsible for render subscribe table in admin.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	public function displayTable() {
		$current_page     = isset( $_GET['subscribe_page'] ) ? absint( $_GET['subscribe_page'] ) : 1;
		$records_per_page = 10;
		$pagination_data  = $this->get_subscribe_pagination( $current_page, $records_per_page );
		$data             = $pagination_data['data'];
		$total_rows       = $pagination_data['total_rows'];
		$total_pages      = ceil( $total_rows / $records_per_page );

		?>
		<div class="sm__subscribes">
			<div class="smd-container">
				<div class="sm__subscribes-cover">
					<div class="sm__subscribes-cover--content">
						<div class="sm__subscribes-header">
							<h2 class="page__title">Subscribes</h2>
							<?php $this->displayExportButton(); ?>
						</div>
						<div class="subscribe__table">
							<table class="subscribe__table-cover" id="myTable">
								<thead>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Email</th>
									<th>Date</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php $this->displaySubscribes( $data ); ?>
								</tbody>
							</table>
						</div>

						<?php if ( $total_pages > 1 ) { ?>
							<div class="sm__pagination">
								<?php
									$prev_page = ( $current_page > 1 ) ? $current_page - 1 : 1;
								if ( ! ( isset( $_GET['subscribe_page'] ) && trim( $_GET['subscribe_page'] ) == '1' ) ) {
									echo "<a href='?page=site-mode&setting=subscribes&subscribe_page=$prev_page' class='sm__pagination-item'>&laquo; Previous</a>";
								}

								for ( $i = 1; $i <= $total_pages; $i++ ) {
									echo "<a href='?page=site-mode&setting=subscribes&subscribe_page=$i' " . ( $i == $current_page ? "class='current sm__pagination-item'" : "class='sm__pagination-item'" ) . ">$i</a>";
								}
									// Next Page Link
									$next_page = ( $current_page < $total_pages ) ? $current_page + 1 : $total_pages;
								if ( $current_page !== absint( $total_pages ) ) {
									echo "<a href='?page=site-mode&setting=subscribes&subscribe_page=$next_page' class='sm__pagination-item'>Next &raquo;</a>";
								}

								?>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Responsible to render message when no entry found in table.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	public function displayNoSubscribesMessage() {
		?>
		<div class="sm__subscribes">
			<div class="smd-container">
				<div class="sm__subscribes-cover">
					<div class="sm__subscribes-cover--content">
						<div class="sm__subscribes-header">
							<h2 class="page__title">Subscribes</h2>
						</div>
						<p>No subscribers are listed in the table.</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Responsible display export button.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	private function displayExportButton() {
		?>
		<button id="exportToCSV">Export CSV</button>
		<?php
	}

	/**
	 * Responsible to display row of subscribes in table.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	private function displaySubscribes( $data ) {
		foreach ( $data as $key => $subscribe ) :
			?>
			<tr>
				<td><?php echo esc_html( $key + 1 ); ?></td>
				<td><?php echo esc_html( $subscribe['name'] ); ?></td>
				<td><?php echo esc_html( $subscribe['email'] ); ?></td>
				<td><?php echo esc_html( $subscribe['created_at'] ); ?></td>
				<td class="delete_entry" data-id="<?php echo esc_attr( $subscribe['id'] ); ?>" data-nonce="<?php echo wp_create_nonce( 'sm_subscribe_delete_nonce' ); ?>">
					Delete
					<input type="hidden" id="sm_subscribe_delete_nonce" value="<?php echo wp_create_nonce( 'sm_subscribe_delete_nonce' ); ?>">
				</td>
			</tr>
			<?php // wp_nonce_field('sm_subscribe_delete_nonce', 'sm_subscribe_delete_nonce_field'); ?>
			<?php
		endforeach;
	}

	/**
	 * Responsible to export data in csv format.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	public function subscribe_export_csv() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'site_mode_subscribe';

        // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$data = $wpdb->get_results( "SELECT * FROM $table_name", ARRAY_A );

		if ( $data === false ) {
			echo 'Error in database query';
			error_log( 'Database query error: ' . $wpdb->last_error ); // Check your error log for detailed error message
			die();
		}

		$csv_output = "id,name,email,date\n";

		foreach ( $data as $row ) {
			$csv_output .= implode( ',', $row ) . "\n";
		}

		header( 'Content-type: text/csv' );
		header( 'Content-disposition: attachment; filename=exported_data.csv' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );

		echo $csv_output;
		die();

	}

	/**
	 * Responsible to get pagination data.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return array
	 */
	private function get_subscribe_pagination( $page, $per_page ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'site_mode_subscribe';
		$offset     = ( $page - 1 ) * $per_page;

        // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$sql_query = $wpdb->prepare( "SELECT * FROM $table_name LIMIT %d, %d", $offset, $per_page );

        // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$data = $wpdb->get_results( $sql_query, ARRAY_A );

        // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$total_rows = $wpdb->get_var( "SELECT COUNT(id) FROM $table_name" );

		return array(
			'data'       => $data,
			'total_rows' => $total_rows,
		);
	}

	/**
	 * Responsible to delete subscribe from database.
	 *
	 * @since 1.0.7
	 * @access public
	 * @return void
	 */
	public function delete_subscribe() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'site_mode_subscribe';

		error_log( 'Nonce from POST: ' . sanitize_text_field( $_POST['sm_subscribe_delete_nonce'] ) );
		//
		// if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'sm_subscribe_delete_nonce' ) ) {
		// wp_send_json_error( 'Invalid nonce' );
		// }

		$delete_nonce = wp_create_nonce( 'sm_subscribe_delete_nonce' );
		echo '<input type="hidden" id="sm_subscribe_delete_nonce" value="' . esc_attr( $delete_nonce ) . '">';

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';

		if ( ! wp_verify_nonce( $nonce, 'sm_subscribe_delete_nonce' ) ) {
			wp_send_json_error( 'Invalid nonce' );
		}

		// Validate and sanitize the ID
		$id = absint( $_POST['id'] );

		if ( empty( $id ) ) {
			wp_send_json_error( 'Invalid ID' );
		}

		$result = $wpdb->query(
			$wpdb->prepare( "DELETE FROM $table_name WHERE id = %d", $id )
		);

		if ( $result === false ) {
			error_log( 'Database error: ' . $wpdb->last_error );
			wp_send_json_error( 'Database error' );
		} else {
			error_log( 'Rows affected: ' . $result );
			wp_send_json_success( 'Data deleted successfully' );
		}
	}

}
