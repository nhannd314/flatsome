<?php
/* translators: used between list items, there is a space after the comma */
?>
<h6 class="entry-category is-xsmall">
	<?php echo get_the_category_list( __( ', ', 'flatsome' ) ); ?>
</h6>

<?php
	if(is_single()){
		echo '<h1 class="entry-title">'.get_the_title().'</h1>';
	} else{
		echo '<h2 class="entry-title"><a href="'.get_the_permalink().'" rel="bookmark" class="plain">'.get_the_title().'</a></h2>';
	}
?>

<div class="entry-divider is-divider small"></div>

<?php if ( 'post' == get_post_type() ) : ?>
<div class="entry-meta uppercase is-xsmall">
    <?php flatsome_posted_on(); ?>
</div><!-- .entry-meta -->
<?php endif; ?>
