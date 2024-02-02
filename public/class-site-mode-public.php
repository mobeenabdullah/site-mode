<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mobeenabdullah.com
 * @since      1.1.1
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/public
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.1.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Site Mode Design Settings
	 *
	 * @since 1.1.1
	 * @access private
	 * @var array $site_mode_design Design settings of site mode.
	 */
	protected $site_mode_design;

	/**
	 * Enable Template
	 *
	 * @since 1.1.1
	 * @access private
	 * @var string|bool $enable_template Enable template.
	 */
	protected $enable_template;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1.1
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->site_mode_design = get_option( 'site_mode_design' );

		// check if value is set or not if not set then set default value.
		$this->enable_template = isset( $this->site_mode_design['enable_template'] ) ? $this->site_mode_design['enable_template'] : '1';

		add_filter( 'style_loader_tag', array( $this, 'my_style_loader_tag_filter' ), 10, 2 );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.1.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Site_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Site_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, SITE_MODE_PUBLIC_URL . 'css/site-mode-public.css', array(), $this->version, 'all' );
	}

    function custom_login_css() {
        ?>
        <style>
            :root {
                --login-primary-color: #19BDD4;
                --login-white-color: #ffffff;
                --login-white-rgb: 255,255,255;
            }
            .login {
                background-color: gray;
                background-image: url('https://c.pxhere.com/photos/cc/1f/photo-1404179.jpg!d');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: calc(100vh - 14rem);
                width: 100%;
                box-sizing: border-box;
                background-image: linear-gradient(-90deg, rgb(255, 255, 255) 24%, rgb(122, 122, 122) 100%);
            }

            /* show and hide logo */
            .login #login h1 {
                display: block;
                text-align: right;
            }
            /* Option logo width and height */
            .login #login h1 a {
                background-image: url('https://storage.googleapis.com/pr-newsroom-wp/1/2018/11/Spotify_Logo_CMYK_Green.png');
                margin: unset;
                min-width: 100px;
                max-height: 100px;
                background-size: 100px;
                display: inline-block;
                overflow: hidden;
                text-indent: -9999px;
                white-space: nowrap;
                font-size: 0;
            }

            .login #login {
                margin-top: 10rem;
                background-color: rgba(var(--login-white-rgb),0.15);
                padding: 2rem;
                border: 1px solid rgba(var(--login-white-rgb),0.20);
                border-radius: 0.5rem;

            }
            .login #login #login-message {
                border-color: var(--login-primary-color);
            }
            .login #login #loginform {
                background-color: transparent;
                border: none;
                padding: 0;
            }
            .login #login #loginform label {
                color: white;
                margin-bottom: 0.5rem;
            }
            .login #login #loginform input {
                background-color: transparent;
                border: 1px solid rgba(var(--login-white-rgb),1);
                color: white;
            }
            .login #login #loginform input:focus {
                border-color: var(--login-primary-color);
            }
            .login #login #nav a, .login #login #backtoblog a {
                color: var(--login-white-color);
            }
            .login #login #backtoblog {
                padding: 0;
                margin-bottom: 0;
            }
            .login #login #backtoblog a {
                background-color: var(--login-white-color);
                color: var(--login-primary-color);
                padding: 1rem 2rem;
                border-radius: 0.5rem;
                border: 1px solid var(--login-primary-color);
                display: block;
                text-align: center;
            }
            .login #login #backtoblog a:hover {
                background-color: var(--login-primary-color);
                color: var(--login-white-color);
            }
            .login #login .submit input[type="submit"] {
                color: var(--login-white-color) !important;
                border: 1px solid var(--login-primary-color) !important;
                background-color: var(--login-primary-color) !important;
                color: var(--login-white-color);
            }
            .login #login .submit input[type="submit"]:hover {
                border: 1px solid var(--login-white-color) !important;
                background-color: var(--login-white-color) !important;
                color: var(--login-primary-color) !important;
            }

            .login #login .submit input[type="checkbox"] {
                accent-color: var(--login-white-color);
            }
            .login #login #loginform .button {
                color: var(--login-white-color);
            }
            .login #login #loginform .button:hover {
                color: var(--login-white-color);
            }
            .login #login #loginform .button:focus {
                border-color: var(--login-white-color);
            }
        </style>
            <?php
    }

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.1.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Site_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Site_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, SITE_MODE_PUBLIC_URL . 'js/site-mode-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Custom filter function to modify the HTML output of style loader tags.
	 *
	 * @param string $html   The HTML output for the style loader tag.
	 * @param string $handle The unique identifier for the registered style.
	 *
	 * @return string The modified HTML output for the style loader tag.
	 */
	public function my_style_loader_tag_filter( $html, $handle ) {
		if ( 'preconnect-font' === $handle ) {
			return str_replace(
				"rel='stylesheet'",
				"rel='preconnect'",
				$html
			);
		}
		if ( 'preconnect-static' === $handle ) {
			return str_replace(
				"rel='stylesheet'",
				"rel='preconnect' crossorigin",
				$html
			);
		}
		return $html;
	}

	/**
	 * Adds a login icon to the footer based on site mode settings.
	 *
	 * @since 1.1.1
	 * @access public
	 * @global array $site_mode_general General settings of site mode.
	 * @global array $site_mode_design Design settings of site mode.
	 * @global int $active_page Active page ID.
	 * @global int $coming_soon_page Coming soon page ID.
	 * @global int $maintenance_page Maintenance page ID.
	 * @global bool $is_valid_page Check if page is valid or not.
	 * @return void
	 */
	public function add_login_icon() {

		$general_settings = get_option( 'site_mode_general' );
		$design_settings  = get_option( 'site_mode_design' );
		$active_page      = isset( $design_settings['page_setup']['active_page'] ) ? $design_settings['page_setup']['active_page'] : '';
		$coming_soon_page = isset( $design_settings['page_setup']['coming_soon_page_id'] ) ? $design_settings['page_setup']['coming_soon_page_id'] : '';
		$maintenance_page = isset( $design_settings['page_setup']['maintenance_page_id'] ) ? $design_settings['page_setup']['maintenance_page_id'] : '';
		$is_valid_page    = false;

		if ( ! is_admin() && ( ! is_user_logged_in() || isset( $_GET['site-mode-preview'] ) ) && ( get_the_ID() === $active_page || get_the_ID() === $coming_soon_page && get_the_ID() === $maintenance_page ) ) {
			$is_valid_page = true;
		}

		if ( ! empty( $general_settings['show_login_icon'] ) && ! empty( $general_settings['custom_login_url'] ) && $is_valid_page ) :
			?>
			<div class="login_icon_footer">
				<a href="<?php echo esc_url( $general_settings['custom_login_url'] ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="40"  height="40" viewBox="0 0 24 24" style="fill:#ffffff"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z" fill="#ffffff"></path></svg>
				</a>
			</div>
			<?php
		endif;
	}

    public function site_mode_login_internal_styling() {
        $design_settings  = get_option( 'site_mode_design' );
        $login_template_active = isset( $design_settings['page_setup']['login_template_active'] ) ? $design_settings['page_setup']['login_template_active'] : '';
        $login_page_styles = isset( $design_settings['page_setup']['login_page_styles'] ) ? $design_settings['page_setup']['login_page_styles'] : '';


        if ( ! empty( $login_template_active ) && ! empty( $login_page_styles ) ) {
            $stylesArray = json_decode($login_page_styles, true);
            $login_page_styling = '';
            foreach ($stylesArray as $selector => $styles) {
                $login_page_styling .= $selector . '{';
                foreach ($styles as $property => $value) {
                    $login_page_styling .= $property . ':' . $value . ';';
                }
                $login_page_styling .= '}';
            }

            $styles = "<style type='text/css'>\n";
            $styles .= $login_page_styling;
            $styles .= "</style>\n";
            echo $styles;
        }
    }
}
