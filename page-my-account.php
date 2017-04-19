<?php
/*
Template name: WooCommerce - My Account
This templates add My account to the sidebar.
*/

get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<?php wc_get_template('myaccount/header.php'); ?>

<div class="page-wrapper my-account mb">
<div class="container" role="main">

<?php if(is_user_logged_in()){?>

<div class="row vertical-tabs">
<div class="large-3 col col-border">

	<?php wc_get_template('myaccount/account-user.php'); ?>

	<ul id="my-account-nav" class="account-nav nav nav-line nav-uppercase nav-vertical mt-half">
	     <?php wc_get_template('myaccount/account-links.php'); ?>
	</ul><!-- .account-nav -->
</div><!-- .large-3 -->

<div class="large-9 col">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; // end of the loop. ?>
	</div><!-- .large-9 -->
</div><!-- .row .vertical-tabs -->

<?php } else { ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; // end of the loop. ?>

<?php } ?>


</div><!-- .container -->
</div><!-- .page-wrapper.my-account  -->


<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
