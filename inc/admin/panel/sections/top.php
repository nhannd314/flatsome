<?php
/**
 * Flatome Panel
 */
?>
<?php add_thickbox(); ?>
<?php $flatsome_ver = wp_get_theme( get_template() );  ?>
<h1>
    <?php echo '<strong>Welcome to Flatsome</strong>'; ?>
</h1>
<div class="about-text">
<?php _e( 'Thanks for Choosing Flatsome - The worlds most powerful WooCommerce and Multi-Purpose Theme. This page will help you quickly get up and running with Flatsome.', 'flatsome-admin' ); ?>
    <br><br>
    <a href="<?php echo admin_url().'admin.php?page=flatsome-setup'; ?>" class="button button-primary button-large"><?php _e('Setup Wizard', 'flatsome-admin' ); ?></a>
</div>

<div class="wp-badge fl-badge">Version <?php echo $flatsome_ver['Version']; ?></div>

<h2 class="nav-tab-wrapper">
    <?php $url = admin_url().'admin.php?page=flatsome-panel' ?>
    <a href="<?php echo $url; ?>" class="nav-tab <?php if($_GET['page'] == 'flatsome-panel') echo 'nav-tab-active'; ?>"><?php _e('Theme License', 'flatsome-admin' ); ?></a>

    <a href="<?php echo $url.'-support'; ?>" class="nav-tab <?php if($_GET['page'] == 'flatsome-panel-support') echo 'nav-tab-active'; ?>"><?php _e( 'Help & Guides', 'flatsome-admin' ); ?></a>

    <a href="<?php echo $url.'-changelog'; ?>" class="nav-tab <?php if($_GET['page'] == 'flatsome-panel-changelog') echo 'nav-tab-active'; ?>"><?php _e( 'Change log', 'flatsome-admin' ); ?></a>
</h2>
