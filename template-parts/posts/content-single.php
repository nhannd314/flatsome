<div class="entry-content single-page">

<?php the_content(); ?>

<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'flatsome' ),
		'after'  => '</div>',
	) );
?>

<?php if(flatsome_option('blog_share')) {
	// SHARE ICONS
	echo '<div class="blog-share text-center">';
	echo '<div class="is-divider medium"></div>';
	echo do_shortcode('[share]');
	echo '</div>';
} ?>
</div><!-- .entry-content2 -->

<footer class="entry-meta text-<?php echo flatsome_option('blog_posts_title_align');?>">
<?php
	/* translators: used between list items, there is a space after the comma */
	$category_list = get_the_category_list( __( ', ', 'flatsome' ) );

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );


	// But this blog has loads of categories so we should probably display them here
	if ( '' != $tag_list ) {
		$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'flatsome' );
	} else {
		$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'flatsome' );
	}
	
	printf(
		$meta_text,
		$category_list,
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
?>
</footer><!-- .entry-meta -->


<?php if(flatsome_option('blog_author_box')) { ?>
<div class="entry-author author-box">
	<div class="flex-row align-top">
		<div class="flex-col mr circle">
			<div class="blog-author-image">
				<?php 
					$user = get_the_author_meta('ID');
					echo get_avatar($user,90); 
				?>
			</div>
		</div><!-- .flex-col -->
		<div class="flex-col flex-grow">
			<h5 class="author-name uppercase pt-half">
				<?php echo esc_html( get_the_author_meta( 'display_name' ) );?>
			</h5>
			<p class="author-desc small"><?php echo esc_html(get_the_author_meta('user_description'));?></p>
		</div><!-- .flex-col -->
	</div>
</div>
<?php } ?>

<?php flatsome_content_nav( 'nav-below' ); ?>