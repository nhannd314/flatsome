<?php
/**
 * Share template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.13
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly

$classes = get_flatsome_icon_class(flatsome_option('social_icons_style'));
$classes = $classes.' tooltip';

?>
<div class="yith-wcwl-share social-icons share-icons share-row relative">
        <span class="share-icons-title"><?php echo $share_title ?></span>
        <?php if( $share_facebook_enabled ): ?>
                <a target="_blank" class="facebook <?php echo $classes;?>" href="https://www.facebook.com/sharer.php?s=100&amp;p%5Btitle%5D=<?php echo $share_link_title ?>&amp;p%5Burl%5D=<?php echo urlencode( $share_link_url ) ?>" title="<?php _e( 'Facebook', 'yith-woocommerce-wishlist' ) ?>"><i class="icon-facebook"></i></a>
        <?php endif; ?>

        <?php if( $share_twitter_enabled ): ?>
                <a target="_blank" class="twitter <?php echo $classes;?>" href="https://twitter.com/share?url=<?php echo $share_link_url ?>&amp;text=<?php echo $share_twitter_summary ?>" title="<?php _e( 'Twitter', 'yith-woocommerce-wishlist' ) ?>"><i class="icon-twitter"></i></a>
        <?php endif; ?>

        <?php if( $share_pinterest_enabled ): ?>
                <a target="_blank" class="pinterest <?php echo $classes;?>" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link_url ?>&amp;description=<?php echo $share_summary ?>&amp;media=<?php echo $share_image_url ?>" title="<?php _e( 'Pinterest', 'yith-woocommerce-wishlist' ) ?>" onclick="window.open(this.href); return false;"><i class="icon-pinterest"></i></a>
        <?php endif; ?>

        <?php if( $share_googleplus_enabled ): ?>
                <a target="_blank" class="google-plus <?php echo $classes;?>" href="https://plus.google.com/share?url=<?php echo $share_link_url ?>&amp;title=<?php echo $share_link_title ?>" title="<?php _e( 'Google+', 'yith-woocommerce-wishlist' ) ?>" onclick='javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'><i class="icon-google-plus"></i></a>
        <?php endif; ?>

        <?php if( $share_email_enabled ): ?>
                <a class="email <?php echo $classes;?>" href="mailto:?subject=<?php echo urlencode( apply_filters( 'yith_wcwl_email_share_subject', __( 'I wanted you to see this site', 'yith-woocommerce-wishlist' ) ) )?>&amp;body=<?php echo apply_filters( 'yith_wcwl_email_share_body', $share_link_url ) ?>&amp;title=<?php echo $share_link_title ?>" title="<?php _e( 'Email', 'yith-woocommerce-wishlist' ) ?>"><i class="icon-envelop"></i></a>
        <?php endif; ?>
</div>