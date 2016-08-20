<?php
if ( ! defined( 'WPINC' ) ) {
	die('Nice try dude. But I am sorry');
}
/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the dashboard pages of the plugin.
 *
 * @category   Core
 * @package    LFC
 * @subpackage Admin View
 * @author     Joel James <j@thefoxe.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://thefoxe.com/products/lazy-facebook-comments/
 */
?>

<!-- This should be primarily consist of HTML with a little bit of PHP in it. -->
<?php
$active_tab = ( !isset( $_GET['tab'] ) ) ? 'general' : $_GET['tab'];
$general_class = '';
$credits_class = '';
${$active_tab .'_class'} = 'nav-tab-active';
?>

<div class="wrap">
    <h2><?php _e( 'Lazy Facebook Comments', 'lazy-facebook-comments' ); ?> | <?php _e( 'Settings', 'lazy-facebook-comments' ); ?></h2><br>
    <h2 class="nav-tab-wrapper">
        <a href="?page=lfc-settings&tab=general" class="nav-tab <?php echo $general_class; ?>"><?php _e( 'Settings', 'lazy-facebook-comments' ); ?></a>
        <a href="?page=lfc-settings&tab=credits" class="nav-tab <?php echo $credits_class ?>"><?php _e( 'Help & Info', 'lazy-facebook-comments' ); ?></a>
    </h2>
</div>

<?php
        
switch ( $active_tab ) {
        
    case 'general':
        include_once('lfc-admin-general-tab.php');
        break;
            
    case 'credits':
        $current_user = wp_get_current_user();
        include_once('lfc-admin-credits-tab.php');
        break;
        
    default:
        include_once('lfc-admin-general-tab.php');
}