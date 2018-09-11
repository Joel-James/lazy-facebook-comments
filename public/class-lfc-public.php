<?php

// If this file is called directly, abort.
defined( 'WPINC' ) or die( 'Damn it.! Dude you are looking for what?' );

/**
 * The public-facing functionality of the plugin.
 *
 * @category   Core
 * @package    LFC
 * @subpackage Public
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://github.com/Joel-James/lazy-facebook-comments/
 */
class LFC_Public {

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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 * @param string $options The options of this plugin.
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
	 * Lazy FB Comments comments template file
	 *
	 * This is our custom comments template file for
	 * lazy facebook commments.
	 *
	 * @return file
	 */
	public function lfc_template() {

		global $post;

		/**
		 * Filter to add/remove custom post types.
		 *
		 * @param array $cpts Post types.
		 */
		$post_types = apply_filters( 'lfc_supported_post_types', array( 'post', 'page' ) );

		if ( ! is_singular( $post_types ) || 'open' != $post->comment_status ) {
			return LFC_PLUGIN_DIR . '/public/lfc-closed-comments.php';
		}

		return LFC_PLUGIN_DIR . '/public/lfc-comments.php';
	}

	/**
	 * Comments script to insert in page
	 *
	 * This script is from Facebook plugins SDK.
	 * Future updates will be updated here.
	 *
	 * @return void
	 */
	public function comments_script() {

		global $post;

		/**
		 * Filter to add/remove custom post types.
		 *
		 * @param array $cpts Post types.
		 */
		$post_types = apply_filters( 'lfc_supported_post_types', array( 'post', 'page' ) );

		// load only when required
		if ( ! is_singular( $post_types) || 'open' != $post->comment_status ) {
			return;
		}

		$script = '';

		// add comments script only if Application ID is given
		if ( ! empty( $this->options['app_id'] ) ) {

			// script for fb comments
			$script .= "<script type='text/javascript'>";
			$script .= "function loadLFCComments() {";

			// if sdk is loaded already reinit
			// else add fresh sdk
			if ( $this->sdk_loaded() ) {
				$script .= $this->facebook_sdk_reinit();
			} else {
				$script .= $this->facebook_sdk();
			}

			$script .= "}";
			// get loading method script
			$script .= $this->get_load_script();
			// close the script tag
			$script .= "</script>";
		}

		echo $script;
	}

	/**
	 * Check if facebook sdk is already loaded
	 *
	 * @return boolean
	 */
	private function sdk_loaded() {

		return ( ! empty( $this->options['sdk_loaded'] ) ) && $this->options['sdk_loaded'] == 1;
	}

	/**
	 * Get facebook sdk script
	 *
	 * If facebook sdk is not loaded already
	 * load frsh sdk
	 *
	 * @return string
	 */
	private function facebook_sdk() {

		// set default lang as english if not set
		$lang = ! empty( $this->options['comments_lang'] ) ? $this->options['comments_lang'] : 'en_US';
		// get fb application id
		$app_id = $this->options['app_id'];

		$script = "";
		$script .= "(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = '//connect.facebook.net/" . $lang . "/sdk.js#xfbml=1&version=v2.6&appId=" . $app_id . "';
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                    ";

		return $script;
	}

	/**
	 * Facebook SDK reninitialize script
	 *
	 * If facebook sdk is loaded already by other plugins
	 * re-init the sdk script for our comments
	 *
	 * @return string
	 */
	private function facebook_sdk_reinit() {

		$script = "";
		$script .= "FB.init({
                        appId : '" . $this->options['app_id'] . "',
                        status : true,
                        xfbml : true,
                        version : 'v2.6'
                    });
                    ";

		return $script;
	}

	/**
	 * Get loading method script according to the user settings
	 *
	 * Currently we have on scroll and on click options.
	 * For on click option, we don't need any script, as we
	 * have onClick on button itself.
	 *
	 * @return html
	 */
	private function get_load_script() {

		if ( $this->options['load_on'] == 'scroll' ) {
			return $this->scroll_script();
		} else {
			return $this->click_script();
		}
	}

	/**
	 * Get on scroll script
	 *
	 * Load fb comments sdk when user scroll down
	 * to the comments section with id "lfc_comments"
	 *
	 * @return html
	 */
	private function scroll_script() {

		$script = "window.onscroll = function () {
                        var rect = document.getElementById('lfc_comments').getBoundingClientRect();
                        if (rect.top < window.innerHeight) {
                            var lfc_div = document.getElementById('lfc_comments');
                            lfc_div.innerHTML = '" . $this->comments_area_content() . "';
                            loadLFCComments();
                            window.onscroll = null;
                        } 
                    }";

		return $script;
	}

	/**
	 * On click script
	 *
	 * We need to call loadLFCComments() on button click
	 * also hide button after clicking on it.
	 *
	 * @return string
	 */
	private function click_script() {

		$script = "document.getElementById('lfc_button').onclick = function() {
                    var lfc_div = document.getElementById('lfc_comments');
                    lfc_div.innerHTML = '" . $this->comments_area_content() . "';
                    loadLFCComments();
                };
                ";

		return $script;
	}

	/**
	 * Comments container content required for facebook comments
	 * to be loaded from sdk.
	 *
	 * We are not adding this content to the DOM initially. Because
	 * if facebook sdk is already loaded, comments will be loaded
	 * automatically.
	 *
	 * @return string html content
	 */
	private function comments_area_content() {

		// no. of comments to show
		$count = ! empty( $this->options['comments_count'] ) ? $this->options['comments_count'] : 10;
		// comments width
		$width = ! empty( $this->options['box_width'] ) ? $this->options['box_width'] : '100%';
		// comments color scheme
		$color = ( $this->options['color_scheme'] == 'dark' ) ? 'dark' : 'light';
		// comments sorting
		$order = ! empty( $this->options['order_by'] ) ? $this->options['order_by'] : 'social';
		// comments loading method
		$load_on = ( $this->options['load_on'] == 'click' ) ? 'click' : 'scroll';

		$html = '';
		$html .= '<div id="fb-root"></div>';
		$html .= '<div class="fb-comments" data-width="' . $width . '" data-href="' . get_permalink() . '" data-numposts="' . $count . '" data-colorscheme="' . $color . '" data-order-by="' . $order . '"></div>';

		return $html;
	}
}
