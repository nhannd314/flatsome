<?php
/**
 * Adds Upsell_Widget.
 */

function register_upsell_widget() {
    register_widget( 'Upsell_Widget' );
}
add_action( 'widgets_init', 'register_upsell_widget' );

class Upsell_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'upsell_widget', // Base ID
			'Flatsome Upsell Products', // Name
			array( 'description' => __( 'Add upsell products to product page', 'flatsome' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $product, $woocommerce, $woocommerce_loop;

		/* Disable if not on product page */
		if(!function_exists('is_product') || !is_product()) return;

    $upsells = woocommerce_version_check('3.0.0') ?  $product->get_upsell_ids() :  $product->get_upsells();

		if ( sizeof( $upsells ) == 0 ) return;

		extract( $args );

		if ( isset( $instance[ 'title' ] ) ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
		}
		else {
			$title = __( 'Complete the look', 'flatsome' );
		}

		$meta_query = $woocommerce->query->get_meta_query();

		$args = array(
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
			'posts_per_page'      => 9,
			'orderby'             => 'rand',
			'post__in'            => $upsells,
			'post__not_in'        => array( $product->get_id() ),
			'meta_query'          => $meta_query
		);

		$products = new WP_Query( $args );

		echo $before_widget;


		if ($products->have_posts()) :

		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
?>
		<ul class="up-sell product_list_widget">
		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php wc_get_template_part( 'content', 'product-small' ); ?>
		<?php endwhile; // end of the loop. ?>
		</ul>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Complete the look', 'flatsome' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title','wordpress'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

} // class Foo_Widget
