<?php

/**
 * Fired only when the plugin is un-installed.
 *
 * Removes everything that this plugin added to your db.
 *
 * @category   Core
 * @package    LFC
 * @subpackage Uninstaller
 * @author     Joel James <j@thefoxe.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://thefoxe.com/products/lazy-facebook-comments/
 */
// If uninstall not called from WordPress, then exit. That's it!
defined( 'WPINC' ) or die( 'Damn it.! Dude you are looking for what?' );

// Delete plugin options
if (get_option('lfc_options')) {
    delete_option('lfc_options');
}

/******* The end. Thanks for using Lazy Facebook Comments plugin ********/
