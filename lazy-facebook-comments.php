<?php

/**
 * Plugin Name:     Lazy Facebook Comments
 * Plugin URI:      https://thefoxe.com/products/
 * Description:     Light weight Facebook comments with lazy load facility. It loads comments after user clicking on a button or scrolling down. It saves page load time.
 * Version:         2.0.0
 * Author:          Joel James
 * Author URI:      https://thefoxe.com/
 * Donate link:     https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XUVWY8HUBUXY4
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     lazy-facebook-comments
 * Domain Path:     /languages
 *
 * Lazy Facebook Comments is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Lazy Facebook Comments is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Lazy Facebook Comments. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category   Core
 * @package    LFC
 * @author     Joel James <j@thefoxe.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://thefoxe.com/products/lazy-facebook-comments/
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die('Damn it.! Dude you are looking for what?');
}

if (!class_exists('Lazy_Facebook_Comments')) {

    // Constants array
    $constants = array(
        'LFC_PATH' => plugins_url('', __FILE__),
        'LFC_PLUGIN_DIR' => dirname(__FILE__),
        'LFC_SETTINGS_PAGE' => admin_url('admin.php?page=lfc-settings'),
        'LFC_VERSION' => '2.0.0',
        'LFC_ADMIN_PERMISSION' => 'manage_options'
    );

    foreach ($constants as $constant => $value) {
        // Set constants if not set already
        if (!defined($constant)) {
            define($constant, $value);
        }
    }

    /**
     * The code that runs during plugin activation.
     * 
     * @return void
     */
    function lfc_activate_plugin() {
        
        require_once plugin_dir_path(__FILE__) . 'includes/class-lfc-activator.php';
        
        LFC_Activator::activate();
    }
    
    // Run activation hook
    register_activation_hook(__FILE__, 'lfc_activate_plugin');

    // The core plugin class that is used to define
    // dashboard-specific hooks, and public-facing site hooks.
    require_once plugin_dir_path(__FILE__) . 'includes/class-lazy-facebook-comments.php';

    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    2.0.0
     * 
     * @return void
     */
    function lfc_run_plugin() {

        $plugin = new Lazy_Facebook_Comments();
        $plugin->run();
    }

    lfc_run_plugin();
}

//*** Thank you for your interest in Lazy Facebook Comments - Developed and managed by Joel James ***// 