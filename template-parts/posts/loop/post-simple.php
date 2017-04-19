<div class="box">
	<a href="<?php the_permalink() ?>" class="plain">
	  <div class="box-image rectangle">
	    <div class="entry-image-attachment" style="max-height:<?php echo  $image_height; ?>;overflow:hidden;">
			<?php the_post_thumbnail('medium'); ?>
		</div>
	  </div><!-- .box-image -->
	  <div class="box-text spacing-medium text-center">
	     	<h5 class="post-title uppercase"><?php the_title(); ?></h5>
	     	<div class="is-divider small"></div>
	        <?php if($excerpt != 'false') { ?>
	            <p class="from_the_blog_excerpt small-font show-next"><?php
	                $excerpt = get_the_excerpt();
	                echo flatsome_string_limit_words($excerpt,15) . '[...]';
	            ?>
	     	   </p>
	     	 <?php } ?>
	      	 <p class="from_the_blog_comments uppercase xxsmall"><?php echo get_comments_number( get_the_ID() ); ?> comments</p>
	     </div><!-- .post_shortcode_text -->
	</a>
	<?php if($show_date != 'false') {?>
		<?php get_template_part( 'template-parts/posts/partials/entry', 'date-box'); ?>
	<?php } ?>
</div><!-- .box -->