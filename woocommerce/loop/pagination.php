<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<div class="container">
<nav class="woocommerce-pagination">
	<?php
		$pages = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => false,
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text' 	=> '<i class="icon-angle-left"></i>',
			'next_text' 	=> '<i class="icon-angle-right"></i>',
			'type'         => 'array',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );

		if( is_array( $pages ) ) {
        	$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
       		echo '<ul class="page-numbers nav-pagination links text-center">';
	        foreach ( $pages as $page ) {
        		$page = str_replace("page-numbers","page-number",$page);
                echo "<li>$page</li>";
	        }
	       echo '</ul>';
        }
	?>
</nav>
</div>
