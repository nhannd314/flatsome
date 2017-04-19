<?php

add_action( 'widgets_init', 'ux_blocks_widget' );

function ux_blocks_widget() {
	register_widget( 'Flatsome_UX_Blocks_Widget' );
}

/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class Flatsome_UX_Blocks_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'block_widget', 'description' => __('A widget that displays a Block ', 'flatsome'), 'customize_selective_refresh' => true);

		$control_ops = array('id_base' => 'block_widget' );

		parent::__construct( 'block_widget', __('Flatsome Blocks', 'flatsome'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {

		$cache = wp_cache_get('block_widget', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);
		?>

		<?php echo $before_widget; ?>

		<?php if (!empty($instance['title']) ) echo $before_title . $instance['title'] . $after_title; ?>
		
		<?php if(!empty($instance['block'])) echo do_shortcode('[block id="'.$instance['block'].'"]'); ?>

		<?php echo $after_widget; ?>
		
		<?php
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('block_widget', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['block'] = ( ! empty( $new_instance['block'] ) ) ? strip_tags( $new_instance['block'] ) : '';

		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('block_widget', 'widget');
	}

	function form( $instance ) {

		$blocks = array(false => '-- None --');

		$posts = flatsome_get_post_type_items('blocks');
		if($posts){
		  foreach ($posts as $value) {
		    $blocks[$value->post_name] = $value->post_title;
		  }
		}

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$instance['block'] = isset( $instance['block'] ) ? esc_attr( $instance['block'] ) : '';

?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'flatsome' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'block' ); ?>"><?php _e( 'Block:', 'flatsome' ); ?></label>
		<select class="widefat" name="<?php echo $this->get_field_name( 'block' ); ?>" id="<?php echo $this->get_field_id( 'block' ); ?>">
		<?php foreach ($blocks as $key => $value) {
 		   echo '<option '.selected( $instance['block'], $key).' value="'.$key.'">'.$value.'</option>';
 		} ?>
 		</select>
 		<p>You can edit blocks width the UX Builder if you hover them in the front-end.<a href="#">Learn more about Blocks</a></p>
<?php
	}
}

?>
