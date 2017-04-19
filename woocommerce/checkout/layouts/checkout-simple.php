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

<div id="main-content" class="site-main">

<!-- woocommerce message -->

<div id="main" class="page-checkout-simple">

  <div id="content" role="main">

  <?php while ( have_posts() ) : the_post(); ?>

    <div class="cart-header container text-left medium-text-center">
      <?php get_template_part('template-parts/header/partials/element','logo'); ?>
      <?php wc_get_template('checkout/header-small.php'); ?>
    </div>

    <?php the_content(); ?>

  <?php endwhile; // end of the loop. ?>

  </div><!-- end #content -->

</div>

<div class="focused-checkout-footer">
  <?php get_template_part('template-parts/footer/footer','absolute'); ?>
</div>

</div><!-- #main-content -->

</div><!-- #wrapper -->

<!-- back to top -->
<?php wp_footer(); ?>

</body>
</html>
