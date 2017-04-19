<?php

add_action( 'widgets_init', 'recent_posts_widget' );

function recent_posts_widget() {

	register_widget( 'Flatsome_Recent_Post_Widget' );
}

/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class Flatsome_Recent_Post_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'flatsome_recent_posts', 'description' => __('A widget that displays recent posts ', 'flatsome'), 'customize_selective_refresh' => true);

		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flatsome_recent_posts' );

		parent::__construct( 'flatsome_recent_posts', __('Flatsome Recent Posts', 'flatsome'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {

		$cache = wp_cache_get('widget_recent_posts', 'widget');

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

		if ( empty( $instance['image'] ) ) $instance['image'] = false;
		$is_image = $instance['image'] ? 'true' : 'false';

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'flatsome') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );

		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<?php echo '<ul>'; ?>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>

		<?php $image_style = ''; if($is_image == 'true' && has_post_thumbnail()){ $image_style = 'style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2) ), url('.wp_get_attachment_thumb_url(get_post_thumbnail_id(get_the_ID()) ).'); color:#fff; text-shadow:1px 1px 0px rgba(0,0,0,.5); border:0;'; } ?>

		<li class="recent-blog-posts-li">
			<div class="flex-row recent-blog-posts align-top pt-half pb-half">
				<div class="flex-col mr-half">
					<div class="badge post-date <?php if($is_image == 'false') echo 'badge-small';?> badge-<?php echo flatsome_option('blog_badge_style'); ?>">
							<div class="badge-inner bg-fill" <?php echo $image_style;?>>
								<span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span><br>
								<span class="post-date-month is-xsmall"><?php echo get_the_time('M', get_the_ID()); ?></span>
							</div>
					</div>
				</div><!-- .flex-col -->
				<div class="flex-col flex-grow">
					  <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
				   	  <span class="post_comments oppercase op-7 block is-xsmall"><?php comments_popup_link( '', __( '<strong>1</strong> Comment', 'flatsome' ), __( '<strong>%</strong> Comments', 'flatsome' ) ); ?></span>
				</div>
			</div><!-- .flex-row -->
		</li>
		<?php endwhile; ?>
		<?php echo '</ul>'; ?>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
	    $instance['image'] = $new_instance['image'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$instance['image'] = isset( $instance['image'] ) ? $instance['image'] : false;

?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'flatsome' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'flatsome' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Show Thumbnail', 'flatsome' ); ?></label>
 		<input class="checkbox" type="checkbox" <?php checked($instance['image'], 'on'); ?> id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" />

<?php
	}
}

?>
