<?php

// If this file is called directly, abort.
defined( 'WPINC' ) or die( 'Damn it.! Dude you are looking for what?' );

/**
 * The public-facing functionality of the plugin.
 *
 * @category   HTML
 * @package    LFC
 * @subpackage Public
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://github.com/Joel-James/lazy-facebook-comments/
 */

// get our plugin options from db
$options = get_option( 'lfc_options' );

// comments width
$width = ! empty( $options['box_width'] ) ? $options['box_width'] : '100%';
// comments div class
$div_class = ! empty( $options['div_class'] ) ? $options['div_class'] : 'comments-area';
// comments loading method
$load_on = ( $options['load_on'] == 'click' ) ? 'click' : 'scroll';
// button text
$btn_text = ! empty( $options['button_text'] ) ? $options['button_text'] : 'Load Comments';

// add comments area only if Application ID is given
if ( ! empty( $options['app_id'] ) ) { ?>

	<div id="lfc_comments" class="<?php echo $div_class; ?>" align="center">
		<?php if ( $load_on == 'click' ) { ?>
			<button id="lfc_button" class="btn button lfc-btn" onclick="loadLFCComments();"><?php echo $btn_text; ?></button>
		<?php } ?>
	</div>

<?php }