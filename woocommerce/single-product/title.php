<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<h1 class="product-title entry-title">
	<?php the_title(); ?>
</h1>

<?php if(flatsome_option('product_info_divider')) { ?>
	<div class="is-divider small"></div>
<?php } ?>
