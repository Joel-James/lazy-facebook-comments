<?php

// Abort is called directly. Alla pinne!
defined( 'WPINC' ) or die( 'Damn it.! Dude you are looking for what?' );

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @category   Core
 * @package    LFC
 * @subpackage Activator
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://github.com/Joel-James/lazy-facebook-comments/
 */
class LFC_Activator {

	/**
	 * Method to run during activation
	 *
	 * Insert default settings options if not already exists.
	 *
	 * @since  2.0.0
	 *
	 * @return void
	 */
	public static function activate() {

		// New settings array to be added
		$options = array(
			'app_id'         => '',
			'comments_count' => 10,
			'button_text'    => 'Load Comments',
			'box_width'      => '',
			'comments_lang'  => 'en_US',
			'color_scheme'   => 'light',
			'order_by'       => 'social',
			'load_on'        => 'click',
			'div_class'      => 'comments-area',
			'sdk_loaded'     => 0
		);

		// If not already exist, adding values
		if ( ! get_option( 'lfc_options' ) ) {
			update_option( 'lfc_options', $options );
		}
	}
}