<?php

// Abort is called directly. Alla pinne!
defined( 'WPINC' ) or die( 'Damn it.! Dude you are looking for what?' );

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @category   Core
 * @package    LFC
 * @subpackage Activator
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://github.com/Joel-James/lazy-facebook-comments/
 */
class Lazy_Facebook_Comments {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    LFC_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

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
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name, plugin version and the plugin table name that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public function __construct() {

		$this->plugin_name = 'lazy-facebook-comments';
		$this->version     = LFC_VERSION;
		$this->options     = get_option( 'lfc_options' );
		$this->load_dependencies();
		$this->set_locale();
		$this->execute_admin_hooks();
		$this->execute_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - LFC_Loader. Orchestrates the hooks of the plugin.
	 * - LFC_Admin. Defines all hooks for the dashboard.
	 * - LFC_Public. Defines all hooks for the public functions.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since  2.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function load_dependencies() {

		require_once LFC_PLUGIN_DIR . '/includes/class-lfc-loader.php';
		require_once LFC_PLUGIN_DIR . '/includes/class-lfc-i18n.php';
		require_once LFC_PLUGIN_DIR . '/admin/class-lfc-admin.php';
		require_once LFC_PLUGIN_DIR . '/public/class-lfc-public.php';

		$this->loader = new LFC_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the LFC_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function set_locale() {

		$plugin_i18n = new LFC_i18n();

		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 * This function is used to register all styles and JavaScripts for admin side.
	 *
	 * @since  2.0.0
	 * @access private
	 * @uses   add_action() and add_filter()
	 *
	 * @return void
	 */
	private function execute_admin_hooks() {

		// no need to execute if not admin side
		if ( ! is_admin() ) {
			return;
		}

		$plugin_admin = new LFC_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_options() );

		$this->loader->add_filter( 'admin_init', $plugin_admin, 'add_buffer' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'create_lfc_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_options' );
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'dashboard_footer' );
		$this->loader->add_filter( 'plugin_action_links', $plugin_admin, 'plugin_action_links', 10, 5 );
	}

	/**
	 * Register all of the hooks related to handle 404 actions of the plugin.
	 *
	 * @since  2.0.0
	 * @access private
	 * @uses   add_filter()
	 *
	 * @return void
	 */
	private function execute_public_hooks() {

		// no need to execute if admin side
		if ( is_admin() ) {
			return;
		}

		$plugin_public = new LFC_Public( $this->get_plugin_name(), $this->get_version(), $this->get_options() );

		$this->loader->add_filter( 'comments_template', $plugin_public, 'lfc_template' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'comments_script', 100 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public function run() {

		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  2.0.0
	 *
	 * @return string The name of the plugin.
	 */
	public function get_plugin_name() {

		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since  2.0.0
	 *
	 * @return LFC_Loader Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since  2.0.0
	 * '
	 * @return string The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;
	}

	/**
	 * Retrieve the options data from db.
	 *
	 * @since  2.0.0
	 * '
	 * @return string The version number of the plugin.
	 */
	public function get_options() {

		return $this->options;
	}
}
