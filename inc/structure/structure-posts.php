<?php

// Remove recent comments style
function flatsome_remove_recent_comments_style() {
        global $wp_widget_factory;
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
    }
add_action( 'widgets_init', 'flatsome_remove_recent_comments_style' );




// Blog Article Classes
function flatsome_blog_article_classes(){
    $classes = array();
    if(flatsome_option('blog_posts_depth')) $classes[] = 'has-shadow box-shadow-'.flatsome_option('blog_posts_depth');
    if(flatsome_option('blog_posts_depth_hover'))  $classes[] = 'box-shadow-'.flatsome_option('blog_posts_depth_hover').'-hover';
    if(!empty($classes)) echo implode(' ', $classes);
}

// Add Custom Blog Header
function flatsome_custom_blog_header(){
	if(flatsome_option('blog_header') && is_home()){
		echo '<div class="blog-header-wrapper">'.do_shortcode(flatsome_option('blog_header')).'</div>';
	}
}
add_action('flatsome_after_header','flatsome_custom_blog_header', 10);

// Add transparent headers
function flatsome_blog_header_classes($classes){
    // Add transparent header to product page if set.
    if(is_singular('post') && flatsome_option('blog_single_transparent')){
        $classes[] = 'transparent has-transparent nav-dark toggle-nav-dark';
    }
    if(flatsome_option('blog_archive_transparent') && is_home()){
        $classes[] = 'transparent has-transparent nav-dark toggle-nav-dark';
    }
    return $classes;
}

add_filter('flatsome_header_class','flatsome_blog_header_classes', 10);


// Add Big blog header
function flatsome_single_page_header(){
  if(is_singular('post') && get_theme_mod('blog_post_style') == 'top'){
		echo get_template_part( 'template-parts/posts/partials/single-featured', get_theme_mod('blog_post_style'));
	}
}
add_action('flatsome_after_header','flatsome_single_page_header', 10);


// Add Blog Archive title
function flatsome_archive_title(){
    if(flatsome_option('blog_archive_title') && (is_archive() || is_search())){
        echo get_template_part( 'template-parts/posts/partials/archive-title');
    }
}
add_action('flatsome_before_blog','flatsome_archive_title', 15);


// Remove the Auto scrolling if a Read more link is clicked
function flatsome_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'flatsome_remove_more_link_scroll' );

// Add HTML after blog posts
function flatsome_before_blog_comments(){
    if(get_theme_mod('blog_after_post')){
        echo '<div class="html-before-comments mb">'.do_shortcode(get_theme_mod('blog_after_post')).'</div>';
    }
}
add_action('flatsome_before_comments','flatsome_before_blog_comments');

// Add button class to read more link
if( ! function_exists('flatsome_add_morelink_class') ) {
  function flatsome_add_morelink_class( $link, $text ) {
      return str_replace(
           'more-link'
          ,'more-link button primary smaller is-outline'
          ,$link
      );
  }
}
add_action( 'the_content_more_link', 'flatsome_add_morelink_class', 10, 2 );


/**
 * Display navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'flatsome_content_nav' ) ) :

function flatsome_content_nav( $nav_id ) {
    global $wp_query, $post;

    // Don't print empty markup on single pages if there's nowhere to navigate.
    if ( is_single() ) {
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous )
            return;
    }

    // Don't print empty markup in archives if there's only one page.
    if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
        return;

    $nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

    ?>
    <?php if ( is_single() ) : // navigation links for single posts ?>
    <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
	<div class="flex-row next-prev-nav bt bb">
		<div class="flex-col flex-grow nav-prev text-left">
			    <?php previous_post_link( '<div class="nav-previous">%link</div>','<span class="hide-for-small">' .get_flatsome_icon('icon-angle-left') . _x( '', 'Previous post link', 'flatsome' ) . '</span> %title' ); ?>

		</div>
		<div class="flex-col flex-grow nav-next text-right">
			    <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="hide-for-small">'. get_flatsome_icon('icon-angle-right') . _x( '', 'Next post link', 'flatsome' ) . '</span>' ); ?>
		</div>
	</div>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

	<div class="flex-row">
		<div class="flex-col flex-grow">
   <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="icon-angle-left"></span> Older posts', 'flatsome' ) ); ?></div>
        <?php endif; ?>
		</div>
		<div class="flex-col flex-grow">
		  <?php if ( get_previous_posts_link() ) : ?>
		     <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="icon-angle-right"></span>', 'flatsome' ) ); ?></div>
		 <?php endif; ?>		</div>
	</div>
	<?php endif; ?>
    </nav><!-- #<?php echo esc_html( $nav_id ); ?> -->

    <?php
}
endif; // flatsome_content_nav


if ( ! function_exists( 'flatsome_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function flatsome_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'flatsome' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'flatsome' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-inner">

            <div class="flex-row align-top">
                <div class="flex-col">
                    <div class="comment-author mr-half">
                        <?php echo get_avatar( $comment, 70 ); ?>
                    </div>
                </div><!-- .large-3 -->

                <div class="flex-col flex-grow">
                    <?php printf( __( '%s <span class="says">says:</span>', 'flatsome' ), sprintf( '<cite class="strong fn">%s</cite>', get_comment_author_link() ) ); ?>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'flatsome' ); ?></em>
                     <br />
                    <?php endif; ?>

                   <div class="comment-content"><?php comment_text(); ?></div>


                 <div class="comment-meta commentmetadata uppercase is-xsmall clear">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>" class="pull-left">
                    <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'flatsome' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( 'Edit', 'flatsome' ), '<span class="edit-link ml-half strong">', '<span>' ); ?>

                        <div class="reply pull-right">
                            <?php
                                comment_reply_link( array_merge( $args,array(
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                ) ) );
                            ?>
                        </div><!-- .reply -->
                </div><!-- .comment-meta .commentmetadata -->

                </div><!-- .flex-col -->
            </div><!-- .flex-row -->
		</article>
    <!-- #comment -->

	<?php
			break;
	endswitch;
}
endif; // ends check for flatsome_comment()

if ( ! function_exists( 'flatsome_posted_on' ) ) :

// Prints HTML with meta information for the current post-date/time and author.
function flatsome_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        esc_html_x( 'Posted on %s', 'post date', 'flatsome' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'flatsome' ),
        '<span class="meta-author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;


function flatsome_featured_sticky_posts( $query ) {
    if (flatsome_option('blog_featured') && $query->is_home() && $query->is_main_query()) {
        $query->set( 'ignore_sticky_posts', 1);
        if(flatsome_option('blog_hide_sticky')){ $query->set( 'post__not_in', get_option( 'sticky_posts' ) );}
     }
}
add_action( 'pre_get_posts', 'flatsome_featured_sticky_posts' );




// Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
function flatsome_enhanced_image_navigation( $url, $id ) {
  if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
    return $url;

  $image = get_post( $id );
  if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
    $url .= '#main';

  return $url;
}
add_filter( 'attachment_link', 'flatsome_enhanced_image_navigation', 10, 2 );


// Numbered Pagination
if ( !function_exists( 'flatsome_posts_pagination' ) ) {

    function  flatsome_posts_pagination() {

        $prev_arrow = is_rtl() ? get_flatsome_icon('icon-angle-right') : get_flatsome_icon('icon-angle-left');
        $next_arrow = is_rtl() ? get_flatsome_icon('icon-angle-left') : get_flatsome_icon('icon-angle-right');

        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 999999999; // need an unlikely integer
        if( $total > 1 )  {

             if( !$current_page = get_query_var('paged') )
                 $current_page = 1;
             if( get_option('permalink_structure') ) {
                 $format = 'page/%#%/';
             } else {
                 $format = '&paged=%#%';
             }
            $pages = paginate_links(array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => $format,
                'current'       => max( 1, get_query_var('paged') ),
                'total'         => $total,
                'mid_size'      => 3,
                'type'          => 'array',
                'prev_text'     => $prev_arrow,
                'next_text'     => $next_arrow,
             ) );

            if( is_array( $pages ) ) {
                $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                echo '<ul class="page-numbers nav-pagination links text-center">';
                foreach ( $pages as $page ) {
                        $page = str_replace("page-numbers","page-number",$page);
                        echo "<li>$page</li>";
                }
               echo '</ul>';
            }
        }
    }

}
