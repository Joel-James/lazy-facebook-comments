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

$options = get_option( 'lfc_options' );

// no. of comments to show.
$count = ! empty( $options['comments_count'] ) ? $options['comments_count'] : 10;
// comments width.
$width = ! empty( $options['box_width'] ) ? $options['box_width'] : '700';
// comments color scheme.
$color = ( 'dark' === $options['color_scheme'] ) ? 'dark' : 'light';
// comments sorting.
$order = ! empty( $options['order_by'] ) ? $options['order_by'] : 'social';

$height = '394';

if ( ! empty( $width ) ) {
	// Added 16:9 asepct ratio height.
	$height = round( $width / 1.77777777778 );
}

// comments div class.
$div_class = ! empty( $options['div_class'] ) ? $options['div_class'] : 'comments-area';

if ( ! empty( $options['app_id'] ) ) {
	?>
	<div id="lfc_comments" class="<?php echo esc_attr( $div_class ); ?>" align="center">
			<amp-facebook-comments width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" layout="responsive" data-numposts="<?php echo esc_attr( $count ); ?>" data-href="<?php echo esc_attr( get_the_permalink() ); ?>" data-colorscheme="<?php echo esc_attr( $color ); ?>" data-order-by="<?php echo esc_attr( $order ); ?>"></amp-facebook-comments>
	</div>
	<?php
}
