<?php
// If this file is called directly, abort.
defined( 'WPINC' ) or die( 'Damn it.! Dude you are looking for what?' );

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and enqueue the dashboard-specific stylesheet, JavaScript
 * and all other admin side functions.
 *
 * @category   Core
 * @package    LFC
 * @subpackage Admin
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://github.com/Joel-James/lazy-facebook-comments/
 */
class LFC_Admin {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * The options from db.
	 *
	 * @since  2.0.0
	 * @access private
	 * @var    string $options Get the options saved in db.
	 */
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public function __construct( $plugin_name, $version, $options ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->options     = $options;
	}

	/**
	 * Register the stylesheet for the Dashboard.
	 *
	 * This function is used to register all the required stylesheets for
	 * dashboard. Styles will be registered only for lfc pages for performance.
	 *
	 * @since 2.0.0
	 * @uses  wp_enqueue_style    To register style
	 *
	 * @return void
	 */
	public function enqueue_styles() {

		global $pagenow;

		if ( ( $pagenow == 'options-general.php' ) && ( in_array( $_GET['page'], array( 'lfc-settings' ) ) ) ) {

			wp_enqueue_style(
				$this->plugin_name,
				plugin_dir_url( __FILE__ ) . 'css/min/admin.css',
				array(),
				$this->version,
				'all'
			);
		}
	}

	/**
	 * Creating admin menus for 404 to 301.
	 *
	 * @since 2.0.0
	 * @uses  add_submenu_page Action hook to add new admin menu sub page.
	 *
	 * @return void
	 */
	public function create_lfc_menu() {

		add_options_page(
			__( 'Lazy FB Comments', 'lazy-facebook-comments' ),
			__( 'Lazy FB Comments', 'lazy-facebook-comments' ),
			LFC_ADMIN_PERMISSION,
			'lfc-settings',
			array( $this, 'admin_page' )
		);
	}

	/**
	 * Output buffer function
	 *
	 * To avoid header already sent issue
	 * - https://tommcfarlin.com/wp_redirect-headers-already-sent/
	 * @since    2.0.0
	 *
	 * @return void
	 */
	public function add_buffer() {

		ob_start();
	}

	/**
	 * Admin options page display.
	 *
	 * Includes admin page contents to manage settings.
	 * All html parts will be included in this page.
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public function admin_page() {

		require plugin_dir_path( __FILE__ ) . 'partials/lfc-admin-display.php';
	}

	/**
	 * Registering i4t3 options.
	 * This function is used to register all settings options to the db using
	 * WordPress settings API.
	 * If we want to register another setting, we can include that here.
	 *
	 * @since  2.0.0
	 * @action hooks register_setting Hook to register i4t3 options in db.
	 *
	 * @return void
	 */
	public function register_options() {

		register_setting(
			'lfc_options',
			'lfc_options'
		);
	}

	/**
	 * Custom footer text for LFC pages.
	 *
	 * @since 2.0.0
	 *
	 * @return mixed
	 */
	public function dashboard_footer() {

		global $pagenow;

		if ( ( $pagenow == 'options-general.php' ) && ( in_array( $_GET['page'], array( 'lfc-settings' ) ) ) ) {

			_e( 'Thank you for choosing Lazy FB Comments to improve your website', 'lazy-facebook-comments' );
			echo ' | ';
			_e( 'Kindly give this plugin a ', 'lazy-facebook-comments' );
			echo '<a href="https://wordpress.org/support/view/plugin-reviews/lazy-facebook-comments?filter=5#postform">';
			_e( 'rating', 'lazy-facebook-comments' );
			echo ' &#9733; &#9733; &#9733; &#9733; &#9733;</a>';
		} else {
			return;
		}
	}

	/**
	 * Custom plugin action Link.
	 *
	 * Function to add a quick link to lfc,
	 * when being listed on your plugins list view.
	 *
	 * @since 2.0.0
	 *
	 * @return array $links Links to display.
	 */
	public function plugin_action_links( $links, $file ) {

		$plugin_file = basename( 'lazy-facebook-comments.php' );

		if ( basename( $file ) == $plugin_file ) {

			$settings_link = '<a href="options-general.php?page=lfc-settings&tab=general">' . __( 'Settings', 'lazy-facebook-comments' ) . '</a>';

			array_unshift( $links, $settings_link );
		}

		return $links;
	}

	/**
	 * Get debug data.
	 *
	 * Function to output the debug data for the plugin. This will be useful
	 * when asking for support. Just copy and paste these data to the email.
	 *
	 * @note Please DO NOT translate this part, as this need to be provided
	 * for debugging only. The developer may not understand the translated words.
	 *
	 * @since 2.0.0
	 *
	 * @return string $html Html content to diplay.
	 */
	public function get_debug_data() {

		$html           = '';
		$active_plugins = get_option( 'active_plugins', array() );
		$active_theme   = wp_get_theme();

		// Dump the plugin settings data
		if ( ! empty( $this->options ) ) {
			$html .= '<h4>Settings Data</h4><p><pre>';
			foreach ( $this->options as $key => $option ) {
				$html .= $key . ' : ' . $option . '<br/>';
			}
			$html .= '</pre></p><hr/>';
		}
		// Output basic info about the site
		$html .= '<h4>Basic Details</h4><p>';
		$html .= 'WordPress Version : ' . get_bloginfo( 'version' ) . '<br/>';
		$html .= 'PHP Version : ' . PHP_VERSION . '<br/>';
		$html .= 'Plugin Version : ' . $this->version . '<br/>';
		$html .= 'Home Page : ' . home_url() . '<br/></p><hr/>';

		if ( $active_theme->exists() ) {

			$html .= '<h4>Active Theme Details</h4><p>';
			$html .= 'Name : ' . $active_theme->get( 'Name' ) . '<br/>';
			$html .= 'Version : ' . $active_theme->get( 'Version' ) . '<br/>';
			$html .= 'Theme URI : ' . $active_theme->get( 'ThemeURI' ) . '<br/></p><hr/>';
		}

		// Dump the active plugins data
		if ( ! empty( $active_plugins ) ) {
			$html .= '<h4>Active Plugins</h4><p>';
			foreach ( $active_plugins as $plugin ) {
				$html .= $plugin . '<br/>';
			}
			$html .= '</p>';
		}

		return $html;
	}
}
