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
class Site_Mode_Subscribe  {

    public $subscribes = [];

    public function __construct() {
//        $subscribes_instance = new Site_Mode_Subscribe();
        $this->get_subscribes();
//        $this->subscribes = $subscribes_instance->subscribes;
    }

    public static function create_subscribe_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'site_mode_subscribe';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL UNIQUE,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );
    }

    public static function insert_subscribes() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'site_mode_subscribe';
        // check nonce
        if ( ! wp_verify_nonce( $_POST['nonce'], 'sm_subscribe_form_nonce' ) ) {
            wp_send_json_error( 'Invalid nonce' );
        }

        if( ! isset( $_POST['name'] ) || ! isset( $_POST['email'] ) ) {
            wp_send_json_error( 'Missing required fields' );
        }

        $name = sanitize_text_field( $_POST['name'] );
        $email = sanitize_email( $_POST['email'] );

        if( empty( $name ) || empty( $email ) ) {
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
    public function get_subscribes() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'site_mode_subscribe';

        // Fetch all subscribes
        $this->subscribes = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    }

    public function hasSubscribes() {
        return !empty($this->subscribes);
    }

    public function displayTable() {
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
                                </tr>
                                </thead>
                                <tbody>
                                <?php $this->displaySubscribes(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function displayNoSubscribesMessage() {
        ?>
        <div class="sm__subscribes">
            <div class="smd-container">
                <div class="sm__subscribes-cover">
                    <div class="sm__subscribes-cover--content">
                        <div class="sm__subscribes-header">
                            <h2 class="page__title">Subscribes</h2>
                        </div>
                        <p>There is nothing to display.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private function displayExportButton() {
        ?>
        <button id="exportToExcel">Export</button>
        <?php
    }

    private function displaySubscribes() {
        foreach ($this->subscribes as $subscribe) :
            ?>
            <tr>
                <td><?php echo esc_html($subscribe['id']); ?></td>
                <td><?php echo esc_html($subscribe['name']); ?></td>
                <td><?php echo esc_html($subscribe['email']); ?></td>
                <td><?php echo esc_html($subscribe['created_at']); ?></td>
            </tr>
        <?php
        endforeach;
    }
}