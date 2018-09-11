<?php

/**
 * Fired only when the plugin is un-installed.
 *
 * Removes everything that this plugin added to your db.
 *
 * @category   Core
 * @package    LFC
 * @subpackage Uninstaller
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://github.com/Joel-James/lazy-facebook-comments/
 */
// If uninstall not called from WordPress, then exit. That's it!
defined( 'WPINC' ) or die( 'Damn it.! Dude you are looking for what?' );

// Delete plugin options
if ( get_option( 'lfc_options' ) ) {
	delete_option( 'lfc_options' );
}

/******* The end. Thanks for using Lazy FB Comments plugin ********/
