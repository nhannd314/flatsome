<!DOCTYPE html>
<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

  <?php wp_head(); ?>
</head>
<!-- loading -->

<body <?php body_class(); ?>>

<div id="main-content" class="site-main" style="max-width:1000px; margin:60px auto 60px auto;">

<!-- woocommerce message -->
<?php  if(function_exists('wc_print_notices')) {wc_print_notices();}?>

<div id="main" class="page-wrapper box-shadow page-checkout" style="padding:15px 30px 15px;">

<div class="focused-checkout-logo text-center" style="padding-top: 30px; padding-bottom: 30px;">
    <?php get_template_part('template-parts/header/partials/element','logo'); ?>
</div>

<div class="container"><div class="top-divider full-width"></div></div>

<div class="focused-checkout-header pb">
  <?php wc_get_template('checkout/header.php'); ?>
</div>

<div class="row">
<div id="content" class="large-12 col" role="main">

<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

<?php endwhile; // end of the loop. ?>


</div><!-- end #content large-12 -->
</div><!-- end row -->

</div><!-- end page-right-sidebar container -->

<div class="focused-checkout-footer">
  <?php get_template_part('template-parts/footer/footer','absolute'); ?>
</div>

</div><!-- #main-content -->

</div><!-- #wrapper -->

<!-- back to top -->
<?php wp_footer(); ?>

</body>
</html>
